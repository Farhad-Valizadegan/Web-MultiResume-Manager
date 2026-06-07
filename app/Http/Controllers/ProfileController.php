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
        $user = $request->user()->load('profile');

        return view('profile.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        /*
        |--------------------------------------------------------------------------
        | Update basic user information
        |--------------------------------------------------------------------------
        */
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        /*
        |--------------------------------------------------------------------------
        | Validate profile information
        |--------------------------------------------------------------------------
        */
        $profileData = $request->validate([
            'phone' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'linkedin' => ['nullable', 'url', 'max:255'],
            'github' => ['nullable', 'url', 'max:255'],
            'portfolio' => ['nullable', 'url', 'max:255'],
            'xing' => ['nullable', 'url', 'max:255'],
            'bio' => ['nullable', 'string'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Upload profile photo
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('profile_photo')) {
            if ($user->profile && $user->profile->profile_photo) {
                Storage::disk('public')->delete($user->profile->profile_photo);
            }

            $profileData['profile_photo'] = $request
                ->file('profile_photo')
                ->store('profile-photos', 'public');
        } else {
            unset($profileData['profile_photo']);
        }

        /*
        |--------------------------------------------------------------------------
        | Create or update profile row
        |--------------------------------------------------------------------------
        */
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $profileData
        );

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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

        if ($user->profile && $user->profile->profile_photo) {
            Storage::disk('public')->delete($user->profile->profile_photo);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}