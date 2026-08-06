<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the Facebook/Boipai style user profile view.
     */
    public function show(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $reports = \App\Models\Report::where('user_id', $user->id)
            ->where('status', 'approved')
            ->latest()
            ->get();

        return view('profile.show', compact('user', 'reports'));
    }

    /**
     * Display the settings view.
     */
    public function settings(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return redirect()->route('login');
        }

        return view('profile.settings', compact('user'));
    }

    /**
     * Display the dark-themed post engagement analytics dashboard.
     */
    public function analytics(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return redirect()->route('login');
        }

        return view('profile.analytics', compact('user'));
    }



    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

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

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Update user profile photo and/or cover photo.
     */
    public function updatePhotos(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['error' => 'Unauthenticated'], 401);
            }
            return redirect()->route('login');
        }

        $request->validate([
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        $updated = false;

        if ($request->hasFile('profile_photo') && $request->file('profile_photo')->isValid()) {
            if ($user->profile_photo && file_exists(public_path('storage/' . $user->profile_photo))) {
                @unlink(public_path('storage/' . $user->profile_photo));
            }
            $user->profile_photo = $request->file('profile_photo')->store('profiles', 'public');
            $updated = true;
        }

        if ($request->hasFile('cover_photo') && $request->file('cover_photo')->isValid()) {
            if ($user->cover_photo && file_exists(public_path('storage/' . $user->cover_photo))) {
                @unlink(public_path('storage/' . $user->cover_photo));
            }
            $user->cover_photo = $request->file('cover_photo')->store('covers', 'public');
            $updated = true;
        }

        if ($updated) {
            $user->save();
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'ছবি সফলভাবে আপডেট করা হয়েছে!',
                'profile_photo_url' => $user->profile_photo_url,
                'cover_photo_url' => $user->cover_photo_url,
            ]);
        }

        return back()->with('success', 'Photo updated successfully!');
    }

    /**
     * Update client-side screen resolution & timezone metadata.
     */
    public function updateClientMeta(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $data = [];
            if ($request->filled('screen_resolution')) {
                $data['screen_resolution'] = substr($request->input('screen_resolution'), 0, 50);
            }
            if ($request->filled('timezone')) {
                $data['timezone'] = substr($request->input('timezone'), 0, 100);
            }
            if (!empty($data)) {
                $user->update($data);
            }
        }
        return response()->json(['status' => 'success']);
    }
}

