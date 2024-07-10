<?php

namespace App\Http\Controllers\master;

use App\Enums\Permission;
use App\Enums\UserStatus;
use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:' . Permission::USER_VIEW->value], ['only' => ['index', 'show']]);
        $this->middleware(['permission:' . Permission::USER_CREATE->value], ['only' => ['create', 'store']]);
        $this->middleware(['permission:' . Permission::USER_EDIT->value], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:' . Permission::USER_DELETE->value], ['only' => ['delete']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(5);

        return view('internal.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::get();

        return view('internal.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'type' => ['required', Rule::in(array_column(UserType::cases(), 'value'))],
            'status' => ['required', Rule::in(array_column(UserStatus::cases(), 'value'))],
            'email' => 'required|unique:users,email',
            'password' => ['required', 'confirmed', Password::defaults()],
            'avatar' => 'nullable|mimes:jpg,png|max:2048'
        ]);

        $filepath = '';
        $avatar = $request->file('avatar');
        if ($avatar) {
            $filename = 'avatars/' . date('Y/m/') . time() . '.' . $avatar->extension();
            $avatar->storeAs('public/uploads/', $filename);

            if ($avatar->isValid()) {
                $filepath = $filename;
            } else {
                return redirect()->route('user.index')
                    ->with([
                        'status' => 'warning',
                        'message' => __('Upload file failed. :message', ['message' => $avatar->getErrorMessage()])
                    ]);
            }
        }

        try {
            $user = DB::transaction(function () use ($request, $filepath) {
                $user = User::create([
                    'name' => $request->input('name'),
                    'type' => $request->input('type'),
                    'status' => $request->input('status'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                    'avatar' => empty($filepath) ? null : $filepath
                ]);

                $user->assignRole($request->input('roles'));

                return $user;
            });

            return redirect()->route('user.index')
                ->with([
                    'status' => 'success',
                    'message' => __('User :user is successfully created', ['user' => $user->name])
                ]);
        } catch (Exception $e) {
            return back()->with([
                'status' => 'danger',
                'message' => __('Create user failed, try again or contact administrator')
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        $userRoles = $user->roles()->get();

        return view('internal.user.view', compact('user', 'userRoles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        if ($user->id == 1 && auth()->user()->id !== 1) {
            return redirect()->route('user.index')->with([
                'status' => 'warning',
                'message' => __('You cant edit user :user', ['user' => $user->name])
            ]);
        }

        $roles = Role::get();
        $userRoles = $user->roles()->get();

        return view('internal.user.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validationRules = [
            'name' => 'required|max:50',
            'type' => ['required', Rule::in(array_column(UserType::cases(), 'value'))],
            'status' => ['required', Rule::in(array_column(UserStatus::cases(), 'value'))],
            'email' => "required|unique:users,email,{$id},id",
            'avatar' => 'nullable|mimes:jpg,png|max:2048'
        ];
        if (!empty($request->input('password'))) {
            $validationRules['password'] = ['required', 'confirmed', Password::defaults()];
        }

        $this->validate($request, $validationRules);

        $user = User::find($id);
        if ($user->id == 1 && auth()->user()->id !== 1) {
            return redirect()->route('user.index')->with([
                'status' => 'warning',
                'message' => __('You cant edit user :user', ['user' => $user->name])
            ]);
        }

        $filepath = $user->avatar;
        $avatar = $request->file('avatar');
        if ($avatar) {
            $filename = 'avatars/' . date('Y/m/') . time() . '.' . $avatar->extension();
            $avatar->storeAs('public/uploads/', $filename);

            if ($avatar->isValid()) {
                $filepath = $filename;

                if (file_exists(public_path('storage/uploads/' . $user->avatar))) {
                    Storage::disk('public')->delete('uploads/' . $user->avatar);
                }
            } else {
                return redirect()->route('user.index')
                    ->with([
                        'status' => 'warning',
                        'message' => __('Upload file failed. :message', ['message' => $avatar->getErrorMessage()])
                    ]);
            }
        }

        try {
            DB::transaction(function () use ($request, $filepath, $user) {
                $user->name = $request->input('name');
                $user->type = $request->input('type');
                $user->status = $request->input('status');
                $user->email = $request->input('email');
                $user->avatar = $filepath;

                if (!empty($request->input('password'))) {
                    $user->password = Hash::make($request->input('password'));
                }
                $user->save();

                $user->syncRoles($request->input('roles'));

                return $user;
            });

            return redirect()->route('user.index')
                ->with([
                    'status' => 'success',
                    'message' => __('User :user is successfully updated', ['user' => $user->name])
                ]);
        } catch (Exception $e) {
            return back()->with([
                'status' => 'danger',
                'message' => __('Update user failed, try again or contact administrator')
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if ($user->id == 1) {
            return redirect()->route('user.index')->with([
                'status' => 'warning',
                'message' => __('You cant delete user :user', ['user' => $user->name])
            ]);
        }

        $isDeleted = $user->delete();

        $message = [];
        if ($isDeleted) {
            $message = [
                'status' => 'warning',
                'message' => __('User :user is successfully deleted', ['user' => $user->name])
            ];
        } else {
            $message = [
                'status' => 'danger',
                'message' => __('Delete user failed, try again or contact administrator')
            ];
        }

        return redirect()->route('user.index')->with($message);
    }
}
