<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        return view('internal.profile.view', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        $filepath = $request->user()->avatar;
        $avatar = $request->file('avatar');
        if ($avatar) {
            $filename = 'avatars/' . date('Y/m/') . time() . '.' . $avatar->extension();
            $avatar->storeAs('public/uploads/', $filename);

            if ($avatar->isValid()) {
                $filepath = $filename;

                if (file_exists(public_path('storage/uploads/' . $request->user()->avatar))) {
                    Storage::disk('public')->delete('uploads/' . $request->user()->avatar);
                }
            } else {
                return redirect()->route('profile.edit')
                    ->with([
                        'status' => 'warning',
                        'message' => __('Upload file failed. :message', ['message' => $avatar->getErrorMessage()])
                    ]);
            }
        }

        $request->user()->name = $request->validated('name');
        $request->user()->email = $request->validated('email');
        $request->user()->avatar = $filepath;

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with([
            'status' => 'success',
            'message' => __('Profile is successfully updated')
        ]);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
