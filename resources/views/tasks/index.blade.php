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

        /* COLOR THEMES FOR 4 CARDS */
        .card-works .icon-box { background: #eff6ff; color: #2563eb; }
        .card-works .btn-start-task { background: linear-gradient(135deg, #2563eb, #1d4ed8); box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25); }

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
            padding: 16px;
        }

        .modal-card {
            background: #ffffff;
            border-radius: 24px;
            width: 100%;
            max-width: 500px;
            max-height: 85vh;
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

        .modal-header {
            padding: 18px 20px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f8fafc;
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
            background: #e2e8f0;
            border: none;
            width: 32px;
            height: 32px;
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
            z-index: 3500;
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
                        <span class="reward-badge">15 Pts / Correct</span>
                    </div>
                    <div class="card-cat-title">Math Solve</div>
                    <div class="card-cat-sub">ম্যাথ কুইজ ও ব্রোেইন চ্যালেঞ্জ</div>
                    <div class="card-cat-desc">
                        সহজ গাণিতিক যোগ, বিয়োগ ও গুণ ধাঁধা সলভ করুন এবং তাৎক্ষণিক ১৫ পয়েন্ট রিওয়ার্ড জিতুন।
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
                        <span class="reward-badge">25 Pts / Test</span>
                    </div>
                    <div class="card-cat-title">Typing</div>
                    <div class="card-cat-sub">স্পিড ও একুরেসি চ্যালেঞ্জ</div>
                    <div class="card-cat-desc">
                        দেওয়া বাক্যটি দ্রুত ও নির্ভুলভাবে টাইপ করে আপনার টাইপিং স্কিল টেস্ট করুন এবং ২৫ পয়েন্ট পান।
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

    <!-- 1. WORKS MODAL -->
    <div id="worksModal" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-header">
                <div class="modal-title">
                    💼 Available Micro Works
                </div>
                <button type="button" class="modal-close-btn" onclick="closeModal('worksModal')">✕</button>
            </div>
            <div class="modal-body">
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 14px; display: flex; align-items: center; justify-content: space-between; gap: 12px;">
                        <div>
                            <div style="font-weight: 700; font-size: 14px; color: #0f172a;">Join Official Telegram Channel</div>
                            <div style="font-size: 12px; color: #64748b; margin-top: 2px;">Join channel & stay active for rewards</div>
                        </div>
                        <button type="button" onclick="doWorkTask('Join Telegram Channel', 50)" style="background: #2563eb; color: #fff; border: none; padding: 8px 14px; border-radius: 8px; font-weight: 700; font-size: 12.5px; cursor: pointer; white-space: nowrap;">+50 Pts</button>
                    </div>

                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 14px; display: flex; align-items: center; justify-content: space-between; gap: 12px;">
                        <div>
                            <div style="font-weight: 700; font-size: 14px; color: #0f172a;">Follow Facebook Page</div>
                            <div style="font-size: 12px; color: #64748b; margin-top: 2px;">Like & follow official Facebook page</div>
                        </div>
                        <button type="button" onclick="doWorkTask('Follow Facebook Page', 40)" style="background: #2563eb; color: #fff; border: none; padding: 8px 14px; border-radius: 8px; font-weight: 700; font-size: 12.5px; cursor: pointer; white-space: nowrap;">+40 Pts</button>
                    </div>

                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 14px; display: flex; align-items: center; justify-content: space-between; gap: 12px;">
                        <div>
                            <div style="font-weight: 700; font-size: 14px; color: #0f172a;">Share Post on Profile</div>
                            <div style="font-size: 12px; color: #64748b; margin-top: 2px;">Share today's featured post</div>
                        </div>
                        <button type="button" onclick="doWorkTask('Share Post on Profile', 35)" style="background: #2563eb; color: #fff; border: none; padding: 8px 14px; border-radius: 8px; font-weight: 700; font-size: 12.5px; cursor: pointer; white-space: nowrap;">+35 Pts</button>
                    </div>

                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 14px; display: flex; align-items: center; justify-content: space-between; gap: 12px;">
                        <div>
                            <div style="font-weight: 700; font-size: 14px; color: #0f172a;">Complete Profile Setup</div>
                            <div style="font-size: 12px; color: #64748b; margin-top: 2px;">Add photo, bio & social links</div>
                        </div>
                        <button type="button" onclick="doWorkTask('Complete Profile Setup', 100)" style="background: #2563eb; color: #fff; border: none; padding: 8px 14px; border-radius: 8px; font-weight: 700; font-size: 12.5px; cursor: pointer; white-space: nowrap;">+100 Pts</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. MATH SOLVE MODAL -->
    <div id="mathModal" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-header">
                <div class="modal-title">
                    🧮 Math Solve Challenge
                </div>
                <button type="button" class="modal-close-btn" onclick="closeModal('mathModal')">✕</button>
            </div>
            <div class="modal-body" style="text-align: center;">
                <div style="font-size: 13px; color: #64748b; margin-bottom: 12px;">অংকটির সঠিক উত্তর দিয়ে ১৫ পয়েন্ট ইনকাম করুন:</div>

                <div style="background: #fdf2f8; border: 2px solid #fbcfe8; border-radius: 16px; padding: 20px; margin-bottom: 16px;">
                    <div style="font-size: 32px; font-weight: 800; color: #db2777;" id="mathEquation">
                        15 + 27 = ?
                    </div>
                </div>

                <input type="number" id="mathAnswerInput" placeholder="আপনার উত্তর লিখুন..." style="width: 100%; padding: 14px; border-radius: 12px; border: 2px solid #e2e8f0; font-size: 18px; font-weight: 700; text-align: center; margin-bottom: 16px; outline: none;" onkeydown="if(event.key==='Enter') submitMathAnswer()">

                <button type="button" onclick="submitMathAnswer()" style="width: 100%; background: linear-gradient(135deg, #db2777, #be185d); color: #fff; border: none; padding: 14px; border-radius: 12px; font-weight: 800; font-size: 15px; cursor: pointer; box-shadow: 0 4px 12px rgba(219,39,119,0.3);">
                    Submit Answer 🎯
                </button>
            </div>
        </div>
    </div>

    <!-- 3. TYPING MODAL -->
    <div id="typingModal" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-header">
                <div class="modal-title">
                    ⌨️ Typing Speed Challenge
                </div>
                <button type="button" class="modal-close-btn" onclick="closeModal('typingModal')">✕</button>
            </div>
            <div class="modal-body">
                <div style="font-size: 13px; color: #64748b; margin-bottom: 10px;">নিচের বাক্যটি দেখে হুবহু টাইপ করুন:</div>

                <div style="background: #f0fdf4; border: 1.5px solid #bbf7d0; border-radius: 14px; padding: 14px; font-size: 15px; font-weight: 700; color: #166534; margin-bottom: 14px; user-select: none;" id="typingTargetText">
                    Chanda Vai is the best platform to earn rewards and connect with creators.
                </div>

                <textarea id="typingInputField" rows="3" placeholder="এখানে টাইপ করা শুরু করুন..." style="width: 100%; padding: 12px; border-radius: 12px; border: 2px solid #e2e8f0; font-size: 14px; margin-bottom: 16px; outline: none; resize: none;"></textarea>

                <button type="button" onclick="submitTypingAnswer()" style="width: 100%; background: linear-gradient(135deg, #16a34a, #15803d); color: #fff; border: none; padding: 14px; border-radius: 12px; font-weight: 800; font-size: 15px; cursor: pointer; box-shadow: 0 4px 12px rgba(22,163,74,0.3);">
                    Submit Typing ⚡
                </button>
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
                <div style="font-size: 13px; color: #64748b; margin-bottom: 14px;">লিংক ভিজিট করে ১০ সেকেন্ড অপেক্ষা করলেই পাবেন ২০ পয়েন্ট:</div>

                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <div style="background: #fff7ed; border: 1px solid #ffedd5; border-radius: 14px; padding: 14px; display: flex; align-items: center; justify-content: space-between; gap: 12px;">
                        <div>
                            <div style="font-weight: 700; font-size: 14px; color: #9a3412;">Chanda Vai Store Offer</div>
                            <div style="font-size: 11px; color: #ea580c; margin-top: 2px;">https://chandavai.com/shop</div>
                        </div>
                        <button type="button" onclick="startLinkHit('https://chandavai.com/shop')" style="background: #ea580c; color: #fff; border: none; padding: 8px 14px; border-radius: 8px; font-weight: 700; font-size: 12.5px; cursor: pointer; white-space: nowrap;">Visit & Earn</button>
                    </div>

                    <div style="background: #fff7ed; border: 1px solid #ffedd5; border-radius: 14px; padding: 14px; display: flex; align-items: center; justify-content: space-between; gap: 12px;">
                        <div>
                            <div style="font-weight: 700; font-size: 14px; color: #9a3412;">Tech News & Gadgets</div>
                            <div style="font-size: 11px; color: #ea580c; margin-top: 2px;">https://example.com/tech</div>
                        </div>
                        <button type="button" onclick="startLinkHit('https://example.com/tech')" style="background: #ea580c; color: #fff; border: none; padding: 8px 14px; border-radius: 8px; font-weight: 700; font-size: 12.5px; cursor: pointer; white-space: nowrap;">Visit & Earn</button>
                    </div>
                </div>

                <div id="linkCountdownBox" style="display: none; margin-top: 16px; background: #fff7ed; border: 1.5px dashed #ea580c; border-radius: 14px; padding: 16px; text-align: center;">
                    <div style="font-size: 13px; font-weight: 700; color: #9a3412;">লিংক ভিজিট ভেরিফিকেশন চলছে...</div>
                    <div style="font-size: 28px; font-weight: 800; color: #ea580c; margin: 6px 0;" id="linkTimerVal">10s</div>
                    <div style="font-size: 11px; color: #64748b;">টাইমার শেষ হওয়া পর্যন্ত অপেক্ষা করুন</div>
                </div>
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

        // CURRENT MATH DATA
        let currentMathNum1 = 15;
        let currentMathNum2 = 27;
        let currentMathOperator = '+';

        // TYPING SENTENCES LIST
        const typingSentences = [
            "Chanda Vai is the best platform to earn rewards and connect with creators.",
            "Practice typing daily to improve your speed and precision.",
            "Fast typing skills help you complete tasks quickly and efficiently.",
            "Earn points every single day by participating in interactive challenges."
        ];

        function openModal(id) {
            document.getElementById(id).style.display = 'flex';
        }

        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
        }

        // 1. WORKS MODAL HANDLERS
        function openWorksModal() {
            openModal('worksModal');
        }

        function doWorkTask(title, reward) {
            fetch('/tasks/work', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ work_title: title, reward: reward })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    showToast(data.message);
                    updatePointsDisplay(data.new_points);
                    closeModal('worksModal');
                } else {
                    showToast(data.message || 'Error completing work');
                }
            })
            .catch(err => showToast('Error completing work task'));
        }

        // 2. MATH SOLVE HANDLERS
        function openMathModal() {
            generateNewMath();
            openModal('mathModal');
        }

        function generateNewMath() {
            const ops = ['+', '-', '×'];
            currentMathOperator = ops[Math.floor(Math.random() * ops.length)];
            
            if (currentMathOperator === '×') {
                currentMathNum1 = Math.floor(Math.random() * 12) + 2;
                currentMathNum2 = Math.floor(Math.random() * 10) + 2;
            } else if (currentMathOperator === '-') {
                currentMathNum1 = Math.floor(Math.random() * 50) + 20;
                currentMathNum2 = Math.floor(Math.random() * 20) + 1;
            } else {
                currentMathNum1 = Math.floor(Math.random() * 60) + 10;
                currentMathNum2 = Math.floor(Math.random() * 40) + 5;
            }

            document.getElementById('mathEquation').innerText = `${currentMathNum1} ${currentMathOperator} ${currentMathNum2} = ?`;
            document.getElementById('mathAnswerInput').value = '';
        }

        function submitMathAnswer() {
            const ans = document.getElementById('mathAnswerInput').value.trim();
            if (!ans) {
                showToast("দয়া করে আপনার উত্তরটি লিখুন!");
                return;
            }

            fetch('/tasks/math', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    num1: currentMathNum1,
                    num2: currentMathNum2,
                    operator: currentMathOperator,
                    user_answer: parseInt(ans)
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    showToast(data.message);
                    updatePointsDisplay(data.new_points);
                    generateNewMath();
                } else {
                    showToast(data.message || 'ভুল উত্তর!');
                }
            })
            .catch(err => showToast('Error checking math answer'));
        }

        // 3. TYPING HANDLERS
        function openTypingModal() {
            const randomSentence = typingSentences[Math.floor(Math.random() * typingSentences.length)];
            document.getElementById('typingTargetText').innerText = randomSentence;
            document.getElementById('typingInputField').value = '';
            openModal('typingModal');
        }

        function submitTypingAnswer() {
            const target = document.getElementById('typingTargetText').innerText;
            const typed = document.getElementById('typingInputField').value;

            if (!typed.trim()) {
                showToast("দয়া করে বাক্যটি টাইপ করুন!");
                return;
            }

            fetch('/tasks/typing', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    target_text: target,
                    typed_text: typed
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    showToast(data.message);
                    updatePointsDisplay(data.new_points);
                    closeModal('typingModal');
                } else {
                    showToast(data.message || 'টাইপিং ভুল হয়েছে!');
                }
            })
            .catch(err => showToast('Error submitting typing'));
        }

        // 4. LINK HITS HANDLERS
        function openLinkHitModal() {
            document.getElementById('linkCountdownBox').style.display = 'none';
            openModal('linkHitModal');
        }

        function startLinkHit(url) {
            window.open(url, '_blank');

            const box = document.getElementById('linkCountdownBox');
            const timerEl = document.getElementById('linkTimerVal');
            box.style.display = 'block';

            let count = 10;
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
                        }
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
            const el = document.getElementById('headerPointsVal');
            if (el) el.innerText = newPoints;
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
