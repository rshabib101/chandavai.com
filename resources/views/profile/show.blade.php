<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - {{ $user->name ?? 'rahbar din' }}</title>
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #f8fafc;
            font-family: 'Inter', 'Hind Siliguri', sans-serif;
            color: #0f172a;
            padding-bottom: 80px;
        }

        /* TOP NAVIGATION HEADER */
        .profile-top-nav {
            position: sticky;
            top: 0;
            background: #ffffff;
            z-index: 100;
            padding: 12px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
        }

        .nav-back-btn {
            background: none;
            border: none;
            font-size: 20px;
            color: #0f172a;
            cursor: pointer;
            text-decoration: none;
        }

        .nav-options-btn {
            background: none;
            border: none;
            font-size: 20px;
            color: #64748b;
            cursor: pointer;
            text-decoration: none;
        }

        /* MAIN CONTAINER */
        .profile-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            min-height: 100vh;
        }

        /* COVER BANNER SECTION */
        .cover-banner {
            width: 100%;
            height: 150px;
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 50%, #e0e7ff 100%);
            position: relative;
            background-image: url('https://images.unsplash.com/photo-1557683316-973673baf926?auto=format&fit=crop&w=800&q=80');
            background-size: cover;
            background-position: center;
        }

        .cover-options-icon {
            position: absolute;
            top: 14px;
            right: 14px;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.85);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #334155;
            text-decoration: none;
            backdrop-filter: blur(4px);
        }

        /* AVATAR & VERIFIED ROW */
        .avatar-verified-row {
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: -50px;
            margin-bottom: 12px;
        }

        .profile-avatar-circle {
            width: 96px;
            height: 96px;
            border-radius: 50%;
            border: 4px solid #ffffff;
            background: #0284c7;
            color: #ffffff;
            font-size: 42px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .get-verified-badge {
            background: #000000;
            color: #ffffff;
            border: none;
            border-radius: 20px;
            padding: 8px 16px;
            font-size: 13px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            text-decoration: none;
            transition: transform 0.15s ease;
        }

        .get-verified-badge:hover {
            transform: scale(1.03);
        }

        .get-verified-badge i {
            font-size: 14px;
        }

        /* USER DETAILS */
        .user-identity-section {
            padding: 0 20px;
            margin-bottom: 16px;
        }

        .user-fullname {
            font-size: 26px;
            font-weight: 800;
            color: #000000;
            line-height: 1.2;
            margin-bottom: 2px;
        }

        .user-handle {
            font-size: 14px;
            color: #64748b;
            font-weight: 500;
        }

        /* STATS CARD */
        .stats-card {
            margin: 0 20px 20px 20px;
            background: #ffffff;
            border-radius: 20px;
            padding: 16px 10px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
            border: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-around;
            text-align: center;
        }

        .stat-col {
            flex: 1;
        }

        .stat-col:not(:last-child) {
            border-right: 1px solid #f1f5f9;
        }

        .stat-number {
            font-size: 20px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 2px;
        }

        .stat-label {
            font-size: 13px;
            color: #64748b;
            font-weight: 500;
        }

        /* ACTION BUTTONS ROW */
        .profile-actions-row {
            padding: 0 20px;
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
        }

        .btn-edit-profile {
            flex: 1;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 28px;
            padding: 12px 20px;
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
            transition: background 0.2s;
        }

        .btn-edit-profile:hover {
            background: #f8fafc;
        }

        .btn-earnings {
            flex: 1;
            background: linear-gradient(135deg, #ff006e 0%, #ff5722 100%);
            color: #ffffff;
            border: none;
            border-radius: 28px;
            padding: 12px 20px;
            font-size: 14px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(255, 0, 110, 0.3);
            transition: transform 0.15s ease;
        }

        .btn-earnings:hover {
            transform: translateY(-1px);
        }

        /* CONTENT TABS */
        .content-tabs-bar {
            display: flex;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 16px;
        }

        .tab-btn {
            flex: 1;
            padding: 14px 0;
            background: none;
            border: none;
            font-size: 20px;
            color: #94a3b8;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .tab-btn.active {
            color: #0f172a;
        }

        .tab-btn.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 30%;
            right: 30%;
            height: 3px;
            background: #000000;
            border-radius: 3px;
        }

        /* POSTS GRID */
        .posts-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 6px;
            padding: 0 16px 20px 16px;
        }

        .grid-post-card {
            aspect-ratio: 1;
            border-radius: 12px;
            overflow: hidden;
            position: relative;
            background: #1e293b;
            cursor: pointer;
        }

        .grid-post-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .grid-post-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, transparent 40%, rgba(0,0,0,0.7) 100%);
            padding: 8px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .grid-post-badge {
            align-self: flex-end;
            background: rgba(0, 0, 0, 0.6);
            color: #ffffff;
            padding: 2px 6px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 3px;
            backdrop-filter: blur(2px);
        }

        .grid-post-text {
            color: #ffffff;
            font-size: 11px;
            font-weight: 600;
            line-height: 1.2;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* BOTTOM APP NAVIGATION */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #ffffff;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 8px 0 10px 0;
            z-index: 1000;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 3px;
            color: #64748b;
            text-decoration: none;
            font-size: 11px;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .nav-item i {
            font-size: 18px;
        }

        .nav-item.active {
            color: #0f172a;
        }

        .nav-item.active i {
            color: #0f172a;
        }

        .nav-item-create i {
            font-size: 18px;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #ff4757;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 6px rgba(255, 71, 87, 0.4);
        }
    </style>
</head>

<body>

    <div class="profile-container">

        <!-- TOP BAR -->
        <div class="profile-top-nav">
            <a href="/" class="nav-back-btn" title="Back to Home">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <a href="/settings" class="nav-options-btn" title="Settings">
                <i class="fa-solid fa-gear"></i>
            </a>
        </div>

        <!-- COVER BANNER -->
        <div class="cover-banner">
            <a href="/settings" class="cover-options-icon" title="Settings">
                <i class="fa-solid fa-ellipsis"></i>
            </a>
        </div>

        <!-- AVATAR & VERIFIED ROW -->
        <div class="avatar-verified-row">
            <div class="profile-avatar-circle">
                {{ strtoupper(substr($user->name ?? 'R', 0, 1)) }}
            </div>
            <a href="#" class="get-verified-badge">
                <i class="fa-solid fa-certificate"></i> Get Verified
            </a>
        </div>

        <!-- USER IDENTITY -->
        <div class="user-identity-section">
            <h1 class="user-fullname">{{ $user->name ?? 'rahbar din' }}</h1>
            <div class="user-handle">@ {{ Str::slug($user->name ?? 'rahbarehak_bnui', '_') }}</div>
        </div>

        <!-- STATS CARD -->
        <div class="stats-card">
            <div class="stat-col">
                <div class="stat-number">{{ $user->reports ? $user->reports->count() : count($reports) }}</div>
                <div class="stat-label">Posts</div>
            </div>
            <div class="stat-col">
                <div class="stat-number">{{ $user->followers_count }}</div>
                <div class="stat-label">Followers</div>
            </div>
            <div class="stat-col">
                <div class="stat-number">{{ $user->following_count }}</div>
                <div class="stat-label">Following</div>
            </div>
            <div class="stat-col">
                <div class="stat-number" style="color: #d97706;">🪙 {{ $user->points }}</div>
                <div class="stat-label">Points</div>
            </div>
        </div>

        @php
            $minFollowersReq = (int) \App\Models\Setting::get('min_followers_for_income', 20);
            $isMonetized = $user->followers_count >= $minFollowersReq;
        @endphp

        <!-- MONETIZATION INCOME STATUS BANNER -->
        <div style="margin: 0 20px 20px 20px; padding: 12px 16px; border-radius: 14px; background: {{ $isMonetized ? '#f0fdf4' : '#fffbeb' }}; border: 1px solid {{ $isMonetized ? '#bbf7d0' : '#fef3c7' }};">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 4px;">
                <span style="font-weight: 700; font-size: 14px; color: {{ $isMonetized ? '#166534' : '#92400e' }};">
                    💰 {{ $isMonetized ? '✅ Income Monetization Active' : '🔒 Income Locked' }}
                </span>
                <span style="font-size: 12px; font-weight: 700; color: #475569;">Req: {{ $minFollowersReq }} Followers</span>
            </div>
            <p style="font-size: 12px; color: {{ $isMonetized ? '#15803d' : '#b45309' }}; margin: 0; line-height: 1.4;">
                @if($isMonetized)
                    অভিনন্দন! আপনার {{ $user->followers_count }} জন ফলোয়ার রয়েছে। আপনার ইনকাম ফিচার চালু রয়েছে।
                @else
                    ইনকাম শুরু করতে অন্তত <strong>{{ $minFollowersReq }} জন ফলোয়ার</strong> প্রয়োজন। আপনার আছে <strong>{{ $user->followers_count }}</strong> জন (আরও <strong>{{ max(0, $minFollowersReq - $user->followers_count) }}</strong> জন ফলোয়ার প্রয়োজন)।
                @endif
            </p>
        </div>

        <!-- ACTION BUTTONS ROW -->
        <div class="profile-actions-row">
            <a href="/profile" class="btn-edit-profile">
                <i class="fa-solid fa-pencil"></i> Edit profile
            </a>
            <a href="/user/analytics" class="btn-earnings">
                <i class="fa-solid fa-sack-dollar"></i> Earnings
            </a>
        </div>


        <!-- CONTENT TABS -->
        <div class="content-tabs-bar">
            <button class="tab-btn active">
                <i class="fa-solid fa-table-cells-large"></i>
            </button>
            <button class="tab-btn">
                <i class="fa-regular fa-image"></i>
            </button>
            <button class="tab-btn">
                <i class="fa-solid fa-clapperboard"></i>
            </button>
        </div>

        <!-- POSTS GRID -->
        <div class="posts-grid">
            @forelse($reports as $report)
                <div class="grid-post-card" onclick="location.href='/'">
                    @if($report->image)
                        <img src="{{ asset('storage/'.$report->image) }}" class="grid-post-img" alt="Post thumbnail">
                    @else
                        <div class="grid-post-overlay">
                            <div class="grid-post-badge"><i class="fa-solid fa-star"></i> 0</div>
                            <div class="grid-post-text">{{ $report->title }}</div>
                        </div>
                    @endif
                </div>
            @empty
                <div class="grid-post-card">
                    <div class="grid-post-overlay">
                        <div class="grid-post-badge"><i class="fa-solid fa-star"></i> 0</div>
                        <div class="grid-post-text">নতুন কোন পোস্ট নেই</div>
                    </div>
                </div>
            @endforelse
        </div>

    </div>

    <!-- FIXED BOTTOM APP NAVIGATION -->
    <div class="bottom-nav">
        <a href="/" class="nav-item">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>
        <a href="#" class="nav-item">
            <i class="fa-solid fa-clapperboard"></i>
            <span>Reels</span>
        </a>
        <a href="/report/create" class="nav-item nav-item-create">
            <i class="fa-solid fa-plus"></i>
            <span>Create</span>
        </a>
        <a href="#" class="nav-item">
            <i class="fa-solid fa-wallet"></i>
            <span>Wallet</span>
        </a>
        <a href="/user/profile" class="nav-item active">
            <i class="fa-solid fa-user"></i>
            <span>Profile</span>
        </a>
    </div>

</body>

</html>
