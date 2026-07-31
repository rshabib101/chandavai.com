<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deshboard Analytics</title>
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
            background-color: #0b0f17;
            font-family: 'Inter', sans-serif;
            color: #ffffff;
            padding-bottom: 80px;
            min-height: 100vh;
        }

        .analytics-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 16px;
        }

        /* HEADER */
        .analytics-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 24px;
            padding: 6px 0;
        }

        .back-btn-link {
            color: #ffffff;
            font-size: 20px;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            transition: background 0.2s;
        }

        .back-btn-link:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .header-title {
            font-size: 22px;
            font-weight: 700;
            color: #ffffff;
        }

        /* SECTION TITLE */
        .section-title-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #ffffff;
        }

        .info-icon {
            font-size: 14px;
            color: #64748b;
            cursor: pointer;
        }

        /* STATS GRID */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: #161b26;
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 16px;
            padding: 16px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 110px;
            position: relative;
            cursor: pointer;
            transition: transform 0.2s, background 0.2s;
        }

        .stat-card:hover {
            background: #1c2331;
            transform: translateY(-2px);
        }

        .stat-card-full {
            grid-column: span 1;
        }

        .stat-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-label {
            font-size: 14px;
            font-weight: 500;
            color: #94a3b8;
        }

        .stat-arrow {
            font-size: 12px;
            color: #64748b;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 800;
            color: #ffffff;
        }

        /* PROGRESS CARD */
        .progress-card {
            background: #161b26;
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 20px;
            padding: 20px;
            margin-top: 10px;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .progress-title {
            font-size: 17px;
            font-weight: 700;
            color: #ffffff;
        }

        .progress-percent {
            font-size: 16px;
            font-weight: 700;
            color: #ffffff;
        }

        .progress-track {
            width: 100%;
            height: 10px;
            background: #0f141d;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 24px;
        }

        .progress-fill {
            height: 100%;
            width: 24%;
            background: #84cc16;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(132, 204, 22, 0.4);
        }

        /* GOALS LIST */
        .goals-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .goal-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 15px;
            color: #cbd5e1;
            font-weight: 500;
        }

        .goal-count {
            font-weight: 600;
            color: #94a3b8;
            font-size: 14px;
        }

        /* BOTTOM APP NAVIGATION */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #111622;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 8px 0 10px 0;
            z-index: 1000;
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
            color: #ffffff;
        }

        .nav-item.active i {
            color: #ffffff;
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

    <div class="analytics-container">

        <!-- HEADER -->
        <div class="analytics-header">
            <a href="/user/profile" class="back-btn-link" title="Back to Profile">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
            <h1 class="header-title">Deshboard</h1>
        </div>

        <!-- SECTION TITLE -->
        <div class="section-title-wrap">
            <h2 class="section-title">Analytics</h2>
            <i class="fa-regular fa-circle-question info-icon" title="Analytics info"></i>
        </div>

        <!-- STATS GRID -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-card-header">
                    <span class="stat-label">Views</span>
                    <i class="fa-solid fa-chevron-right stat-arrow"></i>
                </div>
                <div class="stat-value">3</div>
            </div>

            <div class="stat-card">
                <div class="stat-card-header">
                    <span class="stat-label">Engagement</span>
                    <i class="fa-solid fa-chevron-right stat-arrow"></i>
                </div>
                <div class="stat-value">2</div>
            </div>

            <div class="stat-card">
                <div class="stat-card-header">
                    <span class="stat-label">Reactions</span>
                    <i class="fa-solid fa-chevron-right stat-arrow"></i>
                </div>
                <div class="stat-value">2</div>
            </div>

            <div class="stat-card">
                <div class="stat-card-header">
                    <span class="stat-label">Follower</span>
                    <i class="fa-solid fa-chevron-right stat-arrow"></i>
                </div>
                <div class="stat-value">6</div>
            </div>

            <div class="stat-card stat-card-full">
                <div class="stat-card-header">
                    <span class="stat-label">Verified Follower</span>
                    <i class="fa-solid fa-chevron-right stat-arrow"></i>
                </div>
                <div class="stat-value">0</div>
            </div>
        </div>

        <!-- PROGRESS CARD -->
        <div class="progress-card">
            <div class="progress-header">
                <span class="progress-title">Your weekly progress</span>
                <span class="progress-percent">24%</span>
            </div>
            <div class="progress-track">
                <div class="progress-fill"></div>
            </div>

            <div class="goals-list">
                <div class="goal-item">
                    <span>Create 5 new public reels</span>
                    <span class="goal-count">0/5</span>
                </div>
                <div class="goal-item">
                    <span>Get 10 new followers</span>
                    <span class="goal-count">6/10</span>
                </div>
                <div class="goal-item">
                    <span>Reply to 10 comments</span>
                    <span class="goal-count">0/10</span>
                </div>
            </div>
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
        <a href="/user/analytics" class="nav-item active">
            <i class="fa-solid fa-chart-line"></i>
            <span>Analytics</span>
        </a>
        <a href="/user/profile" class="nav-item">
            <i class="fa-solid fa-user"></i>
            <span>Profile</span>
        </a>
    </div>

</body>

</html>
