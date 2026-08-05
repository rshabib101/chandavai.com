<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - chanda vai</title>
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #f0f2f5;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-card {
            background: #ffffff;
            width: 100%;
            max-width: 440px;
            border-radius: 20px;
            padding: 28px 24px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid #e4e6eb;
        }

        .auth-brand {
            text-align: center;
            margin-bottom: 20px;
        }

        .brand-badge {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #1877f2, #0052cc);
            color: #ffffff;
            font-size: 28px;
            font-weight: 800;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(24, 119, 242, 0.3);
            margin-bottom: 8px;
        }

        .brand-title {
            font-size: 24px;
            font-weight: 800;
            color: #0f172a;
        }

        .form-group {
            margin-bottom: 14px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #4b5563;
            margin-bottom: 5px;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 11px 14px 11px 40px;
            background: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            font-size: 14px;
            outline: none;
            transition: all 0.2s;
        }

        .form-input:focus {
            border-color: #1877f2;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(24, 119, 242, 0.15);
        }

        .btn-register {
            width: 100%;
            background: #42b72a;
            color: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(66, 183, 42, 0.3);
            transition: background 0.2s, transform 0.15s;
            margin-top: 10px;
        }

        .btn-register:hover {
            background: #36a420;
            transform: scale(1.01);
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 18px 0;
            color: #94a3b8;
            font-size: 12px;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e2e8f0;
        }

        .divider::before { margin-right: .5em; }
        .divider::after { margin-left: .5em; }

        .btn-login-link {
            width: 100%;
            background: #f1f5f9;
            color: #1877f2;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            padding: 12px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: block;
            transition: background 0.2s;
        }

        .btn-login-link:hover {
            background: #e2e8f0;
        }

        .error-msg {
            color: #ef4444;
            font-size: 12px;
            margin-top: 4px;
        }
    </style>
</head>

<body>

    <div class="auth-card">

        <!-- BRAND HEADER -->
        <div class="auth-brand">
            <div class="brand-badge">b</div>
            <h1 class="brand-title">Create a new account</h1>
            <p style="font-size:13px; color:#64748b; margin-top:4px;">It's quick and easy.</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="hidden" name="ref_code" value="{{ request('ref', session('ref_code')) }}">

            <!-- FULL NAME -->
            <div class="form-group">
                <label class="form-label" for="name">Full Name</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-user input-icon"></i>
                    <input id="name" class="form-input" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Enter your full name">
                </div>
                @if ($errors->has('name'))
                    <div class="error-msg">{{ $errors->first('name') }}</div>
                @endif
            </div>

            <!-- EMAIL -->
            <div class="form-group">
                <label class="form-label" for="email">Email Address</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-envelope input-icon"></i>
                    <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required placeholder="Enter your email address">
                </div>
                @if ($errors->has('email'))
                    <div class="error-msg">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <!-- PASSWORD -->
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-lock input-icon"></i>
                    <input id="password" class="form-input" type="password" name="password" required placeholder="Create password">
                </div>
                @if ($errors->has('password'))
                    <div class="error-msg">{{ $errors->first('password') }}</div>
                @endif
            </div>

            <!-- CONFIRM PASSWORD -->
            <div class="form-group">
                <label class="form-label" for="password_confirmation">Confirm Password</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-shield-halved input-icon"></i>
                    <input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required placeholder="Confirm password">
                </div>
                @if ($errors->has('password_confirmation'))
                    <div class="error-msg">{{ $errors->first('password_confirmation') }}</div>
                @endif
            </div>

            <!-- REGISTER SUBMIT -->
            <button type="submit" class="btn-register">
                Sign Up
            </button>

            <div class="divider">or</div>

            <!-- ALREADY REGISTERED -->
            <a href="{{ route('login') }}" class="btn-login-link">
                Already have an account? Log In
            </a>
        </form>

    </div>

</body>

</html>
