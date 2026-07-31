<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
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
            background-color: #f1f5f9;
            font-family: 'Inter', sans-serif;
            color: #0f172a;
            padding-bottom: 40px;
        }

        .settings-container {
            max-width: 600px;
            margin: 0 auto;
            min-height: 100vh;
            padding: 16px;
        }

        /* HEADER */
        .settings-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            position: relative;
            padding: 8px 0;
        }

        .btn-back-circle {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #ffffff;
            color: #0f172a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            text-decoration: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            border: none;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-back-circle:hover {
            background: #e2e8f0;
        }

        .settings-title {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
        }

        /* GROUPED CARDS */
        .settings-group-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 4px 0;
            margin-bottom: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        .settings-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            text-decoration: none;
            color: #0f172a;
            transition: background 0.15s ease;
        }

        .settings-item:not(:last-child) {
            border-bottom: 1px solid #f1f5f9;
        }

        .settings-item:hover {
            background: #f8fafc;
        }

        .item-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .item-icon {
            font-size: 18px;
            color: #0f172a;
            width: 24px;
            display: flex;
            justify-content: center;
        }

        .item-label-group {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .item-title {
            font-size: 15px;
            font-weight: 600;
            color: #0f172a;
        }

        .item-subtitle {
            font-size: 13px;
            color: #64748b;
            font-weight: 500;
        }

        .item-arrow {
            font-size: 14px;
            color: #94a3b8;
        }

        /* LOGOUT BUTTON */
        .logout-btn-container {
            margin-top: 24px;
        }

        .logout-btn {
            width: 100%;
            background: #fee2e2;
            color: #ef4444;
            border: none;
            border-radius: 28px;
            padding: 16px 20px;
            font-size: 16px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s, transform 0.15s;
        }

        .logout-btn:hover {
            background: #fecaca;
            transform: scale(1.01);
        }

        .logout-btn i {
            font-size: 16px;
        }
    </style>
</head>

<body>

    <div class="settings-container">

        <!-- HEADER -->
        <div class="settings-header">
            <a href="/user/profile" class="btn-back-circle" title="Back">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h1 class="settings-title">Settings</h1>
            <div style="width:44px;"></div>
        </div>

        <!-- GROUP 1: PROFILE & EMAIL -->
        <div class="settings-group-card">
            <a href="/profile" class="settings-item">
                <div class="item-left">
                    <div class="item-icon"><i class="fa-solid fa-user"></i></div>
                    <div class="item-title">Edit Profile</div>
                </div>
                <div class="item-arrow"><i class="fa-solid fa-chevron-right"></i></div>
            </a>
            <a href="/profile" class="settings-item">
                <div class="item-left">
                    <div class="item-icon"><i class="fa-solid fa-envelope"></i></div>
                    <div class="item-label-group">
                        <div class="item-title">Email Settings</div>
                        <div class="item-subtitle">{{ $user->email ?? 'rahbarehak@gmail.com' }}</div>
                    </div>
                </div>
                <div class="item-arrow"><i class="fa-solid fa-chevron-right"></i></div>
            </a>
        </div>

        <!-- GROUP 2: LEGAL & POLICIES -->
        <div class="settings-group-card">
            <a href="#" class="settings-item">
                <div class="item-left">
                    <div class="item-icon"><i class="fa-solid fa-lock"></i></div>
                    <div class="item-title">Privacy Policy</div>
                </div>
                <div class="item-arrow"><i class="fa-solid fa-chevron-right"></i></div>
            </a>
            <a href="#" class="settings-item">
                <div class="item-left">
                    <div class="item-icon"><i class="fa-solid fa-circle-info"></i></div>
                    <div class="item-title">Terms of Service</div>
                </div>
                <div class="item-arrow"><i class="fa-solid fa-chevron-right"></i></div>
            </a>
            <a href="#" class="settings-item">
                <div class="item-left">
                    <div class="item-icon"><i class="fa-solid fa-circle-info"></i></div>
                    <div class="item-title">Community Guidelines</div>
                </div>
                <div class="item-arrow"><i class="fa-solid fa-chevron-right"></i></div>
            </a>
        </div>

        <!-- GROUP 3: ABOUT & DELETE -->
        <div class="settings-group-card">
            <a href="#" class="settings-item">
                <div class="item-left">
                    <div class="item-icon"><i class="fa-solid fa-circle-info"></i></div>
                    <div class="item-title">About</div>
                </div>
                <div class="item-arrow"><i class="fa-solid fa-chevron-right"></i></div>
            </a>
            <a href="/profile" class="settings-item">
                <div class="item-left">
                    <div class="item-icon"><i class="fa-solid fa-lock"></i></div>
                    <div class="item-title">Delete Account</div>
                </div>
                <div class="item-arrow"><i class="fa-solid fa-chevron-right"></i></div>
            </a>
        </div>

        <!-- LOG OUT BUTTON FORM -->
        <div class="logout-btn-container">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fa-solid fa-arrow-left"></i> Log Out
                </button>
            </form>
        </div>

    </div>

</body>

</html>
