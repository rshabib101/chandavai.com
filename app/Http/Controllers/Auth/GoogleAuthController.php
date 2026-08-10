<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle(Request $request)
    {
        // Render a clean Google Sign In prompt interface
        return response()->html('
            <!DOCTYPE html>
            <html lang="bn">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Sign in with Google - chanda vai</title>
                <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
                <style>
                    * { box-sizing: border-box; margin: 0; padding: 0; font-family: "Inter", sans-serif; }
                    body { background: #f0f2f5; display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 16px; }
                    .google-card { background: #ffffff; border-radius: 20px; padding: 32px 24px; max-width: 400px; width: 100%; box-shadow: 0 10px 30px rgba(0,0,0,0.08); text-align: center; }
                    .google-icon-header { font-size: 42px; color: #ea4335; margin-bottom: 12px; }
                    .card-title { font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 6px; }
                    .card-sub { font-size: 13px; color: #64748b; margin-bottom: 24px; }
                    .form-group { margin-bottom: 16px; text-align: left; }
                    .form-group label { display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px; }
                    .form-group input { width: 100%; border: 1px solid #cbd5e1; border-radius: 12px; padding: 12px 14px; font-size: 14px; outline: none; }
                    .btn-google-submit { width: 100%; background: #ea4335; color: #ffffff; border: none; border-radius: 25px; padding: 12px; font-size: 15px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 12px rgba(234, 67, 53, 0.3); }
                </style>
            </head>
            <body>
                <div class="google-card">
                    <i class="fa-brands fa-google google-icon-header"></i>
                    <h2 class="card-title">Sign in with Google</h2>
                    <p class="card-sub">Choose your Google account to continue to chanda vai</p>

                    <form action="/auth/google/callback" method="POST">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <div class="form-group">
                            <label>Your Name</label>
                            <input type="text" name="name" placeholder="e.g. Rahbar Din" required>
                        </div>
                        <div class="form-group">
                            <label>Google Email Address</label>
                            <input type="email" name="email" placeholder="example@gmail.com" required>
                        </div>
                        <button type="submit" class="btn-google-submit">
                            <i class="fa-brands fa-google"></i> Continue to Account
                        </button>
                    </form>
                </div>
            </body>
            </html>
        ');
    }

    public function handleGoogleCallback(Request $request)
    {
        $email = $request->input('email');
        $name = $request->input('name') ?: ($email ? strtok($email, '@') : 'Google User');

        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->route('register')->withErrors(['email' => 'Valid Google email is required']);
        }

        $user = User::where('email', $email)->orWhere('google_id', 'google_' . md5($email))->first();

        if (!$user) {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'google_id' => 'google_' . md5($email),
                'password' => Hash::make(Str::random(16)),
                'referral_code' => strtoupper(Str::random(8)),
                'points' => 0,
            ]);
        } else {
            if (empty($user->google_id)) {
                $user->update(['google_id' => 'google_' . md5($email)]);
            }
        }

        Auth::login($user, true);

        return redirect('/')->with('status', 'Logged in with Google successfully!');
    }
}
