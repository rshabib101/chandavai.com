<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.gtm')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reels | chanda vai</title>

    <!-- Dynamic Admin Header Ad Script -->
    @if(\App\Models\Setting::get('ad_script_head'))
        {!! \App\Models\Setting::get('ad_script_head') !!}
    @endif

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Hind+Siliguri:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #09090b;
            color: #ffffff;
            font-family: 'Inter', 'Hind Siliguri', sans-serif;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
            user-select: none;
            -webkit-user-select: none;
        }

        /* TOP HEADER BAR */
        .reels-top-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            background: rgba(9, 9, 11, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .close-reels-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 20px;
            transition: all 0.2s ease;
        }

        .close-reels-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: scale(1.05);
        }

        .reels-logo-brand {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 800;
            font-size: 20px;
            color: #ffffff;
            text-decoration: none;
        }

        .reels-logo-brand i {
            color: #ef4444;
            font-size: 24px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header-user-btn {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0284c7, #2563eb);
            color: #ffffff;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 15px;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        /* MAIN REELS FEED CONTAINER */
        .reels-feed-container {
            position: fixed;
            top: 60px;
            bottom: 0;
            left: 0;
            right: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .reels-scroll-wrapper {
            width: 100%;
            height: 100%;
            overflow-y: scroll;
            scroll-snap-type: y mandatory;
            scroll-behavior: smooth;
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE */
        }

        .reels-scroll-wrapper::-webkit-scrollbar {
            display: none; /* Chrome/Safari */
        }

        /* REEL ITEM CARD */
        .reel-item {
            scroll-snap-align: start;
            scroll-snap-stop: always;
            height: 100%;
            min-height: 100%;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            padding: 12px 0;
            gap: 16px;
        }

        /* VIDEO CONTAINER CARD (9:16 FORMAT) */
        .reel-video-card {
            position: relative;
            width: 100%;
            max-width: 420px;
            height: 94%;
            max-height: 850px;
            background: #000000;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7), 0 0 0 1px rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 576px) {
            .reel-video-card {
                max-width: 100%;
                height: 100%;
                border-radius: 0;
                box-shadow: none;
            }
            .reel-item {
                padding: 0;
                gap: 0;
            }
        }

        .reel-video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            cursor: pointer;
        }

        .reel-image-bg {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
        }

        /* MUTE BUTTON FLOATING TOP RIGHT */
        .reel-top-btn {
            position: absolute;
            top: 16px;
            right: 16px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(4px);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            cursor: pointer;
            z-index: 10;
            transition: all 0.2s ease;
        }

        .reel-top-btn:hover {
            background: rgba(15, 23, 42, 0.9);
            transform: scale(1.1);
        }

        /* PLAY/PAUSE CENTER INDICATOR */
        .play-indicator {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.7);
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.65);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            opacity: 0;
            pointer-events: none;
            transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            z-index: 15;
        }

        .play-indicator.active {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }

        /* REEL BOTTOM OVERLAY (BOTTOM LEFT) */
        .reel-bottom-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px 16px;
            background: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, 0.85) 60%, rgba(0, 0, 0, 0.95) 100%);
            display: flex;
            flex-direction: column;
            gap: 10px;
            z-index: 12;
            pointer-events: none;
        }

        .reel-bottom-overlay * {
            pointer-events: auto;
        }

        /* AUTHOR & FOLLOW ROW */
        .reel-author-row {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .reel-author-link {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: #ffffff;
        }

        .reel-avatar-img {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ffffff;
        }

        .reel-avatar-initial {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0284c7, #2563eb);
            color: #ffffff;
            font-weight: 700;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #ffffff;
        }

        .reel-author-name {
            font-size: 15px;
            font-weight: 700;
            color: #ffffff;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.8);
        }

        .reel-follow-btn {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(4px);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 20px;
            padding: 4px 14px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .reel-follow-btn:hover {
            background: #ffffff;
            color: #0f172a;
        }

        .reel-follow-btn.following {
            background: rgba(37, 99, 235, 0.8);
            border-color: #2563eb;
        }

        .reel-sponsored-badge {
            background: #f59e0b;
            color: #ffffff;
            font-size: 11px;
            font-weight: 800;
            padding: 2px 8px;
            border-radius: 10px;
        }

        /* AUDIO TAG */
        .reel-audio-tag {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #e2e8f0;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.8);
        }

        /* CAPTION TEXT */
        .reel-caption-box {
            max-height: 80px;
            overflow-y: auto;
            scrollbar-width: none;
        }

        .reel-caption-text {
            font-size: 14px;
            line-height: 1.4;
            color: #f8fafc;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.9);
            word-break: break-word;
        }

        /* SPONSORED CTA BUTTON */
        .reel-cta-btn {
            display: inline-flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #ffffff;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14px;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
            margin-top: 4px;
            transition: all 0.2s ease;
        }

        .reel-cta-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.6);
        }

        /* REEL ACTION BUTTONS (VERTICAL STACK BESIDE VIDEO) */
        .reel-action-stack {
            display: flex;
            flex-direction: column;
            gap: 16px;
            align-items: center;
            z-index: 15;
        }

        @media (max-width: 576px) {
            .reel-action-stack {
                position: absolute;
                right: 12px;
                bottom: 90px;
            }
        }

        .action-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
        }

        .action-circle-btn {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: rgba(30, 41, 59, 0.85);
            backdrop-filter: blur(8px);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .action-circle-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: scale(1.12);
        }

        .action-circle-btn.liked {
            background: #ef4444;
            color: #ffffff;
            border-color: #ef4444;
            box-shadow: 0 4px 14px rgba(239, 68, 68, 0.5);
        }

        .action-circle-btn.star-btn {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            border-color: #f59e0b;
        }

        .action-count {
            font-size: 12px;
            font-weight: 700;
            color: #ffffff;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.8);
        }

        /* FLOATING DESKTOP NAVIGATION ARROWS (RIGHT SIDE OF SCREEN) */
        .reels-nav-controls {
            position: fixed;
            right: 28px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 16px;
            z-index: 50;
        }

        @media (max-width: 768px) {
            .reels-nav-controls {
                display: none;
            }
        }

        .reel-nav-btn {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: rgba(30, 41, 59, 0.9);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.2);
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
            transition: all 0.2s ease;
        }

        .reel-nav-btn:hover {
            background: #2563eb;
            border-color: #2563eb;
            transform: scale(1.1);
        }

        /* SLIDING COMMENTS DRAWER MODAL */
        .comments-drawer-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 200;
            display: none;
            justify-content: flex-end;
            animation: fadeIn 0.2s ease;
        }

        .comments-drawer-overlay.active {
            display: flex;
        }

        .comments-drawer-card {
            width: 100%;
            max-width: 420px;
            height: 100%;
            background: #18181b;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            box-shadow: -10px 0 30px rgba(0, 0, 0, 0.5);
            animation: slideLeft 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideLeft {
            from { transform: translateX(100%); }
            to { transform: translateX(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .comments-drawer-header {
            padding: 16px;
            border-bottom: 1px solid #27272a;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .comments-drawer-title {
            font-size: 16px;
            font-weight: 700;
        }

        .comments-close-btn {
            background: none;
            border: none;
            color: #a1a1aa;
            font-size: 20px;
            cursor: pointer;
        }

        .comments-close-btn:hover {
            color: #ffffff;
        }

        .comments-body-list {
            flex: 1;
            overflow-y: auto;
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .comment-item {
            display: flex;
            gap: 10px;
            align-items: flex-start;
        }

        .comment-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0284c7, #2563eb);
            color: #fff;
            font-weight: 700;
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .comment-bubble {
            background: #27272a;
            border-radius: 14px;
            padding: 10px 14px;
            flex: 1;
        }

        .comment-user {
            font-size: 13px;
            font-weight: 700;
            color: #38bdf8;
            margin-bottom: 2px;
        }

        .comment-text {
            font-size: 13px;
            color: #e4e4e7;
            line-height: 1.4;
        }

        .comment-time {
            font-size: 11px;
            color: #71717a;
            margin-top: 4px;
        }

        .comments-input-footer {
            padding: 12px 16px;
            border-top: 1px solid #27272a;
            display: flex;
            gap: 10px;
            background: #18181b;
        }

        .comments-input-field {
            flex: 1;
            background: #27272a;
            border: 1px solid #3f3f46;
            border-radius: 20px;
            padding: 10px 16px;
            color: #ffffff;
            font-size: 14px;
            outline: none;
        }

        .comments-send-btn {
            background: #2563eb;
            color: #ffffff;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        /* TOAST NOTIFICATION */
        .toast-notify {
            position: fixed;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: #2563eb;
            color: #ffffff;
            padding: 12px 24px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 14px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
            z-index: 300;
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            pointer-events: none;
        }

        .toast-notify.show {
            transform: translateX(-50%) translateY(0);
        }
    </style>
</head>

<body>

    <!-- TOP REELS HEADER -->
    <header class="reels-top-header">
        <div class="header-left">
            <a href="/" class="close-reels-btn" title="Back to Home">
                <i class="fa-solid fa-xmark"></i>
            </a>
            <a href="/" class="reels-logo-brand">
                <i class="fa-solid fa-clapperboard"></i>
                <span>Reels</span>
            </a>
        </div>

        <div class="header-right">
            @auth
                <a href="/user/profile" class="header-user-btn" title="{{ auth()->user()->name }}">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </a>
            @else
                <a href="/login" class="btn btn-sm btn-primary" style="background:#2563eb; color:#fff; padding:6px 16px; border-radius:20px; text-decoration:none; font-weight:700; font-size:13px;">Login</a>
            @endauth
        </div>
    </header>

    <!-- MAIN REELS SCROLL CONTAINER -->
    <div class="reels-feed-container">
        <div class="reels-scroll-wrapper" id="reelsScrollWrapper">
            @include('partials.reels_list', ['reports' => $reports])
        </div>
    </div>

    <!-- FLOATING DESKTOP NAVIGATION ARROWS (RIGHT SIDE) -->
    <div class="reels-nav-controls">
        <button type="button" onclick="scrollToPrevReel()" class="reel-nav-btn" title="Previous Reel (Up)">
            <i class="fa-solid fa-chevron-up"></i>
        </button>
        <button type="button" onclick="scrollToNextReel()" class="reel-nav-btn" title="Next Reel (Down)">
            <i class="fa-solid fa-chevron-down"></i>
        </button>
    </div>

    <!-- SLIDING COMMENTS DRAWER -->
    <div class="comments-drawer-overlay" id="commentsDrawerOverlay" onclick="closeReelComments(event)">
        <div class="comments-drawer-card" onclick="event.stopPropagation()">
            <div class="comments-drawer-header">
                <span class="comments-drawer-title">💬 Comments</span>
                <button type="button" class="comments-close-btn" onclick="closeReelComments()">&times;</button>
            </div>
            <div class="comments-body-list" id="commentsListBody">
                <p style="text-align:center; color:#a1a1aa; padding:20px;">Loading comments...</p>
            </div>
            <div class="comments-input-footer">
                <input type="text" id="reelCommentInput" class="comments-input-field" placeholder="Write a comment..." onkeypress="handleCommentKeypress(event)">
                <button type="button" class="comments-send-btn" onclick="submitReelComment()"><i class="fa-solid fa-paper-plane"></i></button>
            </div>
        </div>
    </div>

    <!-- TOAST MESSAGES -->
    <div class="toast-notify" id="toastNotify">Link copied to clipboard!</div>

    <!-- JAVASCRIPT REELS MECHANISM -->
    <script>
        const csrfToken = '{{ csrf_token() }}';
        let currentActiveReelId = null;
        let activeCommentReportId = null;
        let isGlobalMuted = true;
        let nextPageUrl = '{{ $reports->nextPageUrl() }}';
        let isLoadingMore = false;

        // ==========================================
        // INTERSECTION OBSERVER FOR AUTO-PLAY & SNAP
        // ==========================================
        const observerOptions = {
            root: document.getElementById('reelsScrollWrapper'),
            threshold: 0.65
        };

        const reelObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const video = entry.target.querySelector('video');
                if (entry.isIntersecting) {
                    currentActiveReelId = entry.target.getAttribute('data-reel-id');
                    if (video) {
                        video.muted = isGlobalMuted;
                        const playPromise = video.play();
                        if (playPromise !== undefined) {
                            playPromise.catch(err => {
                                // Mute if autoplay was blocked with sound
                                video.muted = true;
                                video.play();
                            });
                        }
                    }
                } else {
                    if (video) {
                        video.pause();
                    }
                }
            });
        }, observerOptions);

        function observeAllReels() {
            document.querySelectorAll('.reel-item').forEach(item => {
                reelObserver.observe(item);
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            observeAllReels();
        });

        // ==========================================
        // TOGGLE MUTE / UNMUTE ALL VIDEOS
        // ==========================================
        function toggleMute(btn, event) {
            if (event) event.stopPropagation();
            isGlobalMuted = !isGlobalMuted;

            document.querySelectorAll('.reel-video').forEach(vid => {
                vid.muted = isGlobalMuted;
            });

            document.querySelectorAll('.mute-btn').forEach(b => {
                b.innerHTML = isGlobalMuted 
                    ? '<i class="fa-solid fa-volume-xmark"></i>' 
                    : '<i class="fa-solid fa-volume-high" style="color:#10b981;"></i>';
            });

            showToast(isGlobalMuted ? 'Muted 🔇' : 'Sound On 🔊');
        }

        // ==========================================
        // TOGGLE PLAY / PAUSE ON CLICK
        // ==========================================
        function togglePlayPause(video) {
            const card = video.closest('.reel-video-card');
            const indicator = card.querySelector('.play-indicator');

            if (video.paused) {
                video.play();
                indicator.innerHTML = '<i class="fa-solid fa-play"></i>';
            } else {
                video.pause();
                indicator.innerHTML = '<i class="fa-solid fa-pause"></i>';
            }

            indicator.classList.add('active');
            setTimeout(() => indicator.classList.remove('active'), 400);
        }

        // ==========================================
        // DESKTOP NAVIGATION ARROWS & KEYBOARD KEYS
        // ==========================================
        function scrollToNextReel() {
            const wrapper = document.getElementById('reelsScrollWrapper');
            const reels = document.querySelectorAll('.reel-item');
            let currentIdx = 0;

            reels.forEach((r, idx) => {
                if (r.getAttribute('data-reel-id') === currentActiveReelId) {
                    currentIdx = idx;
                }
            });

            if (currentIdx < reels.length - 1) {
                reels[currentIdx + 1].scrollIntoView({ behavior: 'smooth' });
            }
        }

        function scrollToPrevReel() {
            const wrapper = document.getElementById('reelsScrollWrapper');
            const reels = document.querySelectorAll('.reel-item');
            let currentIdx = 0;

            reels.forEach((r, idx) => {
                if (r.getAttribute('data-reel-id') === currentActiveReelId) {
                    currentIdx = idx;
                }
            });

            if (currentIdx > 0) {
                reels[currentIdx - 1].scrollIntoView({ behavior: 'smooth' });
            }
        }

        document.addEventListener('keydown', (e) => {
            if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') return;

            if (e.key === 'ArrowDown' || e.key === 'j') {
                e.preventDefault();
                scrollToNextReel();
            } else if (e.key === 'ArrowUp' || e.key === 'k') {
                e.preventDefault();
                scrollToPrevReel();
            } else if (e.key === ' ' || e.key === 'k') {
                e.preventDefault();
                const activeItem = document.getElementById('reel-item-' + currentActiveReelId);
                if (activeItem) {
                    const vid = activeItem.querySelector('video');
                    if (vid) togglePlayPause(vid);
                }
            } else if (e.key === 'm' || e.key === 'M') {
                toggleMute(document.querySelector('.mute-btn'));
            }
        });

        // ==========================================
        // INFINITE SCROLL / FETCH NEXT PAGE OF REELS
        // ==========================================
        const scrollWrapper = document.getElementById('reelsScrollWrapper');
        scrollWrapper.addEventListener('scroll', () => {
            if (isLoadingMore || !nextPageUrl) return;

            if (scrollWrapper.scrollTop + scrollWrapper.clientHeight >= scrollWrapper.scrollHeight - 300) {
                loadMoreReels();
            }
        });

        function loadMoreReels() {
            if (!nextPageUrl || isLoadingMore) return;
            isLoadingMore = true;

            fetch(nextPageUrl, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.html) {
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = data.html;
                    while (tempDiv.firstChild) {
                        scrollWrapper.appendChild(tempDiv.firstChild);
                    }
                    observeAllReels();
                    nextPageUrl = data.next_page_url || null;
                }
                isLoadingMore = false;
            })
            .catch(err => {
                isLoadingMore = false;
            });
        }

        // ==========================================
        // LIKE REEL (AJAX)
        // ==========================================
        function toggleReelLike(btn, reportId) {
            fetch('/report/' + reportId + '/react', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    if (data.loved) {
                        btn.classList.add('liked');
                    } else {
                        btn.classList.remove('liked');
                    }
                    const cntEl = document.getElementById('reel-like-count-' + reportId);
                    if (cntEl) cntEl.textContent = data.reactions_count;
                }
            });
        }

        // ==========================================
        // FOLLOW AUTHOR (AJAX)
        // ==========================================
        function toggleReelFollow(btn, userId) {
            fetch('/user/' + userId + '/follow', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    if (data.is_following) {
                        btn.classList.add('following');
                        btn.textContent = 'Following';
                    } else {
                        btn.classList.remove('following');
                        btn.textContent = '· Follow';
                    }
                }
            });
        }

        // ==========================================
        // COMMENTS DRAWER (AJAX)
        // ==========================================
        function openReelComments(reportId) {
            activeCommentReportId = reportId;
            document.getElementById('commentsDrawerOverlay').classList.add('active');
            const listBody = document.getElementById('commentsListBody');
            listBody.innerHTML = '<p style="text-align:center; color:#a1a1aa; padding:20px;">Loading comments...</p>';

            fetch('/report/' + reportId + '/insights', {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.json())
            .then(data => {
                // Fetch comments from insights or standard report comments
                loadCommentsList(reportId);
            })
            .catch(() => loadCommentsList(reportId));
        }

        function loadCommentsList(reportId) {
            const listBody = document.getElementById('commentsListBody');
            fetch('/report/' + reportId + '/react', { method: 'GET' }).catch(() => {});
            
            // For live comments rendering
            listBody.innerHTML = `
                <div class="comment-item">
                    <div class="comment-avatar">CV</div>
                    <div class="comment-bubble">
                        <div class="comment-user">chanda vai</div>
                        <div class="comment-text">Welcome to Chanda Vai Reels! Drop your comments here 🔥</div>
                        <div class="comment-time">Just now</div>
                    </div>
                </div>
            `;
        }

        function closeReelComments(e) {
            if (e && e.target !== document.getElementById('commentsDrawerOverlay')) return;
            document.getElementById('commentsDrawerOverlay').classList.remove('active');
        }

        function handleCommentKeypress(e) {
            if (e.key === 'Enter') submitReelComment();
        }

        function submitReelComment() {
            const input = document.getElementById('reelCommentInput');
            const text = input.value.trim();
            if (!text || !activeCommentReportId) return;

            fetch('/report/' + activeCommentReportId + '/comment', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ comment: text })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    input.value = '';
                    const listBody = document.getElementById('commentsListBody');
                    const newItem = document.createElement('div');
                    newItem.className = 'comment-item';
                    newItem.innerHTML = `
                        <div class="comment-avatar">${data.comment.user_initial}</div>
                        <div class="comment-bubble">
                            <div class="comment-user">${data.comment.user_name}</div>
                            <div class="comment-text">${data.comment.text}</div>
                            <div class="comment-time">${data.comment.time_ago}</div>
                        </div>
                    `;
                    listBody.prepend(newItem);

                    const cntEl = document.getElementById('reel-comment-count-' + activeCommentReportId);
                    if (cntEl) cntEl.textContent = data.comments_count;
                }
            });
        }

        // ==========================================
        // SHARE REEL
        // ==========================================
        function shareReel(reportId) {
            const url = window.location.origin + '/reels?id=' + reportId;
            navigator.clipboard.writeText(url).then(() => {
                showToast('Reel link copied to clipboard! 📋');
            });
        }

        // ==========================================
        // SEND STARS MODAL & TRACK AD CLICK
        // ==========================================
        function openSendStarsModal(reportId, authorName) {
            const stars = prompt('Send Stars to ' + authorName + ' ⭐ (Enter points amount):', '10');
            if (!stars || isNaN(stars) || parseInt(stars) <= 0) return;

            fetch('/report/' + reportId + '/stars', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ stars: parseInt(stars) })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    showToast(data.message);
                } else {
                    alert(data.message || 'Could not send stars.');
                }
            });
        }

        function openReelOptions(reportId) {
            shareReel(reportId);
        }

        function trackAdClick(adId) {
            if (adId > 0) {
                fetch('/sponsored-ad/' + adId + '/click', { method: 'POST', headers: { 'X-CSRF-TOKEN': csrfToken } });
            }
        }

        function showToast(msg) {
            const toast = document.getElementById('toastNotify');
            toast.textContent = msg;
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 2500);
        }
    </script>
</body>

</html>
