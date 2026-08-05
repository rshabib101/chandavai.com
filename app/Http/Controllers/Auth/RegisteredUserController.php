<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request): View
    {
        if ($request->has('ref')) {
            session(['ref_code' => $request->query('ref')]);
        }
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'ref_code' => ['nullable', 'string'],
        ]);

        $refCode = $request->ref_code ?: session('ref_code');
        $referredBy = null;

        if ($refCode) {
            $referrer = User::where('referral_code', $refCode)->first();
            if ($referrer) {
                $referredBy = $referrer->id;
            }
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'referred_by_id' => $referredBy,
        ]);

        if ($referredBy) {
            \App\Models\UserNotification::createNotification(
                $referredBy,
                $user->id,
                'referral',
                'New Referral Signup 🎉',
                $user->name . ' joined using your referral link!',
                '/referral-leaderboard'
            );
            session()->forget('ref_code');
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect('/');
    }
}
