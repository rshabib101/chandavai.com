<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>রেফারেল লিডারবোর্ড - Chandavai</title>
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
            padding-bottom: 40px;
        }

        /* HEADER */
        .page-header {
            background: #ffffff;
            padding: 14px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .back-btn {
            background: #f1f5f9;
            color: #334155;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 16px;
            transition: all 0.2s;
        }

        .back-btn:hover {
            background: #e2e8f0;
            color: #0f172a;
        }

        .header-title {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
        }

        /* CONTAINER */
        .container {
            max-width: 600px;
            margin: 16px auto;
            padding: 0 14px;
        }

        /* HERO REWARD BANNER */
        .reward-card {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4338ca 100%);
            border-radius: 20px;
            padding: 24px 20px;
            color: #ffffff;
            text-align: center;
            box-shadow: 0 10px 25px rgba(67, 56, 202, 0.3);
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
        }

        .reward-card::before {
            content: '';
            position: absolute;
            top: -30px;
            right: -30px;
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .trophy-badge {
            width: 64px;
            height: 64px;
            background: #fbbf24;
            color: #78350f;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin-bottom: 12px;
            box-shadow: 0 4px 14px rgba(251, 191, 36, 0.4);
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }

        .reward-title {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .reward-amount {
            font-size: 32px;
            font-weight: 900;
            color: #fef08a;
            margin: 6px 0;
            text-shadow: 0 2px 8px rgba(0,0,0,0.3);
        }

        .reward-subtext {
            font-size: 13px;
            color: #e0e7ff;
            opacity: 0.9;
        }

        /* REFERRAL LINK BOX */
        .referral-box {
            background: #ffffff;
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            border: 1px solid #e2e8f0;
        }

        .referral-box-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .referral-title {
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .referral-count-pill {
            background: #e0e7ff;
            color: #4338ca;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 700;
        }

        .link-input-group {
            display: flex;
            gap: 8px;
        }

        .link-input {
            flex: 1;
            background: #f1f5f9;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            padding: 10px 12px;
            font-size: 13px;
            color: #334155;
            outline: none;
        }

        .btn-copy {
            background: #2563eb;
            color: #ffffff;
            border: none;
            border-radius: 10px;
            padding: 0 16px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-copy:hover {
            background: #1d4ed8;
        }

        /* LEADERBOARD CARD */
        .leaderboard-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        .card-header-bar {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 16px;
            font-weight: 800;
            color: #0f172a;
        }

        .leaderboard-list {
            display: flex;
            flex-direction: column;
        }

        .leaderboard-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            border-bottom: 1px solid #f1f5f9;
            transition: background 0.15s;
        }

        .leaderboard-item:last-child {
            border-bottom: none;
        }

        .leaderboard-item:hover {
            background: #f8fafc;
        }

        .user-left-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .rank-badge {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 13px;
            flex-shrink: 0;
        }

        .rank-1 { background: #fef3c7; color: #d97706; border: 1px solid #fcd34d; font-size: 16px; }
        .rank-2 { background: #e2e8f0; color: #475569; border: 1px solid #cbd5e1; font-size: 16px; }
        .rank-3 { background: #ffedd5; color: #c2410c; border: 1px solid #fed7aa; font-size: 16px; }
        .rank-other { background: #f1f5f9; color: #64748b; }

        .avatar-initial {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0284c7, #2563eb);
            color: #ffffff;
            font-weight: 700;
            font-size: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .user-name-text {
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
        }

        .referral-stat-right {
            text-align: right;
        }

        .stat-count {
            font-size: 15px;
            font-weight: 800;
            color: #2563eb;
        }

        .stat-label {
            font-size: 11px;
            color: #64748b;
        }

        .empty-msg {
            padding: 30px;
            text-align: center;
            color: #64748b;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <header class="page-header">
        <a href="/" class="back-btn" title="Back to Home">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h1 class="header-title">🏆 রেফারেল লিডারবোর্ড</h1>
        <div style="width: 36px;"></div>
    </header>

    <div class="container">

        <!-- HERO REWARD BANNER -->
        <div class="reward-card">
            <div class="trophy-badge">🏆</div>
            <h2 class="reward-title">চলতি মাসের সেরা রেফারার রেওয়ার্ড</h2>
            <div class="reward-amount">৳ {{ number_format($rewardAmount) }} টাকা</div>
            <p class="reward-subtext">এই ১ মাসের মধ্যে সর্বোচ্চ রেফারকারিকে দেয়া হবে ১০০০ টাকা বোনাস!</p>
        </div>

        <!-- USER PERSONAL REFERRAL LINK -->
        @auth
            <div class="referral-box">
                <div class="referral-box-header">
                    <span class="referral-title"><i class="fa-solid fa-link" style="color: #2563eb;"></i> আপনার রেফারেল লিংক</span>
                    <span class="referral-count-pill">এই মাসে রেফার: {{ $currentUser->monthly_referrals_count ?? 0 }} জন</span>
                </div>
                <div class="link-input-group">
                    <input type="text" id="myReferralLink" class="link-input" value="{{ $currentUser->referral_link }}" readonly>
                    <button type="button" class="btn-copy" onclick="copyReferralLink()">
                        <i class="fa-regular fa-copy"></i> কপি
                    </button>
                </div>
            </div>
        @else
            <div class="referral-box" style="text-align: center; padding: 20px;">
                <p style="font-size: 14px; color: #475569; margin-bottom: 12px;">আপনার নিজস্ব রেফারেল লিংক পেতে লগইন অথবা রেজিস্ট্রেশন করুন</p>
                <a href="/register" class="btn-copy" style="display: inline-flex; text-decoration: none; padding: 10px 20px;">
                    <i class="fa-solid fa-user-plus"></i> অ্যাকাউন্ট খুলুন
                </a>
            </div>
        @endauth

        <!-- MONTHLY LEADERBOARD CARD -->
        <div class="leaderboard-card">
            <div class="card-header-bar">
                <span class="card-title">📅 চলতি মাসের সেরা রেফারকারি</span>
                <span style="font-size: 12px; color: #64748b; font-weight: 600;">{{ now()->format('F Y') }}</span>
            </div>

            <div class="leaderboard-list">
                @forelse($monthlyLeaderboard as $index => $user)
                    <div class="leaderboard-item">
                        <div class="user-left-info">
                            @if($index == 0)
                                <div class="rank-badge rank-1">🥇</div>
                            @elseif($index == 1)
                                <div class="rank-badge rank-2">🥈</div>
                            @elseif($index == 2)
                                <div class="rank-badge rank-3">🥉</div>
                            @else
                                <div class="rank-badge rank-other">{{ $index + 1 }}</div>
                            @endif
                            
                            <div class="avatar-initial">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>

                            <div class="user-name-text">
                                {{ $user->name }}
                                @if(auth()->check() && auth()->id() == $user->id)
                                    <span style="font-size: 11px; background: #dcfce7; color: #15803d; padding: 2px 6px; border-radius: 8px; margin-left: 4px;">আপনি</span>
                                @endif
                            </div>
                        </div>

                        <div class="referral-stat-right">
                            <div class="stat-count">{{ $user->monthly_referrals_count }} জন</div>
                            <div class="stat-label">সফল রেফার</div>
                        </div>
                    </div>
                @empty
                    <div class="empty-msg">
                        <i class="fa-solid fa-users-slash" style="font-size: 24px; color: #cbd5e1; margin-bottom: 8px; display: block;"></i>
                        এই মাসে এখনো কোনো রেফার রেকর্ড হয়নি। আপনার লিংক শেয়ার করে প্রথম স্থান দখল করুন!
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    <script>
        function copyReferralLink() {
            const input = document.getElementById('myReferralLink');
            input.select();
            input.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(input.value).then(() => {
                alert('রেফারেল লিংক কপি হয়েছে!');
            }).catch(err => {
                document.execCommand('copy');
                alert('রেফারেল লিংক কপি হয়েছে!');
            });
        }
    </script>
</body>
</html>
