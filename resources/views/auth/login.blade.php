<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - chanda vai</title>
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
            max-width: 420px;
            border-radius: 20px;
            padding: 28px 24px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid #e4e6eb;
        }

        .auth-brand {
            text-align: center;
            margin-bottom: 24px;
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
            font-size: 26px;
            font-weight: 800;
            color: #1877f2;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #4b5563;
            margin-bottom: 6px;
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
            font-size: 15px;
        }

        .form-input {
            width: 100%;
            padding: 12px 14px 12px 42px;
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

        .btn-primary {
            width: 100%;
            background: #1877f2;
            color: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(24, 119, 242, 0.3);
            transition: background 0.2s, transform 0.15s;
            margin-top: 8px;
        }

        .btn-primary:hover {
            background: #166fe5;
            transform: scale(1.01);
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 20px 0;
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

        .btn-secondary {
            width: 100%;
            background: #42b72a;
            color: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: block;
            box-shadow: 0 4px 12px rgba(66, 183, 42, 0.3);
            transition: background 0.2s;
        }

        .btn-secondary:hover {
            background: #36a420;
        }

        .forgot-link {
            display: block;
            text-align: center;
            font-size: 13px;
            color: #1877f2;
            text-decoration: none;
            margin-top: 14px;
            font-weight: 500;
        }

        .forgot-link:hover {
            text-decoration: underline;
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
            <h1 class="brand-title">Treend</h1>
            <p style="font-size:13px; color:#64748b; margin-top:4px;">Connect and post with your account</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- EMAIL -->
            <div class="form-group">
                <label class="form-label" for="email">Email or Username</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-envelope input-icon"></i>
                    <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email">
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
                    <input id="password" class="form-input" type="password" name="password" required placeholder="Enter your password">
                </div>
                @if ($errors->has('password'))
                    <div class="error-msg">{{ $errors->first('password') }}</div>
                @endif
            </div>

            <!-- LOGIN SUBMIT -->
            <button type="submit" class="btn-primary">
                Log In
            </button>

            @if (Route::has('password.request'))
                <a class="forgot-link" href="{{ route('password.request') }}">
                    Forgotten password?
                </a>
            @endif

            <div class="divider">or</div>

            <!-- CREATE NEW ACCOUNT -->
            <a href="{{ route('register') }}" class="btn-secondary">
                Create New Account
            </a>
        </form>

    </div>

</body>

</html>
