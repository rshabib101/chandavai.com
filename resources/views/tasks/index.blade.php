<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Task Hub - Chanda Vai</title>

    <!-- Google Fonts & FontAwesome -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            background-color: #f0f2f5;
            color: #0f172a;
            padding-bottom: 50px;
        }

        .app-container {
            max-width: 680px;
            margin: 0 auto;
            padding: 12px;
        }

        /* TOP NAVIGATION */
        .top-nav-bar {
            background: #ffffff;
            border-radius: 16px;
            padding: 12px 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
            margin-bottom: 14px;
            border: 1px solid #e2e8f0;
        }

        .nav-back-btn {
            background: #f1f5f9;
            color: #475569;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 15px;
            transition: all 0.2s;
        }

        .nav-back-btn:hover {
            background: #e2e8f0;
            color: #0f172a;
        }

        .nav-page-title {
            font-size: 17px;
            font-weight: 800;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .points-badge-pill {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: #ffffff;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 6px rgba(245, 158, 11, 0.3);
        }

        /* CATEGORY FILTER PILLS */
        .categories-section {
            margin-bottom: 16px;
        }

        .categories-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
            overflow-x: auto;
            padding-bottom: 4px;
            scrollbar-width: none;
        }

        .categories-wrapper::-webkit-scrollbar {
            display: none;
        }

        .category-pill {
            background: #ffffff;
            color: #64748b;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13.5px;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
            border: 1px solid #e2e8f0;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .category-pill.active {
            background: #1877f2;
            color: #ffffff;
            border-color: #1877f2;
            box-shadow: 0 2px 8px rgba(24, 119, 242, 0.25);
        }

        /* TASK HERO HEADER */
        .task-hero-card {
            background: linear-gradient(135deg, #0f172a, #1e293b);
            color: #ffffff;
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.15);
            position: relative;
            overflow: hidden;
        }

        .task-hero-card::after {
            content: '🎯';
            position: absolute;
            right: 15px;
            bottom: 5px;
            font-size: 85px;
            opacity: 0.12;
            pointer-events: none;
        }

        .hero-tag {
            background: rgba(59, 130, 246, 0.2);
            color: #60a5fa;
            border: 1px solid rgba(96, 165, 250, 0.3);
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 12px;
            display: inline-block;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .hero-title {
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .hero-sub {
            font-size: 13.5px;
            color: #94a3b8;
            line-height: 1.5;
        }

        /* 4 TASK CATEGORIES GRID */
        .tasks-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 16px;
        }

        .task-category-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 20px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
            transition: all 0.25s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .task-category-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
            border-color: #cbd5e1;
        }

        .card-top-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .icon-box {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .reward-badge {
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
            background: #f1f5f9;
            color: #475569;
        }

        .card-cat-title {
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 2px;
        }

        .card-cat-sub {
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 8px;
        }

        .card-cat-desc {
            font-size: 13px;
            color: #475569;
            line-height: 1.45;
            margin-bottom: 18px;
        }

        .btn-start-task {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s;
            color: #ffffff;
            text-decoration: none;
        }

        .btn-start-task:active {
            transform: scale(0.98);
        }

        /* COLOR THEMES FOR CARDS */
        .card-works .icon-box { background: #eff6ff; color: #2563eb; }
        .card-works .btn-start-task { background: linear-gradient(135deg, #0099ff, #0077ff); box-shadow: 0 4px 12px rgba(0, 153, 255, 0.25); }

        .card-math .icon-box { background: #fdf2f8; color: #db2777; }
        .card-math .btn-start-task { background: linear-gradient(135deg, #db2777, #be185d); box-shadow: 0 4px 12px rgba(219, 39, 119, 0.25); }

        .card-typing .icon-box { background: #f0fdf4; color: #16a34a; }
        .card-typing .btn-start-task { background: linear-gradient(135deg, #16a34a, #15803d); box-shadow: 0 4px 12px rgba(22, 163, 74, 0.25); }

        .card-link .icon-box { background: #fff7ed; color: #ea580c; }
        .card-link .btn-start-task { background: linear-gradient(135deg, #ea580c, #c2410c); box-shadow: 0 4px 12px rgba(234, 88, 12, 0.25); }

        /* MODAL STYLES */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(4px);
            z-index: 2500;
            align-items: center;
            justify-content: center;
            padding: 12px;
        }

        .modal-card {
            background: #f8fafc;
            border-radius: 28px;
            width: 100%;
            max-width: 480px;
            max-height: 92vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            animation: popIn 0.25s ease;
        }

        @keyframes popIn {
            from { transform: scale(0.92); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        /* WORKS MODAL HEADER */
        .works-modal-header {
            background: #0099ff;
            color: #ffffff;
            padding: 20px 18px 14px 18px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .works-top-row {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .works-close-btn {
            background: rgba(255, 255, 255, 0.25);
            border: none;
            color: #ffffff;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            font-weight: 800;
            font-size: 15px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .works-close-btn:hover {
            background: rgba(255, 255, 255, 0.4);
        }

        .works-header-title {
            font-size: 20px;
            font-weight: 800;
            color: #ffffff;
        }

        .works-tab-pills {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .works-tab-pill {
            padding: 8px 18px;
            border-radius: 20px;
            font-size: 13.5px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .works-tab-pill.active {
            background: rgba(255, 255, 255, 0.25);
            color: #ffffff;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.3);
        }

        .works-tab-pill:not(.active) {
            background: #ffffff;
            color: #0099ff;
        }

        .modal-header {
            padding: 16px 20px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #ffffff;
        }

        .modal-title {
            font-size: 17px;
            font-weight: 800;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .modal-close-btn {
            background: #f1f5f9;
            border: none;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            cursor: pointer;
            font-weight: 700;
            color: #475569;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-body {
            padding: 20px;
            overflow-y: auto;
            flex: 1;
        }

        /* WORK CARDS STYLING */
        .work-task-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            padding: 16px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
        }

        .work-task-card:hover {
            border-color: #0099ff;
            box-shadow: 0 4px 12px rgba(0, 153, 255, 0.12);
            transform: translateY(-1px);
        }

        .work-card-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 14px;
        }

        .work-card-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .work-icon-box {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: #e0f2fe;
            color: #0284c7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .work-title-text {
            font-size: 15px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .work-cat-badge {
            background: #e0f2fe;
            color: #0284c7;
            font-size: 10.5px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 8px;
            display: inline-block;
            text-transform: uppercase;
        }

        .work-reward-text {
            color: #10b981;
            font-size: 15px;
            font-weight: 800;
            white-space: nowrap;
        }

        .work-card-bottom {
            border-top: 1px solid #f1f5f9;
            padding-top: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 12.5px;
        }

        .work-slots-count {
            color: #64748b;
            font-weight: 600;
        }

        .work-remaining-slots {
            color: #0099ff;
            font-weight: 700;
        }

        /* ==================== QUIZ & MATH STYLING (MATCHING SCREENSHOT) ==================== */
        .quiz-header-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            background: #ffffff;
            border-bottom: 1px solid #f1f5f9;
        }

        .quiz-back-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            color: #0f172a;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: all 0.2s;
        }

        .quiz-back-btn:hover {
            background: #f1f5f9;
        }

        .quiz-header-title {
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
        }

        .quiz-coin-badge {
            background: #fef3c7;
            color: #d97706;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13.5px;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* QUESTION CARD */
        .quiz-question-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 24px 20px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.03);
            border: 1px solid #e2e8f0;
            text-align: center;
            margin-bottom: 20px;
        }

        .quiz-progress-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .quiz-progress-track {
            flex: 1;
            height: 8px;
            background: #f1f5f9;
            border-radius: 10px;
            overflow: hidden;
        }

        .quiz-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #ec4899, #db2777);
            border-radius: 10px;
            width: 10%;
            transition: width 0.3s ease;
        }

        .quiz-progress-text {
            font-size: 13px;
            font-weight: 700;
            color: #64748b;
        }

        .quiz-solve-label {
            font-size: 13.5px;
            color: #64748b;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .quiz-math-equation {
            font-size: 38px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: 1px;
        }

        /* 2x2 OPTIONS GRID */
        .quiz-options-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 16px;
        }

        .math-option-btn {
            background: #ffffff;
            border: 2px solid #e2e8f0;
            border-radius: 18px;
            padding: 16px 10px;
            font-size: 24px;
            font-weight: 800;
            color: #0f172a;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 64px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03);
        }

        .math-option-btn:hover {
            border-color: #cbd5e1;
            transform: translateY(-1px);
        }

        .math-option-btn.correct {
            background: #dcfce7 !important;
            border-color: #22c55e !important;
            color: #15803d !important;
        }

        .math-option-btn.wrong {
            background: #fee2e2 !important;
            border-color: #ef4444 !important;
            color: #b91c1c !important;
        }

        .quiz-feedback-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 18px;
            border-radius: 20px;
            font-size: 13.5px;
            font-weight: 700;
            margin-top: 4px;
            margin-bottom: 12px;
        }

        .quiz-feedback-pill.correct {
            background: #dcfce7;
            color: #15803d;
        }

        .quiz-feedback-pill.wrong {
            background: #fee2e2;
            color: #b91c1c;
        }

        .btn-quiz-next {
            width: 100%;
            padding: 14px;
            border-radius: 26px;
            font-size: 16px;
            font-weight: 800;
            border: none;
            cursor: pointer;
            color: #ffffff;
            background: linear-gradient(135deg, #ec4899, #db2777);
            box-shadow: 0 4px 14px rgba(219, 39, 119, 0.3);
            transition: all 0.2s;
        }

        .btn-quiz-next:active {
            transform: scale(0.98);
        }

        /* TOAST NOTIFICATION */
        .toast-msg {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%) translateY(-100px);
            background: #0f172a;
            color: #ffffff;
            padding: 12px 20px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            z-index: 5500;
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .toast-msg.show {
            transform: translateX(-50%) translateY(0);
        }
    </style>
</head>

<body>

    <div class="app-container">

        <!-- TOP NAVIGATION BAR -->
        <div class="top-nav-bar">
            <a href="/" class="nav-back-btn" title="Back to Feed">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h1 class="nav-page-title">
                <i class="fa-solid fa-boxes-stacked" style="color:#1877f2;"></i>
                Task Hub
            </h1>
            <div class="points-badge-pill">
                ⭐ <span id="headerPointsVal">{{ $userPoints }}</span> Pts
            </div>
        </div>

        <!-- CATEGORY FILTER PILLS -->
        <div class="categories-section">
            <div class="categories-wrapper">
                <a href="/" class="category-pill">
                    <i class="fa-solid fa-wand-magic-sparkles"></i> For you
                </a>
                <a href="/reels" class="category-pill">
                    <i class="fa-solid fa-clapperboard" style="color: #ef4444;"></i> Reels
                </a>
                <a href="/tasks" class="category-pill active">
                    <i class="fa-regular fa-rectangle-list"></i> Tasks
                </a>
                <a href="#" class="category-pill">
                    <i class="fa-solid fa-trophy"></i> Contest
                </a>
                <a href="/referral-leaderboard" class="category-pill">
                    <i class="fa-solid fa-gift"></i> Refer & Win ৳1000
                </a>
            </div>
        </div>

        <!-- HERO HEADER -->
        <div class="task-hero-card">
            <span class="hero-tag">Earn Rewards</span>
            <h2 class="hero-title">ডেইলি টাস্ক ও আর্নিং হাব 🚀</h2>
            <p class="hero-sub">নিচের ৪টি ক্যাটাগরি থেকে টাস্কগুলো সম্পন্ন করে আনলিমিটেড পয়েন্ট অর্জন করুন।</p>
        </div>

        <!-- 4 TASK CATEGORIES GRID -->
        <div class="tasks-grid">

            <!-- 1. WORKS -->
            <div class="task-category-card card-works">
                <div>
                    <div class="card-top-row">
                        <div class="icon-box">
                            <i class="fa-solid fa-briefcase"></i>
                        </div>
                        <span class="reward-badge">Up to 500 Pts / Work</span>
                    </div>
                    <div class="card-cat-title">Works</div>
                    <div class="card-cat-sub">মাইক্রো জবস ও প্রমোশনাল টাস্ক</div>
                    <div class="card-cat-desc">
                        সহজ সোশ্যাল মিডিয়া টাস্ক, সাবস্ক্রিপশন ও প্রমোশনাল জবস সম্পন্ন করে বড় অঙ্কের পয়েন্ট যোগ করুন।
                    </div>
                </div>
                <button type="button" class="btn-start-task" onclick="openWorksModal()">
                    <i class="fa-solid fa-circle-play"></i> Start Works
                </button>
            </div>

            <!-- 2. MATH SOLVE -->
            <div class="task-category-card card-math">
                <div>
                    <div class="card-top-row">
                        <div class="icon-box">
                            <i class="fa-solid fa-calculator"></i>
                        </div>
                        <span class="reward-badge">10 Pts / Question (100 Pts Max)</span>
                    </div>
                    <div class="card-cat-title">Math Solve</div>
                    <div class="card-cat-sub">১০টি ম্যাথ সলভ সেশন</div>
                    <div class="card-cat-desc">
                        প্রতিটি ম্যাথ সলভ করে বিজ্ঞাপন শেষে পয়েন্ট পান। ১০টি ম্যাথ সলভ করে সর্বোচ্চ ১০০ পয়েন্ট আয় করুন!
                    </div>
                </div>
                <button type="button" class="btn-start-task" onclick="openMathModal()">
                    <i class="fa-solid fa-brain"></i> Solve Math
                </button>
            </div>

            <!-- 3. TYPING -->
            <div class="task-category-card card-typing">
                <div>
                    <div class="card-top-row">
                        <div class="icon-box">
                            <i class="fa-solid fa-keyboard"></i>
                        </div>
                        <span class="reward-badge">10 Pts / Word (100 Pts Max)</span>
                    </div>
                    <div class="card-cat-title">Typing</div>
                    <div class="card-cat-sub">১০টি ছোট ওয়ার্ড টাইপিং সেশন</div>
                    <div class="card-cat-desc">
                        সহজ ছোট ছোট শব্দ (যেমন: football, sky) টাইপ করে ১০টি রাউন্ডে ১০০ পয়েন্ট রিওয়ার্ড আয় করুন।
                    </div>
                </div>
                <button type="button" class="btn-start-task" onclick="openTypingModal()">
                    <i class="fa-solid fa-bolt"></i> Start Typing
                </button>
            </div>

            <!-- 4. LINK HITS -->
            <div class="task-category-card card-link">
                <div>
                    <div class="card-top-row">
                        <div class="icon-box">
                            <i class="fa-solid fa-arrow-pointer"></i>
                        </div>
                        <span class="reward-badge">20 Pts / Hit</span>
                    </div>
                    <div class="card-cat-title">Link Hits</div>
                    <div class="card-cat-sub">স্পন্সরড লিঙ্ক ভিজিট</div>
                    <div class="card-cat-desc">
                        স্পন্সরড ওয়েবসাইট ভিজিট করে ১০ সেকেন্ড কাউন্টডাউন শেষেই বোনাস পয়েন্ট রিওয়ার্ড পেয়ে যান।
                    </div>
                </div>
                <button type="button" class="btn-start-task" onclick="openLinkHitModal()">
                    <i class="fa-solid fa-globe"></i> Visit Link Hits
                </button>
            </div>

        </div>

    </div>

    <!-- ==================== MODALS FOR 4 OPTIONS ==================== -->

    <!-- 1. DYNAMIC WORKS MODAL -->
    <div id="worksModal" class="modal-overlay">
        <div class="modal-card">
            <!-- BLUE HEADER WITH TAB SWITCHER -->
            <div class="works-modal-header">
                <div class="works-top-row">
                    <button type="button" class="works-close-btn" onclick="closeModal('worksModal')">✕</button>
                    <div class="works-header-title">টাস্ক মার্কেট</div>
                </div>
                <div class="works-tab-pills">
                    <button type="button" id="tabBtnAvailable" class="works-tab-pill active" onclick="switchWorksTab('available')">উপলব্ধ কাজ</button>
                    <button type="button" id="tabBtnSubmissions" class="works-tab-pill" onclick="switchWorksTab('submissions')">আমার সাবমিশন</button>
                </div>
            </div>

            <div class="modal-body">
                <!-- TAB 1: AVAILABLE WORKS LIST VIEW -->
                <div id="worksAvailableTab">
                    <!-- TASK LIST VIEW -->
                    <div id="worksListView">
                        @forelse($microWorks as $work)
                            <div class="work-task-card" onclick="openWorkDetail({{ $work->id }})">
                                <div class="work-card-top">
                                    <div class="work-card-left">
                                        <div class="work-icon-box">
                                            <i class="fa-solid fa-globe"></i>
                                        </div>
                                        <div>
                                            <div class="work-title-text">{{ $work->title }}</div>
                                            <span class="work-cat-badge">{{ $work->category }}</span>
                                        </div>
                                    </div>
                                    <div class="work-reward-text">{{ $work->reward_coins }} কয়েন</div>
                                </div>
                                <div class="work-card-bottom">
                                    <span class="work-slots-count">{{ $work->approved_submissions_count }}/{{ $work->total_slots }}</span>
                                    <span class="work-remaining-slots">বাকি স্লট: {{ $work->remaining_slots }} জন</span>
                                </div>
                            </div>
                        @empty
                            <div style="text-align: center; padding: 40px 10px; color: #64748b;">
                                <i class="fa-solid fa-folder-open" style="font-size: 40px; margin-bottom: 10px; color: #cbd5e1;"></i>
                                <div style="font-weight: 700; font-size: 15px;">বর্তমানে কোনো কাজ উপলব্ধ নেই</div>
                                <div style="font-size: 13px; margin-top: 4px;">অল্প কিছুক্ষন পর আবার চেষ্টা করুন।</div>
                            </div>
                        @endforelse
                    </div>

                    <!-- TASK DETAIL & PROOF SUBMISSION VIEW -->
                    <div id="workDetailView" style="display: none;">
                        <button type="button" onclick="showWorksList()" style="background: none; border: none; font-size: 14px; font-weight: 700; color: #0099ff; cursor: pointer; display: flex; align-items: center; gap: 6px; margin-bottom: 14px;">
                            <i class="fa-solid fa-arrow-left"></i> সকল কাজে ফিরে যান
                        </button>

                        <div id="workDetailContent">
                            <!-- Populated dynamically via JS -->
                        </div>
                    </div>
                </div>

                <!-- TAB 2: MY SUBMISSIONS VIEW -->
                <div id="worksSubmissionsTab" style="display: none;">
                    @forelse($mySubmissions as $sub)
                        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 14px; margin-bottom: 12px;">
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                                <strong style="font-size: 14.5px; color: #0f172a;">{{ $sub->microWork ? $sub->microWork->title : 'Task' }}</strong>
                                @if($sub->status === 'pending')
                                    <span style="background: #fef3c7; color: #d97706; font-size: 11px; font-weight: 800; padding: 3px 10px; border-radius: 12px;">⏳ পেন্ডিং</span>
                                @elseif($sub->status === 'approved')
                                    <span style="background: #d1fae5; color: #059669; font-size: 11px; font-weight: 800; padding: 3px 10px; border-radius: 12px;">✅ অনুমোদিত (+{{ $sub->microWork ? $sub->microWork->reward_coins : 0 }} Pts)</span>
                                @else
                                    <span style="background: #fee2e2; color: #dc2626; font-size: 11px; font-weight: 800; padding: 3px 10px; border-radius: 12px;">❌ বাতিল</span>
                                @endif
                            </div>
                            <div style="font-size: 12px; color: #64748b; margin-bottom: 8px;">
                                📅 {{ $sub->created_at->format('d M Y, h:i A') }}
                            </div>
                            @if($sub->proof_screenshot_url)
                                <div style="margin-top: 8px;">
                                    <a href="{{ $sub->proof_screenshot_url }}" target="_blank" style="font-size: 12px; color: #0099ff; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                                        <i class="fa-solid fa-image"></i> জমা দেওয়া প্রুফ স্ক্রিনশট দেখুন
                                    </a>
                                </div>
                            @endif
                            @if($sub->status === 'rejected' && $sub->rejection_reason)
                                <div style="margin-top: 6px; font-size: 12px; color: #dc2626; background: #fff5f5; padding: 8px; border-radius: 8px;">
                                    <strong>বাতিলের কারণ:</strong> {{ $sub->rejection_reason }}
                                </div>
                            @endif
                        </div>
                    @empty
                        <div style="text-align: center; padding: 40px 10px; color: #64748b;">
                            <i class="fa-solid fa-paper-plane" style="font-size: 40px; margin-bottom: 10px; color: #cbd5e1;"></i>
                            <div style="font-weight: 700; font-size: 15px;">আপনি এখনো কোনো কাজ জমা দেননি</div>
                            <div style="font-size: 13px; margin-top: 4px;">"উপলব্ধ কাজ" থেকে কাজ সম্পন্ন করুন।</div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- 2. MATH SOLVE MODAL (MATCHING SCREENSHOT) -->
    <div id="mathModal" class="modal-overlay">
        <div class="modal-card">
            <!-- HEADER matching screenshot -->
            <div class="quiz-header-bar">
                <button type="button" class="quiz-back-btn" onclick="closeModal('mathModal')" title="Close">
                    <i class="fa-solid fa-arrow-left"></i>
                </button>
                <div class="quiz-header-title">Math Solve</div>
                <div class="quiz-coin-badge">
                    🪙 <span id="mathUserCoinsDisplay">{{ $userPoints }}</span>
                </div>
            </div>

            <div class="modal-body">
                <!-- QUESTION SCREEN (1/10 to 10/10) -->
                <div id="mathQuestionScreen">
                    <div class="quiz-question-card">
                        <div class="quiz-progress-row">
                            <div class="quiz-progress-track">
                                <div id="mathProgressBar" class="quiz-progress-fill" style="width: 10%;"></div>
                            </div>
                            <div id="mathStepText" class="quiz-progress-text">1/10</div>
                        </div>

                        <div class="quiz-solve-label">Solve this</div>
                        <div id="mathEquationText" class="quiz-math-equation">
                            41 - 25 = ?
                        </div>
                    </div>

                    <!-- 2x2 OPTIONS GRID -->
                    <div id="mathOptionsGrid" class="quiz-options-grid">
                        <!-- Populated dynamically via JS -->
                    </div>

                    <!-- FEEDBACK BADGE -->
                    <div style="text-align: center;">
                        <div id="mathFeedbackBadge" class="quiz-feedback-pill" style="display: none;">
                            <i class="fa-solid fa-check"></i> Correct answer!
                        </div>
                    </div>

                    <!-- NEXT BUTTON -->
                    <button type="button" id="mathNextBtn" class="btn-quiz-next" onclick="onMathNextClick()">
                        Next →
                    </button>
                </div>

                <!-- RESULT SUMMARY SCREEN -->
                <div id="mathResultScreen" style="display: none; text-align: center; padding: 20px 10px;">
                    <div style="font-size: 60px; margin-bottom: 10px;">🏆</div>
                    <h3 style="font-size: 22px; font-weight: 800; color: #0f172a; margin-bottom: 6px;">ম্যাথ কুইজ সম্পন্ন হয়েছে!</h3>
                    <p style="font-size: 14px; color: #64748b; margin-bottom: 20px;">১০টি গাণিতিক প্রশ্নের সেশন শেষ হয়েছে।</p>

                    <div style="background: #ffffff; border: 2px solid #f1f5f9; border-radius: 20px; padding: 20px; margin-bottom: 20px;">
                        <div style="font-size: 13px; font-weight: 700; color: #64748b;">আপনার স্কোর:</div>
                        <div id="mathScoreText" style="font-size: 38px; font-weight: 800; color: #db2777; margin: 4px 0;">8 / 10</div>
                        <div id="mathEarnedPointsText" style="font-size: 16px; font-weight: 800; color: #16a34a;">+80 Pts</div>
                    </div>

                    <button type="button" onclick="startMathSession()" class="btn-quiz-next">
                        নতুন রাউন্ড খেলুন 🔄
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. TYPING MODAL (MATCHING 10-WORD SESSION) -->
    <div id="typingModal" class="modal-overlay">
        <div class="modal-card">
            <!-- HEADER -->
            <div class="quiz-header-bar">
                <button type="button" class="quiz-back-btn" onclick="closeModal('typingModal')" title="Close">
                    <i class="fa-solid fa-arrow-left"></i>
                </button>
                <div class="quiz-header-title">Typing Challenge</div>
                <div class="quiz-coin-badge">
                    🪙 <span id="typingUserCoinsDisplay">{{ $userPoints }}</span>
                </div>
            </div>

            <div class="modal-body">
                <!-- QUESTION SCREEN -->
                <div id="typingQuestionScreen">
                    <div class="quiz-question-card">
                        <div class="quiz-progress-row">
                            <div class="quiz-progress-track">
                                <div id="typingProgressBar" class="quiz-progress-fill" style="width: 10%; background: linear-gradient(90deg, #22c55e, #16a34a);"></div>
                            </div>
                            <div id="typingStepText" class="quiz-progress-text">1/10</div>
                        </div>

                        <div class="quiz-solve-label">Type this word</div>
                        <div id="typingTargetWordText" class="quiz-math-equation" style="color: #16a34a; font-size: 34px;">
                            football
                        </div>
                    </div>

                    <!-- INPUT FIELD -->
                    <div style="margin-bottom: 16px;">
                        <input type="text" id="typingInputWordField" placeholder="শব্দটি টাইপ করুন..." style="width: 100%; padding: 16px; border-radius: 18px; border: 2px solid #e2e8f0; font-size: 20px; font-weight: 700; text-align: center; outline: none; background: #ffffff;" onkeydown="if(event.key==='Enter') submitTypingWordAnswer()">
                    </div>

                    <!-- FEEDBACK BADGE -->
                    <div style="text-align: center;">
                        <div id="typingFeedbackBadge" class="quiz-feedback-pill" style="display: none;">
                            <i class="fa-solid fa-check"></i> Correct word!
                        </div>
                    </div>

                    <!-- SUBMIT / NEXT BUTTON -->
                    <button type="button" id="typingSubmitBtn" class="btn-quiz-next" style="background: linear-gradient(135deg, #16a34a, #15803d); box-shadow: 0 4px 14px rgba(22, 163, 74, 0.3);" onclick="submitTypingWordAnswer()">
                        Submit Answer ⚡
                    </button>
                </div>

                <!-- RESULT SUMMARY SCREEN -->
                <div id="typingResultScreen" style="display: none; text-align: center; padding: 20px 10px;">
                    <div style="font-size: 60px; margin-bottom: 10px;">⚡</div>
                    <h3 style="font-size: 22px; font-weight: 800; color: #0f172a; margin-bottom: 6px;">টাইপিং সেশন সম্পন্ন হয়েছে!</h3>
                    <p style="font-size: 14px; color: #64748b; margin-bottom: 20px;">১০টি শব্দের টাইপিং স্পিড টেস্ট শেষ হয়েছে।</p>

                    <div style="background: #ffffff; border: 2px solid #f1f5f9; border-radius: 20px; padding: 20px; margin-bottom: 20px;">
                        <div style="font-size: 13px; font-weight: 700; color: #64748b;">আপনার স্কোর:</div>
                        <div id="typingScoreText" style="font-size: 38px; font-weight: 800; color: #16a34a; margin: 4px 0;">9 / 10</div>
                        <div id="typingEarnedPointsText" style="font-size: 16px; font-weight: 800; color: #16a34a;">+90 Pts</div>
                    </div>

                    <button type="button" onclick="startTypingSession()" class="btn-quiz-next" style="background: linear-gradient(135deg, #16a34a, #15803d);">
                        পুনরায় টাইপ খেলুন 🔄
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. LINK HITS MODAL -->
    <div id="linkHitModal" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-header">
                <div class="modal-title">
                    🔗 Sponsored Link Hits
                </div>
                <button type="button" class="modal-close-btn" onclick="closeModal('linkHitModal')">✕</button>
            </div>
            <div class="modal-body">
                <div style="font-size: 13px; color: #64748b; margin-bottom: 14px;">লিংক ভিজিট করে নির্দিষ্ট সময় অপেক্ষা করলেই পাবেন পয়েন্ট:</div>

                <div style="display: flex; flex-direction: column; gap: 12px;">
                    @forelse($linkHits as $hit)
                        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 14px; display: flex; align-items: center; justify-content: space-between; gap: 12px;">
                            <div>
                                <div style="font-weight: 700; font-size: 14px; color: #9a3412;">{{ $hit->title }}</div>
                                <div style="font-size: 11px; color: #ea580c; margin-top: 2px;">{{ Str::limit($hit->url, 35) }}</div>
                            </div>
                            <button type="button" onclick="startLinkHit('{{ $hit->url }}', {{ $hit->reward_points }}, {{ $hit->timer_seconds }})" style="background: #ea580c; color: #fff; border: none; padding: 8px 14px; border-radius: 8px; font-weight: 700; font-size: 12.5px; cursor: pointer; white-space: nowrap;">+{{ $hit->reward_points }} Pts</button>
                        </div>
                    @empty
                        <div style="text-align: center; padding: 20px; color: #64748b;">কোনো লিংক হিট উপলব্ধ নেই।</div>
                    @endforelse
                </div>

                <div id="linkCountdownBox" style="display: none; margin-top: 16px; background: #fff7ed; border: 1.5px dashed #ea580c; border-radius: 14px; padding: 16px; text-align: center;">
                    <div style="font-size: 13px; font-weight: 700; color: #9a3412;">লিংক ভিজিট ভেরিফিকেশন চলছে...</div>
                    <div style="font-size: 28px; font-weight: 800; color: #ea580c; margin: 6px 0;" id="linkTimerVal">10s</div>
                    <div style="font-size: 11px; color: #64748b;">টাইমার শেষ হওয়া পর্যন্ত অপেক্ষা করুন</div>
                </div>
            </div>
        </div>
    </div>

    <!-- INTERSTITIAL AD OVERLAY FOR MATH & TYPING -->
    <div id="adInterstitialOverlay" class="modal-overlay" style="z-index: 4000; background: rgba(15, 23, 42, 0.85); backdrop-filter: blur(8px);">
        <div class="modal-card" style="max-width: 400px; border-radius: 24px; text-align: center; padding: 24px; background: #ffffff; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.3);">
            <div style="background: #eff6ff; color: #2563eb; width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px auto; font-size: 28px;">
                <i class="fa-solid fa-rectangle-ad"></i>
            </div>
            <h3 style="font-size: 18px; font-weight: 800; color: #0f172a; margin-bottom: 6px;">স্পন্সরড বিজ্ঞাপন চলছে...</h3>
            <p style="font-size: 13px; color: #64748b; margin-bottom: 18px;">পরবর্তী প্রশ্নে যেতে বিজ্ঞাপনটি শেষ হওয়া পর্যন্ত অপেক্ষা করুন</p>
            
            <div style="background: #f8fafc; border: 2px dashed #cbd5e1; border-radius: 20px; padding: 20px; margin-bottom: 18px;">
                <div style="font-size: 42px; font-weight: 800; color: #2563eb; margin-bottom: 4px;" id="adTimerCount">5s</div>
                <div style="font-size: 12.5px; color: #64748b; font-weight: 600;">কাউন্টডাউন চলছে...</div>
            </div>

            <div style="font-size: 11.5px; color: #94a3b8; font-weight: 600;">
                <i class="fa-solid fa-shield-halved"></i> Ad Verification Active
            </div>
        </div>
    </div>

    <!-- TOAST NOTIFICATION -->
    <div id="toastMessage" class="toast-msg">
        <i class="fa-solid fa-circle-check" style="color:#22c55e;"></i>
        <span id="toastText">Message</span>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const worksData = @json($microWorks);

        function openModal(id) {
            document.getElementById(id).style.display = 'flex';
        }

        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
        }

        // ==================== 1. WORKS TAB & DETAIL HANDLERS ====================
        function openWorksModal() {
            showWorksList();
            switchWorksTab('available');
            openModal('worksModal');
        }

        function switchWorksTab(tab) {
            const tabAvail = document.getElementById('worksAvailableTab');
            const tabSubs = document.getElementById('worksSubmissionsTab');
            const btnAvail = document.getElementById('tabBtnAvailable');
            const btnSubs = document.getElementById('tabBtnSubmissions');

            if (tab === 'available') {
                tabAvail.style.display = 'block';
                tabSubs.style.display = 'none';
                btnAvail.classList.add('active');
                btnSubs.classList.remove('active');
            } else {
                tabAvail.style.display = 'none';
                tabSubs.style.display = 'block';
                btnSubs.classList.add('active');
                btnAvail.classList.remove('active');
            }
        }

        function showWorksList() {
            document.getElementById('worksListView').style.display = 'block';
            document.getElementById('workDetailView').style.display = 'none';
        }

        function openWorkDetail(id) {
            const work = worksData.find(w => w.id === id);
            if (!work) return;

            const container = document.getElementById('workDetailContent');

            let demoHtml = '';
            if (work.demo_screenshot) {
                const demoUrl = '/storage/' + work.demo_screenshot;
                demoHtml = `
                    <div style="font-weight: 800; font-size: 13.5px; color: #1e293b; margin-top: 16px; margin-bottom: 8px;">
                        ডেমো স্ক্রিনশট (এমন করে প্রুফ দিন):
                    </div>
                    <div style="border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden; max-height: 280px; text-align: center; background: #ffffff; padding: 6px;">
                        <img src="${demoUrl}" style="max-width: 100%; max-height: 260px; border-radius: 12px; object-fit: contain;">
                    </div>
                `;
            }

            let linkBtnHtml = '';
            if (work.task_link) {
                linkBtnHtml = `
                    <a href="${work.task_link}" target="_blank" style="display: flex; align-items: center; justify-content: center; background: #e0f2fe; color: #0284c7; font-weight: 800; font-size: 15px; padding: 14px; border-radius: 14px; text-decoration: none; margin-top: 18px; transition: all 0.2s;">
                        কাজের লিংকে যান
                    </a>
                `;
            }

            container.innerHTML = `
                <div style="font-size: 13.5px; color: #334155; line-height: 1.6; white-space: pre-line; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 14px;">
                    <strong style="color: #0f172a; font-size: 14.5px;">প্রমাণ চাই: নির্দেশনা:</strong> ${work.instruction || 'কাজের বিবরণ অনুসরণ করুন।'}
                </div>

                <div style="font-weight: 800; font-size: 14px; color: #0f172a; margin-top: 14px;">
                    রেট: <span style="color: #0099ff;">${work.reward_coins} কয়েন</span>
                </div>

                ${demoHtml}
                ${linkBtnHtml}

                <div style="margin-top: 20px; border-top: 1px solid #f1f5f9; padding-top: 16px;">
                    <div style="font-weight: 800; font-size: 13.5px; color: #0099ff; margin-bottom: 12px;">
                        এই কাজে ${work.required_proofs_count || 1}টি স্ক্রিনশট প্রুফ আপলোড করতে হবে
                    </div>

                    <label style="font-size: 13px; font-weight: 700; color: #475569; display: block; margin-bottom: 6px;">
                        স্ক্রিনশট ১ আপলোড করুন
                    </label>
                    <input type="file" id="proofFileInput" accept="image/*" style="width: 100%; padding: 10px; border: 1.5px solid #cbd5e1; border-radius: 12px; background: #ffffff; font-size: 13px;" onchange="previewProofImage(this)">

                    <div id="proofPreviewBox" style="display: none; margin-top: 10px; text-align: center;">
                        <img id="proofPreviewImg" src="" style="max-height: 150px; border-radius: 10px; border: 1px solid #cbd5e1;">
                    </div>

                    <button type="button" id="submitProofBtn" onclick="submitTaskProof(${work.id})" style="width: 100%; background: #10b981; color: #ffffff; border: none; padding: 14px; border-radius: 14px; font-weight: 800; font-size: 15px; cursor: pointer; margin-top: 18px; box-shadow: 0 4px 12px rgba(16,185,129,0.25);">
                        প্রুফ সাবমিট করুন
                    </button>
                </div>
            `;

            document.getElementById('worksListView').style.display = 'none';
            document.getElementById('workDetailView').style.display = 'block';
        }

        function previewProofImage(input) {
            const previewBox = document.getElementById('proofPreviewBox');
            const previewImg = document.getElementById('proofPreviewImg');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewBox.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function submitTaskProof(workId) {
            const fileInput = document.getElementById('proofFileInput');
            if (!fileInput || !fileInput.files[0]) {
                showToast("দয়া করে প্রুফ স্ক্রিনশট ফাইল নির্বাচন করুন!");
                return;
            }

            const btn = document.getElementById('submitProofBtn');
            btn.disabled = true;
            btn.innerText = 'আপলোড হচ্ছে...';

            const formData = new FormData();
            formData.append('micro_work_id', workId);
            formData.append('proof_screenshot', fileInput.files[0]);

            fetch('/tasks/work/submit', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                btn.disabled = false;
                btn.innerText = 'প্রুফ সাবমিট করুন';
                if (data.status === 'success') {
                    showToast(data.message);
                    showWorksList();
                    switchWorksTab('submissions');
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showToast(data.message || 'প্রুফ সাবমিট ব্যর্থ হয়েছে!');
                }
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerText = 'প্রুফ সাবমিট করুন';
                showToast('প্রুফ সাবমিট করার সময় সমস্যা হয়েছে।');
            });
        }

        // ==================== INTERSTITIAL AD TIMER HANDLER ====================
        function showAdInterstitial(seconds, callback) {
            const overlay = document.getElementById('adInterstitialOverlay');
            const timerEl = document.getElementById('adTimerCount');
            overlay.style.display = 'flex';

            let count = seconds;
            timerEl.innerText = count + 's';

            const interval = setInterval(() => {
                count--;
                timerEl.innerText = count + 's';
                if (count <= 0) {
                    clearInterval(interval);
                    overlay.style.display = 'none';
                    if (callback) callback();
                }
            }, 1000);
        }

        // ==================== 2. MATH SOLVE 10-STEP SESSION HANDLERS ====================
        let mathStep = 1;
        let mathCorrectCount = 0;
        let currentMathObj = null;
        let mathSelectedOption = null;

        function openMathModal() {
            startMathSession();
            openModal('mathModal');
        }

        function startMathSession() {
            mathStep = 1;
            mathCorrectCount = 0;
            renderMathQuestion();
        }

        function renderMathQuestion() {
            mathSelectedOption = null;
            document.getElementById('mathResultScreen').style.display = 'none';
            document.getElementById('mathQuestionScreen').style.display = 'block';

            document.getElementById('mathStepText').innerText = `${mathStep}/10`;
            const percent = (mathStep / 10) * 100;
            document.getElementById('mathProgressBar').style.width = `${percent}%`;

            // Random math equation
            const ops = ['+', '-', '×'];
            const op = ops[Math.floor(Math.random() * ops.length)];
            let num1, num2, correctAns;

            if (op === '×') {
                num1 = Math.floor(Math.random() * 12) + 2;
                num2 = Math.floor(Math.random() * 9) + 2;
                correctAns = num1 * num2;
            } else if (op === '-') {
                num1 = Math.floor(Math.random() * 50) + 20;
                num2 = Math.floor(Math.random() * (num1 - 5)) + 1;
                correctAns = num1 - num2;
            } else {
                num1 = Math.floor(Math.random() * 50) + 10;
                num2 = Math.floor(Math.random() * 40) + 5;
                correctAns = num1 + num2;
            }

            // Generate 3 wrong options
            const optionsSet = new Set();
            optionsSet.add(correctAns);
            while (optionsSet.size < 4) {
                const offset = (Math.floor(Math.random() * 10) + 1) * (Math.random() < 0.5 ? 1 : -1);
                const wrongOpt = correctAns + offset;
                if (wrongOpt >= 0 && wrongOpt !== correctAns) {
                    optionsSet.add(wrongOpt);
                }
            }

            const options = Array.from(optionsSet).sort(() => Math.random() - 0.5);
            currentMathObj = { num1, num2, op, correctAns, options };

            document.getElementById('mathEquationText').innerText = `${num1} ${op} ${num2} = ?`;

            const optionsGrid = document.getElementById('mathOptionsGrid');
            optionsGrid.innerHTML = '';
            document.getElementById('mathFeedbackBadge').style.display = 'none';

            options.forEach((optVal) => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'math-option-btn';
                btn.innerText = optVal;
                btn.onclick = () => selectMathOption(optVal, btn);
                optionsGrid.appendChild(btn);
            });

            const nextBtn = document.getElementById('mathNextBtn');
            nextBtn.disabled = true;
            nextBtn.style.opacity = '0.5';
        }

        function selectMathOption(val, btnEl) {
            if (mathSelectedOption !== null) return;
            mathSelectedOption = val;

            const isCorrect = (val === currentMathObj.correctAns);
            const optionsGrid = document.getElementById('mathOptionsGrid');
            const allBtns = optionsGrid.querySelectorAll('.math-option-btn');

            allBtns.forEach(b => {
                const bVal = parseInt(b.innerText.replace(/[^0-9-]/g, ''));
                b.style.pointerEvents = 'none';
                if (bVal === currentMathObj.correctAns) {
                    b.classList.add('correct');
                    b.innerHTML = `✓ ${bVal}`;
                } else if (b === btnEl && !isCorrect) {
                    b.classList.add('wrong');
                    b.innerHTML = `✕ ${bVal}`;
                }
            });

            const feedbackBadge = document.getElementById('mathFeedbackBadge');
            feedbackBadge.style.display = 'inline-flex';
            if (isCorrect) {
                mathCorrectCount++;
                feedbackBadge.className = 'quiz-feedback-pill correct';
                feedbackBadge.innerHTML = `<i class="fa-solid fa-check"></i> Correct answer!`;
            } else {
                feedbackBadge.className = 'quiz-feedback-pill wrong';
                feedbackBadge.innerHTML = `<i class="fa-solid fa-xmark"></i> Incorrect answer`;
            }

            const nextBtn = document.getElementById('mathNextBtn');
            nextBtn.disabled = false;
            nextBtn.style.opacity = '1';
        }

        function onMathNextClick() {
            if (mathSelectedOption === null) return;

            showAdInterstitial(5, () => {
                if (mathStep < 10) {
                    mathStep++;
                    renderMathQuestion();
                } else {
                    finishMathSession();
                }
            });
        }

        function finishMathSession() {
            document.getElementById('mathQuestionScreen').style.display = 'none';
            document.getElementById('mathResultScreen').style.display = 'block';

            const pointsEarned = mathCorrectCount * 10;
            document.getElementById('mathScoreText').innerText = `${mathCorrectCount} / 10`;
            document.getElementById('mathEarnedPointsText').innerText = `+${pointsEarned} Pts`;

            fetch('/tasks/math/session', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ correct_count: mathCorrectCount })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    updatePointsDisplay(data.new_points);
                    showToast(data.message);
                }
            });
        }

        // ==================== 3. TYPING 10-STEP SESSION HANDLERS ====================
        let typingStep = 1;
        let typingCorrectCount = 0;
        let currentTypingTarget = '';

        const typingWords = [
            'football', 'cricket', 'sky', 'galaxy', 'laptop', 'python',
            'planet', 'river', 'champion', 'guitar', 'rocket', 'freedom',
            'flower', 'sunshine', 'coffee', 'cloud', 'ocean', 'tiger',
            'lion', 'orange', 'silver', 'golden', 'magic', 'heroes'
        ];

        function openTypingModal() {
            startTypingSession();
            openModal('typingModal');
        }

        function startTypingSession() {
            typingStep = 1;
            typingCorrectCount = 0;
            renderTypingQuestion();
        }

        function renderTypingQuestion() {
            document.getElementById('typingResultScreen').style.display = 'none';
            document.getElementById('typingQuestionScreen').style.display = 'block';

            document.getElementById('typingStepText').innerText = `${typingStep}/10`;
            const percent = (typingStep / 10) * 100;
            document.getElementById('typingProgressBar').style.width = `${percent}%`;

            currentTypingTarget = typingWords[Math.floor(Math.random() * typingWords.length)];
            document.getElementById('typingTargetWordText').innerText = currentTypingTarget;

            const inputField = document.getElementById('typingInputWordField');
            inputField.value = '';
            inputField.disabled = false;
            setTimeout(() => inputField.focus(), 100);

            document.getElementById('typingFeedbackBadge').style.display = 'none';
            const submitBtn = document.getElementById('typingSubmitBtn');
            submitBtn.innerText = 'Submit Answer ⚡';
            submitBtn.onclick = submitTypingWordAnswer;
        }

        function submitTypingWordAnswer() {
            const inputField = document.getElementById('typingInputWordField');
            const typed = inputField.value.trim().toLowerCase();
            if (!typed) {
                showToast("দয়া করে শব্দটি টাইপ করুন!");
                return;
            }

            inputField.disabled = true;
            const isCorrect = (typed === currentTypingTarget.toLowerCase());

            const feedbackBadge = document.getElementById('typingFeedbackBadge');
            feedbackBadge.style.display = 'inline-flex';

            if (isCorrect) {
                typingCorrectCount++;
                feedbackBadge.className = 'quiz-feedback-pill correct';
                feedbackBadge.innerHTML = `<i class="fa-solid fa-check"></i> Correct word!`;
            } else {
                feedbackBadge.className = 'quiz-feedback-pill wrong';
                feedbackBadge.innerHTML = `<i class="fa-solid fa-xmark"></i> Incorrect (Target: ${currentTypingTarget})`;
            }

            const submitBtn = document.getElementById('typingSubmitBtn');
            submitBtn.innerText = 'Next →';
            submitBtn.onclick = onTypingNextClick;
        }

        function onTypingNextClick() {
            showAdInterstitial(5, () => {
                if (typingStep < 10) {
                    typingStep++;
                    renderTypingQuestion();
                } else {
                    finishTypingSession();
                }
            });
        }

        function finishTypingSession() {
            document.getElementById('typingQuestionScreen').style.display = 'none';
            document.getElementById('typingResultScreen').style.display = 'block';

            const pointsEarned = typingCorrectCount * 10;
            document.getElementById('typingScoreText').innerText = `${typingCorrectCount} / 10`;
            document.getElementById('typingEarnedPointsText').innerText = `+${pointsEarned} Pts`;

            fetch('/tasks/typing/session', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ correct_count: typingCorrectCount })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    updatePointsDisplay(data.new_points);
                    showToast(data.message);
                }
            });
        }

        // ==================== 4. LINK HITS HANDLERS ====================
        function openLinkHitModal() {
            document.getElementById('linkCountdownBox').style.display = 'none';
            openModal('linkHitModal');
        }

        function startLinkHit(url, reward = 20, seconds = 10) {
            window.open(url, '_blank');

            const box = document.getElementById('linkCountdownBox');
            const timerEl = document.getElementById('linkTimerVal');
            box.style.display = 'block';

            let count = seconds;
            timerEl.innerText = count + 's';

            const interval = setInterval(() => {
                count--;
                timerEl.innerText = count + 's';
                if (count <= 0) {
                    clearInterval(interval);
                    fetch('/tasks/link-hit', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ reward: reward })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            showToast(data.message);
                            updatePointsDisplay(data.new_points);
                            closeModal('linkHitModal');
                        }
                    })
                    .catch(err => showToast('Error recording link hit'));
                }
            }, 1000);
        }

        // POINTS & TOAST HELPERS
        function updatePointsDisplay(newPoints) {
            const el1 = document.getElementById('headerPointsVal');
            const el2 = document.getElementById('mathUserCoinsDisplay');
            const el3 = document.getElementById('typingUserCoinsDisplay');
            if (el1) el1.innerText = newPoints;
            if (el2) el2.innerText = newPoints;
            if (el3) el3.innerText = newPoints;
        }

        function showToast(msg) {
            const toast = document.getElementById('toastMessage');
            document.getElementById('toastText').innerText = msg;
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 3500);
        }
    </script>
</body>
</html>
