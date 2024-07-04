<?php

namespace App\Http\Controllers\master;

use App\Enums\Permission as PermissionsEnum;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:' . PermissionsEnum::ROLE_VIEW->value], ['only' => ['index', 'show']]);
        $this->middleware(['permission:' . PermissionsEnum::ROLE_CREATE->value], ['only' => ['create', 'store']]);
        $this->middleware(['permission:' . PermissionsEnum::ROLE_EDIT->value], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:' . PermissionsEnum::ROLE_DELETE->value], ['only' => ['delete']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(5);

        return view('internal.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::orderBy('name')->get();

        return view('internal.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'role' => 'required|unique:roles,name',
            'permissions' => 'required'
        ]);

        try {
            $role = DB::transaction(function () use ($request) {
                $role = Role::create([
                    'name' => $request->input('role')
                ]);

                $role->syncPermissions($request->input('permissions'));

                return $role;
            });

            return redirect()->route('role.index')
                ->with([
                    'status' => 'success',
                    'message' => __('Role :role is successfully created', ['role' => $role->name])
                ]);
        } catch (Exception $e) {
            return back()->with([
                'status' => 'danger',
                'message' => __('Create role failed, try again or contact administrator')
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::findById($id);
        $rolePermissions = $role->permissions()->get();

        return view('internal.role.view', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findById($id);
        if ($role->id == 1) {
            return redirect()->route('role.index')->with([
                'status' => 'warning',
                'message' => __('You cant edit role :role', ['role' => $role->name])
            ]);
        }

        $permissions = Permission::orderBy('name')->get();
        $rolePermissions = $role->permissions()->get();

        return view('internal.role.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'role' => "required|unique:roles,name,{$id},id",
            'permissions' => 'required'
        ]);

        $role = Role::findById($id);
        if ($role->id == 1) {
            return redirect()->route('role.index')->with([
                'status' => 'warning',
                'message' => __('You cant edit role :role', ['role' => $role->name])
            ]);
        }

        try {
            DB::transaction(function () use ($request, $role) {
                $role->name = $request->input('role');
                $role->save();

                $role->syncPermissions($request->input('permissions'));

                return $role;
            });

            return redirect()->route('role.index')
                ->with([
                    'status' => 'success',
                    'message' => __('Role :role is successfully updated', ['role' => $role->name])
                ]);
        } catch (Exception $e) {
            return back()->with([
                'status' => 'danger',
                'message' => __('Update role failed, try again or contact administrator')
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findById($id);

        $isDeleted = $role->delete();

        $message = [];
        if ($isDeleted) {
            $message = [
                'status' => 'warning',
                'message' => __('Role :role is successfully deleted', ['role' => $role->name])
            ];
        } else {
            $message = [
                'status' => 'danger',
                'message' => __('Delete role failed, try again or contact administrator')
            ];
        }

        return redirect()->route('role.index')->with($message);
    }
}
