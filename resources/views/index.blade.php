<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.gtm')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chandavai Feed</title>
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/habib-custom.css') }}">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background-color: #f4f6f8;
            font-family: 'Inter', 'Hind Siliguri', sans-serif;
            color: #1e293b;
            padding-bottom: 75px; /* Space for bottom nav */
        }

        /* TOPBAR */
        .app-topbar {
            background: #ffffff;
            padding: 10px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }

        .brand-badge {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #ff4757, #ff6b81);
            color: #ffffff;
            font-weight: 800;
            font-size: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 6px rgba(255, 71, 87, 0.3);
        }

        .brand-title {
            font-size: 22px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.5px;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .top-btn-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #f1f5f9;
            border: none;
            color: #334155;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .top-btn-icon:hover {
            background: #e2e8f0;
            color: #0f172a;
        }

        /* MAIN CONTAINER */
        .main-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 12px 12px 20px 12px;
        }

        /* POST CREATOR BAR */
        .mind-bar {
            background: #ffffff;
            border-radius: 16px;
            padding: 12px 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            margin-bottom: 14px;
        }

        .user-avatar-initial {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0284c7, #2563eb);
            color: #ffffff;
            font-weight: 700;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .mind-input-btn {
            flex: 1;
            background: #f1f5f9;
            border-radius: 24px;
            padding: 10px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #64748b;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.2s;
        }

        .mind-input-btn:hover {
            background: #e2e8f0;
        }

        .mind-input-btn .img-icon {
            font-size: 18px;
            color: #10b981;
        }

        /* STORIES CAROUSEL */
        .stories-section {
            margin-bottom: 16px;
            overflow-x: auto;
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE */
        }

        .stories-section::-webkit-scrollbar {
            display: none; /* Chrome/Safari */
        }

        .stories-wrapper {
            display: flex;
            gap: 10px;
            padding-bottom: 4px;
        }

        .story-card {
            width: 110px;
            height: 165px;
            border-radius: 16px;
            position: relative;
            flex-shrink: 0;
            overflow: hidden;
            background-size: cover;
            background-position: center;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
            transition: transform 0.2s ease;
        }

        .story-card:hover {
            transform: translateY(-2px);
        }

        .story-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.75) 100%);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 10px;
        }

        .story-avatar-badge {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 2px solid #2563eb;
            object-fit: cover;
            background: #ffffff;
        }

        .story-avatar-placeholder {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 2px solid #ff4757;
            background: #ff4757;
            color: #ffffff;
            font-weight: 700;
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .story-user-name {
            color: #ffffff;
            font-size: 12px;
            font-weight: 600;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.8);
            white-space: normal;
            line-height: 1.2;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .create-story-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
        }

        .create-story-card .story-overlay {
            background: rgba(255, 255, 255, 0.9);
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 8px;
        }

        .create-story-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #ff4757;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        /* CATEGORY TABS */
        .categories-section {
            margin-bottom: 14px;
            overflow-x: auto;
            scrollbar-width: none;
        }

        .categories-section::-webkit-scrollbar {
            display: none;
        }

        .categories-wrapper {
            display: flex;
            gap: 8px;
        }

        .category-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 20px;
            background: #ffffff;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            border: 1px solid #e2e8f0;
            white-space: nowrap;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
            transition: all 0.2s ease;
        }

        .category-pill.active,
        .category-pill:hover {
            background: #f1f5f9;
            color: #0f172a;
            border-color: #cbd5e1;
        }

        .category-pill.active {
            background: #e2e8f0;
        }

        /* MODAL */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.92);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .modal img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
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

    <!-- TOP BAR -->
    <div class="app-topbar">
        <a href="/" class="brand-logo">
            <span class="brand-badge">b</span>
            <span class="brand-title">Treend</span>
        </a>
        <div class="topbar-actions">
            <a href="/report/create" class="top-btn-icon" title="Create Post">
                <i class="fa-solid fa-plus"></i>
            </a>
            <button class="top-btn-icon" title="Search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <button class="top-btn-icon" title="Messages">
                <i class="fa-regular fa-paper-plane"></i>
            </button>
        </div>
    </div>

    <!-- FEED MAIN CONTAINER -->
    <div class="main-container">

        <!-- WHAT'S ON YOUR MIND? -->
        <div class="mind-bar">
            <a href="/user/profile" class="user-avatar-initial" style="text-decoration:none;">
                {{ strtoupper(substr(auth()->user()->name ?? 'R', 0, 1)) }}
            </a>
            <a href="/report/create" class="mind-input-btn">
                <span>What's on your mind?</span>
                <i class="fa-regular fa-image img-icon"></i>
            </a>
        </div>

        <!-- STORIES HORIZONTAL CAROUSEL -->
        <div class="stories-section">
            <div class="stories-wrapper">
                <!-- Story Item 1: Israt Jahan -->
                <div class="story-card" style="background-image: url('https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=300&q=80');" onclick="location.href='/user/profile'">
                    <div class="story-overlay">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=100&q=80" class="story-avatar-badge" alt="Israt">
                        <span class="story-user-name">Israt Jahan</span>
                    </div>
                </div>

                <!-- Story Item 2: Olie Munshi -->
                <div class="story-card" style="background-image: url('https://images.unsplash.com/photo-1508098682722-e99c43a406b2?auto=format&fit=crop&w=300&q=80');" onclick="location.href='/user/profile'">
                    <div class="story-overlay">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=100&q=80" class="story-avatar-badge" alt="Olie">
                        <span class="story-user-name">Olie Munshi</span>
                    </div>
                </div>

                <!-- Story Item 3: Hello Rana -->
                <div class="story-card" style="background-image: url('https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=300&q=80');" onclick="location.href='/user/profile'">
                    <div class="story-overlay">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=100&q=80" class="story-avatar-badge" alt="Rana">
                        <span class="story-user-name">Hello Rana</span>
                    </div>
                </div>

                <!-- Story Item 4: Rubel Hossain -->
                <div class="story-card" style="background-image: url('https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=300&q=80');" onclick="location.href='/user/profile'">
                    <div class="story-overlay">
                        <div class="story-avatar-placeholder">R</div>
                        <span class="story-user-name">Rubel Hossain</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- CATEGORY FILTER PILLS -->
        <div class="categories-section">
            <div class="categories-wrapper">
                <a href="#" class="category-pill active">
                    <i class="fa-solid fa-wand-magic-sparkles"></i> For you
                </a>
                <a href="#" class="category-pill">
                    <i class="fa-regular fa-rectangle-list"></i> Tasks
                </a>
                <a href="#" class="category-pill">
                    <i class="fa-solid fa-trophy"></i> Contest
                </a>
                <a href="#" class="category-pill">
                    <i class="fa-solid fa-gift"></i> Refer
                </a>
            </div>
        </div>

        <!-- POSTS FEED CONTAINER -->
        <div id="feed">
            @include('partials.posts', ['reports' => $reports])
        </div>

    </div>

    <!-- MODAL FOR IMAGE -->
    <div id="imgModal" class="modal" onclick="closeImage()">
        <img id="modalImg" alt="Enlarged Post Image">
    </div>

    <!-- FIXED BOTTOM APP NAVIGATION -->
    <div class="bottom-nav">
        <a href="/" class="nav-item active">
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
        <a href="/user/profile" class="nav-item">
            <i class="fa-solid fa-wallet"></i>
            <span>Wallet</span>
        </a>
        <a href="/user/profile" class="nav-item">
            <i class="fa-regular fa-user"></i>
            <span>Profile</span>
        </a>
    </div>


    <script>
        // See More / See Less Toggle
        function toggleDesc(id, btn) {
            let desc = document.getElementById('desc-' + id);
            if (desc.classList.contains('expanded')) {
                desc.classList.remove('expanded');
                btn.innerText = "See More";
            } else {
                desc.classList.add('expanded');
                btn.innerText = "See Less";
            }
        }

        // Image Modal Open/Close
        function openImage(src) {
            document.getElementById('imgModal').style.display = 'flex';
            document.getElementById('modalImg').src = src;
        }

        function closeImage() {
            document.getElementById('imgModal').style.display = 'none';
        }

        // Infinite Scroll
        let page = 1;
        let loading = false;

        window.addEventListener('scroll', function() {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 300) {
                loadMore();
            }
        });

        function loadMore() {
            if (loading) return;
            loading = true;
            page++;

            fetch("?page=" + page, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.text())
                .then(html => {
                    let parser = new DOMParser();
                    let doc = parser.parseFromString(html, 'text/html');
                    let newPosts = doc.querySelectorAll('.post-card');

                    if (newPosts.length === 0) {
                        loading = false;
                        return;
                    }

                    newPosts.forEach(post => {
                        document.getElementById('feed').appendChild(post);
                    });
                    loading = false;
                })
                .catch(() => {
                    loading = false;
                });
        }
    </script>
</body>

</html>