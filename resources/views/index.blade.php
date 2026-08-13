<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.gtm')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chanda vai</title>
    <!-- Dynamic Admin Header Ad Script -->
    @if(\App\Models\Setting::get('ad_script_head'))
        {!! \App\Models\Setting::get('ad_script_head') !!}
    @endif
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/habib-custom.css') }}">
    <style>
        .notif-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            background: #ef4444;
            color: #ffffff;
            font-size: 10px;
            font-weight: 800;
            padding: 2px 5px;
            border-radius: 10px;
            min-width: 16px;
            text-align: center;
            border: 2px solid #ffffff;
        }

        .notif-dropdown-card {
            position: absolute;
            top: 45px;
            right: 0;
            width: 320px;
            max-height: 420px;
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            border: 1px solid #e2e8f0;
            z-index: 1000;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .notif-dropdown-header {
            padding: 12px 14px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
        }

        .mark-read-btn {
            background: none;
            border: none;
            color: #2563eb;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
        }

        .notif-list-container {
            overflow-y: auto;
            max-height: 360px;
        }

        .notif-item {
            padding: 10px 14px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            gap: 10px;
            align-items: flex-start;
            text-decoration: none;
            color: inherit;
            transition: background 0.15s;
        }

        .notif-item.unread {
            background: #eff6ff;
        }

        .notif-item:hover {
            background: #f8fafc;
        }

        .notif-icon-badge {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #e0e7ff;
            color: #4338ca;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }

        .notif-body {
            flex: 1;
        }

        .notif-item-title {
            font-size: 13px;
            font-weight: 700;
            color: #0f172a;
        }

        .notif-item-text {
            font-size: 12px;
            color: #475569;
            margin-top: 2px;
            line-height: 1.3;
        }

        .notif-item-time {
            font-size: 10px;
            color: #94a3b8;
            margin-top: 4px;
        }
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
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }

        .create-story-bg {
            width: 100%;
            height: 110px;
            object-fit: cover;
        }

        .create-story-bg-initial {
            width: 100%;
            height: 110px;
            background: linear-gradient(135deg, #0284c7, #2563eb);
            color: #ffffff;
            font-size: 32px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .create-story-footer {
            height: 55px;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
            padding-bottom: 8px;
            position: relative;
        }

        .plus-badge-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #0084ff;
            color: #ffffff;
            border: 3px solid #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            position: absolute;
            top: -15px;
        }

        .create-story-lbl {
            font-size: 12px;
            font-weight: 700;
            color: #0f172a;
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

        /* FACEBOOK CREATE POST MODAL STYLES */
        .fb-modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.75);
            backdrop-filter: blur(4px);
            z-index: 10000;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        .fb-modal-overlay.active {
            display: flex;
        }

        .fb-modal-card {
            background: #242526;
            color: #e4e6eb;
            width: 100%;
            max-width: 500px;
            border-radius: 12px;
            border: 1px solid #3e4042;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            animation: fbModalPop 0.2s ease-out;
        }

        @keyframes fbModalPop {
            from { transform: scale(0.92); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .fb-modal-header {
            position: relative;
            padding: 14px 16px;
            border-bottom: 1px solid #3e4042;
            text-align: center;
        }

        .fb-modal-title {
            font-size: 20px;
            font-weight: 700;
            color: #e4e6eb;
            margin: 0;
        }

        .fb-modal-close-btn {
            position: absolute;
            right: 14px;
            top: 12px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #3a3b3c;
            color: #b0b3b8;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }

        .fb-modal-close-btn:hover {
            background: #4e4f50;
            color: #ffffff;
        }

        .fb-modal-body {
            padding: 16px;
            max-height: 80vh;
            overflow-y: auto;
        }

        /* User Info Row */
        .fb-user-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
        }

        .fb-user-avatar {
            width: 44px;
            height: 44px;
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

        .fb-user-details {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .fb-user-name {
            font-size: 15px;
            font-weight: 600;
            color: #e4e6eb;
            line-height: 1.2;
        }

        .fb-badges-row {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .fb-badge-btn {
            background: #3a3b3c;
            color: #e4e6eb;
            border: none;
            border-radius: 6px;
            padding: 4px 10px;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
        }

        .fb-badge-btn:hover {
            background: #4e4f50;
        }

        /* Post Input Textarea */
        .fb-input-area {
            position: relative;
            margin-bottom: 8px;
        }

        .fb-textarea {
            width: 100%;
            min-height: 110px;
            background: transparent;
            border: none;
            outline: none;
            color: #e4e6eb;
            font-family: inherit;
            font-size: 18px;
            line-height: 1.4;
            resize: none;
            box-sizing: border-box;
            transition: all 0.2s ease;
        }

        .fb-textarea::placeholder {
            color: #8a8d91;
        }

        /* Background Color Post Card Options */
        .fb-textarea.bg-post {
            min-height: 180px;
            border-radius: 12px;
            padding: 24px 16px;
            font-weight: 700;
            font-size: 22px;
            text-align: center;
        }

        .fb-textarea.bg-gradient-1 { background: linear-gradient(135deg, #ff416c, #ff4b2b); color: #ffffff; }
        .fb-textarea.bg-gradient-2 { background: linear-gradient(135deg, #8a2387, #e94057, #f27121); color: #ffffff; }
        .fb-textarea.bg-gradient-3 { background: linear-gradient(135deg, #11998e, #38ef7d); color: #ffffff; }
        .fb-textarea.bg-gradient-4 { background: linear-gradient(135deg, #00c6ff, #0072ff); color: #ffffff; }
        .fb-textarea.bg-gradient-5 { background: linear-gradient(135deg, #f857a6, #ff5858); color: #ffffff; }

        /* Text Controls Row (Aa & Emoji) */
        .fb-input-tools {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .fb-aa-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: linear-gradient(135deg, #ff4757, #2563eb, #10b981);
            color: #ffffff;
            font-weight: 800;
            font-size: 14px;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0,0,0,0.3);
        }

        .fb-emoji-trigger {
            background: none;
            border: none;
            color: #8a8d91;
            font-size: 20px;
            cursor: pointer;
            padding: 4px;
            border-radius: 50%;
            transition: color 0.2s;
        }

        .fb-emoji-trigger:hover {
            color: #f7b928;
        }

        /* Background Color Picker Palette */
        .fb-bg-picker {
            display: none;
            gap: 8px;
            margin-bottom: 12px;
            overflow-x: auto;
            padding-bottom: 4px;
        }

        .fb-bg-picker.active {
            display: flex;
        }

        .fb-bg-circle {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: 2px solid transparent;
            cursor: pointer;
            flex-shrink: 0;
        }

        .fb-bg-circle.selected {
            border-color: #ffffff;
        }

        /* Emoji Picker Drawer */
        .fb-emoji-drawer {
            display: none;
            background: #3a3b3c;
            border-radius: 8px;
            padding: 8px;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 12px;
        }

        .fb-emoji-drawer.active {
            display: flex;
        }

        .fb-emoji-item {
            font-size: 20px;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: background 0.15s;
        }

        .fb-emoji-item:hover {
            background: #4e4f50;
        }

        /* Add To Your Post Toolbar Box */
        .fb-add-box {
            border: 1px solid #3e4042;
            border-radius: 8px;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
            background: #242526;
        }

        .fb-add-label {
            font-size: 14px;
            font-weight: 600;
            color: #e4e6eb;
        }

        .fb-add-actions {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .fb-icon-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: none;
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .fb-icon-btn:hover {
            background: #3a3b3c;
        }

        .icon-photo { color: #45bd62; }
        .icon-tag { color: #1877f2; }
        .icon-feeling { color: #f7b928; }
        .icon-location { color: #f5533d; }
        .icon-video { color: #26a69a; }
        .icon-more { color: #b0b3b8; }

        /* Image Preview Container */
        .fb-media-preview-box {
            display: none;
            position: relative;
            margin-bottom: 12px;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #3e4042;
        }

        .fb-media-preview-box img {
            width: 100%;
            max-height: 250px;
            object-fit: cover;
            display: block;
        }

        .fb-remove-preview-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.7);
            color: #ffffff;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        /* Extra Collapsible Inputs (Location, Video, Category) */
        .fb-extra-field {
            display: none;
            margin-bottom: 12px;
        }

        .fb-extra-field.active {
            display: block;
        }

        .fb-select-input, .fb-text-input {
            width: 100%;
            background: #3a3b3c;
            border: 1px solid #4e4f50;
            color: #e4e6eb;
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 13px;
            outline: none;
            box-sizing: border-box;
        }

        .fb-select-input option {
            background: #242526;
            color: #e4e6eb;
        }

        /* Submit Post Button */
        .fb-submit-btn {
            width: 100%;
            height: 38px;
            border-radius: 6px;
            background: #2374e1;
            color: #ffffff;
            font-weight: 600;
            font-size: 15px;
            border: none;
            cursor: pointer;
            transition: background 0.2s, opacity 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .fb-submit-btn:disabled {
            background: #505151;
            color: #8a8d91;
            cursor: not-allowed;
        }

        .fb-submit-btn:not(:disabled):hover {
            background: #1a6ed8;
        }
        /* DAILY CHALLENGE & INCOME CARD STYLES */
        .daily-challenge-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 16px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .challenge-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
            padding-bottom: 10px;
            border-bottom: 1px solid #f1f5f9;
        }

        .challenge-title-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .challenge-icon {
            font-size: 24px;
        }

        .challenge-title {
            font-size: 15px;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }

        .challenge-subtitle {
            font-size: 12px;
            color: #64748b;
            margin: 2px 0 0 0;
        }

        .user-points-badge {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: #ffffff;
            font-weight: 700;
            font-size: 13px;
            padding: 4px 12px;
            border-radius: 20px;
            box-shadow: 0 2px 6px rgba(217, 119, 6, 0.3);
        }

        .challenge-tasks-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 14px;
        }

        @media (max-width: 500px) {
            .challenge-tasks-grid {
                grid-template-columns: 1fr;
            }
        }

        .challenge-task-item {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px;
        }

        .challenge-task-item.completed {
            background: #f0fdf4;
            border-color: #bbf7d0;
        }

        .task-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 6px;
        }

        .task-name {
            font-size: 12px;
            font-weight: 600;
            color: #334155;
        }

        .task-count {
            font-size: 11px;
            font-weight: 700;
            color: #2563eb;
        }

        .challenge-task-item.completed .task-count {
            color: #16a34a;
        }

        .task-progress-bar {
            height: 6px;
            background: #e2e8f0;
            border-radius: 3px;
            overflow: hidden;
        }

        .task-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #2563eb, #3b82f6);
            border-radius: 3px;
            transition: width 0.4s ease;
        }

        .challenge-task-item.completed .task-progress-fill {
            background: linear-gradient(90deg, #16a34a, #22c55e);
        }

        .claim-reward-btn {
            width: 100%;
            padding: 10px;
            border-radius: 10px;
            border: none;
            background: linear-gradient(135deg, #16a34a, #22c55e);
            color: #ffffff;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3);
            transition: transform 0.2s, opacity 0.2s;
            margin-bottom: 12px;
        }

        .claim-reward-btn:disabled {
            background: #cbd5e1;
            color: #64748b;
            box-shadow: none;
            cursor: not-allowed;
        }

        .claim-reward-btn:not(:disabled):hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(22, 163, 74, 0.4);
        }

        /* Income Status Box */
        .income-eligibility-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 10px 14px;
        }

        .income-header {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 4px;
        }

        .income-icon {
            font-size: 16px;
        }

        .income-title {
            font-size: 13px;
            font-weight: 700;
            color: #0f172a;
        }

        .income-status-desc {
            font-size: 12px;
            color: #475569;
            line-height: 1.4;
        }

        .income-badge-active {
            display: inline-block;
            background: #dcfce7;
            color: #15803d;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 6px;
            font-size: 11px;
            margin-right: 4px;
        }

        .income-badge-locked {
            display: inline-block;
            background: #fef3c7;
            color: #b45309;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 6px;
            font-size: 11px;
            margin-right: 4px;
        }

        /* FIXED BOTTOM APP NAVIGATION STYLES */
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

        /* FACEBOOK-STYLE POST VIEWER MODAL STYLES */
        .fb-viewer-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.88);
            backdrop-filter: blur(8px);
            z-index: 10005;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        .fb-viewer-overlay.active {
            display: flex;
        }

        .fb-viewer-card {
            position: relative;
            background: #ffffff;
            width: 95%;
            max-width: 1050px;
            height: 90vh;
            max-height: 720px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.5);
        }

        .fb-viewer-close-btn {
            position: absolute;
            top: 14px;
            right: 14px;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(15, 23, 42, 0.75);
            color: #ffffff;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            cursor: pointer;
            z-index: 30;
            transition: background 0.2s;
        }

        .fb-viewer-close-btn:hover {
            background: rgba(15, 23, 42, 0.95);
        }

        .fb-viewer-layout {
            display: flex;
            width: 100%;
            height: 100%;
        }

        @media (max-width: 768px) {
            .fb-viewer-layout {
                flex-direction: column;
                overflow-y: auto;
            }
            .fb-viewer-card {
                height: 95vh;
                max-height: 95vh;
            }
        }

        .fb-viewer-media-pane {
            flex: 1.4;
            background: #09090b;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
            min-height: 250px;
        }

        .fb-viewer-media-pane img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .fb-viewer-content-pane {
            flex: 1;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            padding: 16px;
            overflow-y: auto;
        }
    </style>
</head>

<body>

    <!-- TOP BAR -->
    <div class="app-topbar">
        <a href="/" class="brand-logo">
            <span class="brand-badge">c</span>
            <span class="brand-title">chanda vai</span>
        </a>
        <div class="topbar-actions">
            <button class="top-btn-icon" onclick="openCreatePostModal()" title="Create Post">
                <i class="fa-solid fa-plus"></i>
            </button>
            <a href="/referral-leaderboard" class="top-btn-icon" title="Referral Leaderboard">
                <i class="fa-solid fa-trophy" style="color: #f59e0b;"></i>
            </a>
            @if(auth()->check() && auth()->user()->isAdmin())
                <a href="{{ route('admin.settings') }}" style="background: linear-gradient(135deg, #1877f2, #0052cc); color: #ffffff; font-weight: 700; border-radius: 20px; padding: 5px 12px; text-decoration: none; font-size: 11px; display: inline-flex; align-items: center; gap: 5px; box-shadow: 0 2px 6px rgba(24, 119, 242, 0.4);" title="Admin Panel">
                    <i class="fa-solid fa-user-shield"></i> Admin
                </a>
            @endif
            @auth
            <div style="position: relative;">
                <button class="top-btn-icon" id="notifBellBtn" onclick="toggleNotificationDrawer()" title="Notifications">
                    <i class="fa-regular fa-bell"></i>
                    <span id="notifBadge" class="notif-badge" style="display: none;">0</span>
                </button>

                <!-- Notification Dropdown Drawer -->
                <div id="notifDropdown" class="notif-dropdown-card" style="display: none;">
                    <div class="notif-dropdown-header">
                        <span>🔔 Notifications</span>
                        <button type="button" onclick="markAllNotificationsRead()" class="mark-read-btn">Mark all read</button>
                    </div>
                    <div id="notifListContainer" class="notif-list-container">
                        <div style="padding: 16px; text-align: center; color: #64748b; font-size: 13px;">Loading notifications...</div>
                    </div>
                </div>
            </div>
            @endauth
            <a href="/chat" class="top-btn-icon" title="Messenger" style="position: relative;">
                <i class="fa-brands fa-facebook-messenger" style="color: #0084ff; font-size: 20px;"></i>
                <span id="navChatUnreadBadge" class="notif-badge" style="display: none;">0</span>
            </a>
        </div>
    </div>

    <!-- FEED MAIN CONTAINER -->
    <div class="main-container">

        @if(!($isReels ?? false))
        <!-- WHAT'S ON YOUR MIND? -->
        <div class="mind-bar">
            <a href="/user/profile" class="user-avatar-initial" style="text-decoration:none;">
                {{ strtoupper(substr(auth()->user()->name ?? 'R', 0, 1)) }}
            </a>
            <div class="mind-input-btn" onclick="openCreatePostModal()" style="cursor: pointer;">
                <span>What's on your mind, {{ strtok(auth()->user()->name ?? 'Rs', ' ') }}?</span>
                <i class="fa-regular fa-image img-icon"></i>
            </div>
        </div>

        <!-- STORIES HORIZONTAL CAROUSEL -->
        <div class="stories-section">
            <div class="stories-wrapper" id="storiesWrapperContainer">
                <!-- STORY ITEM 0: CREATE STORY (+) -->
                <div class="story-card create-story-card" onclick="openCreateStoryModal()">
                    @if(auth()->check() && auth()->user()->profile_photo_url)
                        <img src="{{ auth()->user()->profile_photo_url }}" class="create-story-bg" alt="Your Profile">
                    @else
                        <div class="create-story-bg-initial">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}</div>
                    @endif
                    <div class="create-story-footer">
                        <div class="plus-badge-circle"><i class="fa-solid fa-plus"></i></div>
                        <span class="create-story-lbl">Create story</span>
                    </div>
                </div>

                <!-- DYNAMIC 24-HOUR ACTIVE STORIES -->
                @if(isset($stories) && count($stories) > 0)
                    @foreach($stories as $s)
                        <div class="story-card" style="background-image: url('{{ $s->image_url }}');" onclick="openStoryIndex({{ $loop->index }})">
                            <div class="story-overlay">
                                @if($s->user && $s->user->profile_photo_url)
                                    <img src="{{ $s->user->profile_photo_url }}" class="story-avatar-badge" alt="{{ $s->user->name }}">
                                @else
                                    <div class="story-avatar-placeholder">{{ strtoupper(substr($s->user->name ?? 'U', 0, 1)) }}</div>
                                @endif
                                <span class="story-user-name">{{ $s->user->name ?? 'User' }}</span>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        @endif

        <!-- CATEGORY FILTER PILLS -->
        <div class="categories-section">
            <div class="categories-wrapper">
                <a href="/" class="category-pill {{ !($isReels ?? false) ? 'active' : '' }}">
                    <i class="fa-solid fa-wand-magic-sparkles"></i> For you
                </a>
                <a href="/reels" class="category-pill {{ ($isReels ?? false) ? 'active' : '' }}">
                    <i class="fa-solid fa-clapperboard" style="color: #ef4444;"></i> Reels
                </a>
                <a href="/tasks" class="category-pill {{ request()->is('tasks') ? 'active' : '' }}">
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

        @if(!($isReels ?? false))
        @auth
        <!-- DAILY CHALLENGE & INCOME ELIGIBILITY CARD -->
        <div class="daily-challenge-card" id="dailyChallengeWidget">
            <div class="challenge-card-header">
                <div class="challenge-title-wrap">
                    <span class="challenge-icon">🎯</span>
                    <div>
                        <h4 class="challenge-title">আজকের চ্যালেঞ্জ (Daily Challenge)</h4>
                        <p class="challenge-subtitle">টাস্কগুলো পূরণ করে জিতে নিন ১০০ পয়েন্ট রিওয়ার্ড!</p>
                    </div>
                </div>
                <div class="user-points-badge" id="widgetPointsBadge">
                    🪙 <span id="widgetPointsValue">0</span> Pts
                </div>
            </div>

            <!-- TASK PROGRESS ITEMS -->
            <div class="challenge-tasks-grid">
                <!-- Task 1: 3 Posts Today -->
                <div class="challenge-task-item" id="taskItemPosts">
                    <div class="task-info">
                        <span class="task-name">📝 ৩ টি পোষ্ট করুন</span>
                        <span class="task-count" id="taskCountPosts">0 / 3</span>
                    </div>
                    <div class="task-progress-bar">
                        <div class="task-progress-fill" id="taskFillPosts" style="width: 0%;"></div>
                    </div>
                </div>

                <!-- Task 2: 10 Followers -->
                <div class="challenge-task-item" id="taskItemFollowers">
                    <div class="task-info">
                        <span class="task-name">👥 ১০ জন ফলোয়ার</span>
                        <span class="task-count" id="taskCountFollowers">0 / 10</span>
                    </div>
                    <div class="task-progress-bar">
                        <div class="task-progress-fill" id="taskFillFollowers" style="width: 0%;"></div>
                    </div>
                </div>

                <!-- Task 3: 20 Following -->
                <div class="challenge-task-item" id="taskItemFollowing">
                    <div class="task-info">
                        <span class="task-name">➕ ২০ জনকে ফলো করুন</span>
                        <span class="task-count" id="taskCountFollowing">0 / 20</span>
                    </div>
                    <div class="task-progress-bar">
                        <div class="task-progress-fill" id="taskFillFollowing" style="width: 0%;"></div>
                    </div>
                </div>

                <!-- Task 4: 100 Likes Today -->
                <div class="challenge-task-item" id="taskItemLikes">
                    <div class="task-info">
                        <span class="task-name">❤️ ১০০ টি পোষ্টে লাইক</span>
                        <span class="task-count" id="taskCountLikes">0 / 100</span>
                    </div>
                    <div class="task-progress-bar">
                        <div class="task-progress-fill" id="taskFillLikes" style="width: 0%;"></div>
                    </div>
                </div>
            </div>

            <!-- CLAIM REWARD BUTTON -->
            <button type="button" id="claimRewardBtn" class="claim-reward-btn" onclick="claimDailyReward()" disabled>
                🔒 ৪টি চ্যালেঞ্জ টাস্কই পূরণ করুন (১০০ পয়েন্ট রিওয়ার্ড)
            </button>

            <!-- INCOME MONETIZATION ELIGIBILITY STATUS -->
            <div class="income-eligibility-box" id="incomeStatusBox">
                <div class="income-header">
                    <span class="income-icon">💰</span>
                    <span class="income-title">ইনকাম যোগ্যতা (Monetization Status)</span>
                </div>
                <div id="incomeStatusContent" class="income-status-desc">
                    ইনকাম স্ট্যাটাস লোড হচ্ছে...
                </div>
            </div>
        </div>
        @endauth

        @if(\App\Models\Setting::get('ad_script_sidebar'))
            <div class="sidebar-ad-card" style="background:#ffffff; border-radius:16px; padding:14px; margin-bottom:16px; box-shadow:0 2px 8px rgba(0,0,0,0.04); text-align:center;">
                <span style="font-size:10px; color:#94a3b8; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; display:block; margin-bottom:6px;">Sponsored Ad</span>
                {!! \App\Models\Setting::get('ad_script_sidebar') !!}
            </div>
        @endif
        @endif

        @if($isReels ?? false)
            <div style="background: linear-gradient(135deg, #0f172a, #1e293b); border-radius: 20px; padding: 16px 20px; margin-bottom: 16px; color: #ffffff; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 6px 16px rgba(0,0,0,0.2);">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div style="width: 42px; height: 42px; border-radius: 50%; background: linear-gradient(135deg, #ff4757, #ef4444); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 20px; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4); flex-shrink: 0;">
                        <i class="fa-solid fa-clapperboard"></i>
                    </div>
                    <div>
                        <h2 style="font-size: 18px; font-weight: 800; margin: 0; line-height: 1.2; letter-spacing: -0.3px;">Facebook Reels</h2>
                        <p style="font-size: 12px; color: #94a3b8; margin: 3px 0 0 0;">শুধুমাত্র ভিডিও পোষ্টসমূহ দেখুন</p>
                    </div>
                </div>
                <a href="/" style="background: rgba(255,255,255,0.12); color: #ffffff; font-size: 13px; font-weight: 700; padding: 8px 16px; border-radius: 20px; text-decoration: none;">
                    <i class="fa-solid fa-house" style="margin-right: 4px;"></i> Home
                </a>
            </div>
        @endif

        <!-- POSTS FEED CONTAINER -->
        <div id="feed">
            @include('partials.posts', ['reports' => $reports])
        </div>

    </div>

    <!-- FACEBOOK CREATE POST MODAL -->
    <div id="fbCreatePostModal" class="fb-modal-overlay" onclick="if(event.target===this) closeCreatePostModal()">
        <div class="fb-modal-card">
            <!-- Header -->
            <div class="fb-modal-header">
                <h3 class="fb-modal-title">Create post</h3>
                <button type="button" class="fb-modal-close-btn" onclick="closeCreatePostModal()" title="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form id="fbCreatePostForm" method="POST" action="/report/store" enctype="multipart/form-data" onsubmit="handleFbPostSubmit(event)">
                @csrf
                <div class="fb-modal-body">
                    <!-- User Header -->
                    <div class="fb-user-row">
                        <div class="fb-user-avatar">
                            {{ strtoupper(substr(auth()->user()->name ?? 'R', 0, 1)) }}
                        </div>
                        <div class="fb-user-details">
                            <div class="fb-user-name">{{ auth()->user()->name ?? 'Rs Hasan Talukder' }}</div>
                            <div class="fb-badges-row">
                                <button type="button" class="fb-badge-btn">
                                    <i class="fa-solid fa-earth-americas"></i> Public <i class="fa-solid fa-caret-down"></i>
                                </button>
                                <button type="button" class="fb-badge-btn" onclick="toggleExtraField('category')">
                                    <i class="fa-solid fa-plus"></i> AI label off <i class="fa-solid fa-caret-down"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Post Text Area -->
                    <div class="fb-input-area">
                        <textarea id="fbPostDescription" name="description" class="fb-textarea" placeholder="What's on your mind, {{ strtok(auth()->user()->name ?? 'Rs', ' ') }}?" oninput="checkFbPostValidity()"></textarea>
                    </div>

                    <!-- Color Background Palette -->
                    <div id="fbBgPicker" class="fb-bg-picker">
                        <div class="fb-bg-circle selected" style="background:#242526;" onclick="selectPostBg('')"></div>
                        <div class="fb-bg-circle" style="background:linear-gradient(135deg, #ff416c, #ff4b2b);" onclick="selectPostBg('bg-gradient-1')"></div>
                        <div class="fb-bg-circle" style="background:linear-gradient(135deg, #8a2387, #e94057, #f27121);" onclick="selectPostBg('bg-gradient-2')"></div>
                        <div class="fb-bg-circle" style="background:linear-gradient(135deg, #11998e, #38ef7d);" onclick="selectPostBg('bg-gradient-3')"></div>
                        <div class="fb-bg-circle" style="background:linear-gradient(135deg, #00c6ff, #0072ff);" onclick="selectPostBg('bg-gradient-4')"></div>
                        <div class="fb-bg-circle" style="background:linear-gradient(135deg, #f857a6, #ff5858);" onclick="selectPostBg('bg-gradient-5')"></div>
                    </div>

                    <!-- Emoji Drawer -->
                    <div id="fbEmojiDrawer" class="fb-emoji-drawer">
                        <span class="fb-emoji-item" onclick="insertEmoji('❤️')">❤️</span>
                        <span class="fb-emoji-item" onclick="insertEmoji('😂')">😂</span>
                        <span class="fb-emoji-item" onclick="insertEmoji('😍')">😍</span>
                        <span class="fb-emoji-item" onclick="insertEmoji('🔥')">🔥</span>
                        <span class="fb-emoji-item" onclick="insertEmoji('👍')">👍</span>
                        <span class="fb-emoji-item" onclick="insertEmoji('🎉')">🎉</span>
                        <span class="fb-emoji-item" onclick="insertEmoji('💯')">💯</span>
                        <span class="fb-emoji-item" onclick="insertEmoji('📌')">📌</span>
                        <span class="fb-emoji-item" onclick="insertEmoji('🚀')">🚀</span>
                        <span class="fb-emoji-item" onclick="insertEmoji('😮')">😮</span>
                        <span class="fb-emoji-item" onclick="insertEmoji('😢')">😢</span>
                        <span class="fb-emoji-item" onclick="insertEmoji('👏')">👏</span>
                    </div>

                    <!-- Text Tools Row (Aa & Emoji) -->
                    <div class="fb-input-tools">
                        <button type="button" class="fb-aa-btn" onclick="toggleFbBgPicker()" title="Formatting & Themes">Aa</button>
                        <button type="button" class="fb-emoji-trigger" onclick="toggleFbEmojiDrawer()" title="Add Emojis">
                            <i class="fa-regular fa-face-smile"></i>
                        </button>
                    </div>

                    <!-- Image Preview Container -->
                    <div id="fbMediaPreviewBox" class="fb-media-preview-box" style="display:none; position:relative;">
                        <div id="fbImagePreviewGrid" style="display:flex; flex-wrap:wrap; gap:6px; margin-bottom:6px;"></div>
                        <button type="button" class="fb-remove-preview-btn" onclick="removeFbImagePreview()">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <!-- Video Preview Container -->
                    <div id="fbVideoPreviewBox" class="fb-media-preview-box" style="display:none; position:relative; margin-top:8px;">
                        <video id="fbVideoPreviewPlayer" controls style="width:100%; max-height:220px; border-radius:10px; background:#000; display:block;"></video>
                        <button type="button" class="fb-remove-preview-btn" onclick="removeFbVideoPreview()">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <!-- Hidden Multiple Images File Input -->
                    <input type="file" id="fbImageInput" name="images[]" multiple accept="image/*" style="display:none;" onchange="handleFbImageSelect(this)">

                    <!-- Hidden Direct Video File Input -->
                    <input type="file" id="fbVideoFileInput" name="video" accept="video/*" style="display:none;" onchange="handleFbVideoFileSelect(this)">

                    <!-- Optional Extra Fields (Location, Video, Category) -->
                    <div id="fbFieldCategory" class="fb-extra-field">
                        <input type="text" name="category" class="fb-text-input" placeholder="Tag / Category (e.g. News, Discussion, General)">
                    </div>

                    <div id="fbFieldVideo" class="fb-extra-field">
                        <input type="text" name="video_url" class="fb-text-input" placeholder="YouTube Video URL (optional)" oninput="checkFbPostValidity()">
                    </div>

                    <div id="fbFieldLocation" class="fb-extra-field">
                        <input type="text" name="location" class="fb-text-input" placeholder="Location / Thana (e.g. Mirpur, Dhaka)">
                    </div>

                    <!-- Live Camera Viewfinder Box -->
                    <div id="liveCameraViewBox" style="display:none; background:#0f172a; border-radius:14px; padding:12px; margin-top:10px; text-align:center; position:relative;">
                        <video id="liveCameraFeed" autoplay playsinline style="width:100%; max-height:220px; border-radius:10px; object-fit:cover; display:block;"></video>
                        <canvas id="cameraCanvas" style="display:none;"></canvas>
                        <div style="display:flex; justify-content:center; gap:10px; margin-top:10px;">
                            <button type="button" onclick="snapCameraPhoto()" style="background:#22c55e; color:#fff; border:none; border-radius:20px; padding:8px 18px; font-size:13px; font-weight:700; cursor:pointer;">
                                <i class="fa-solid fa-camera"></i> Snap Photo
                            </button>
                            <button type="button" onclick="closeLiveCameraCapture()" style="background:#ef4444; color:#fff; border:none; border-radius:20px; padding:8px 18px; font-size:13px; font-weight:700; cursor:pointer;">
                                Cancel
                            </button>
                        </div>
                    </div>

                    <!-- Add to your post Toolbar -->
                    <div class="fb-add-box">
                        <span class="fb-add-label">Add to your post</span>
                        <div class="fb-add-actions">
                            <button type="button" class="fb-icon-btn icon-photo" onclick="triggerFbImageUpload()" title="Photos">
                                <i class="fa-solid fa-images"></i>
                            </button>
                            <button type="button" class="fb-icon-btn" onclick="openLiveCameraCapture()" title="Take Live Camera Photo" style="color:#ef4444;">
                                <i class="fa-solid fa-camera"></i>
                            </button>
                            <button type="button" class="fb-icon-btn icon-video" onclick="triggerFbVideoFileUpload()" title="Upload Video File">
                                <i class="fa-solid fa-video"></i>
                            </button>
                            <button type="button" class="fb-icon-btn icon-tag" onclick="toggleExtraField('category')" title="Tag Category">
                                <i class="fa-solid fa-user-tag"></i>
                            </button>
                            <button type="button" class="fb-icon-btn icon-feeling" onclick="toggleFbEmojiDrawer()" title="Feeling/activity">
                                <i class="fa-regular fa-face-smile"></i>
                            </button>
                            <button type="button" class="fb-icon-btn icon-location" onclick="toggleExtraField('location')" title="Check in / Location">
                                <i class="fa-solid fa-location-dot"></i>
                            </button>
                            <button type="button" class="fb-icon-btn icon-video" onclick="toggleExtraField('video')" title="YouTube Link">
                                <i class="fa-brands fa-youtube"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Submit / Next Button -->
                    <button type="submit" id="fbSubmitBtn" class="fb-submit-btn" disabled>Next</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL FOR IMAGE -->
    <div id="imgModal" class="modal" onclick="closeImage()">
        <img id="modalImg" alt="Enlarged Post Image">
    </div>

    <!-- FACEBOOK-STYLE FULL POST VIEWER MODAL -->
    <div id="fbPostViewerModal" class="fb-viewer-overlay" onclick="if(event.target===this) closeFbPostViewer()">
        <div class="fb-viewer-card">
            <button type="button" class="fb-viewer-close-btn" onclick="closeFbPostViewer()" title="Close viewer">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="fb-viewer-layout">
                <!-- Left Media Pane -->
                <div class="fb-viewer-media-pane" id="fbViewerMediaPane">
                    <img id="fbViewerImg" src="" alt="Post Image" style="display:none;">
                    <div id="fbViewerVideoContainer" style="display:none; width:100%; height:100%;"></div>
                </div>

                <!-- Right Content Pane -->
                <div class="fb-viewer-content-pane">
                    <div class="fb-viewer-author-row" id="fbViewerAuthorSlot"></div>
                    <div class="fb-viewer-text-body">
                        <h3 id="fbViewerTitle" style="font-size:16px; font-weight:700; color:#0f172a; margin-bottom:8px; display:none;"></h3>
                        <p id="fbViewerDesc" style="font-size:14px; color:#334155; line-height:1.5; white-space:pre-wrap;"></p>
                    </div>
                    <div id="fbViewerActionsSlot" style="border-top:1px solid #f1f5f9; padding-top:10px; margin-top:10px;"></div>
                    <div class="fb-viewer-comments-section" id="fbViewerCommentsSlot" style="flex:1; overflow-y:auto; margin-top:10px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- FIXED BOTTOM APP NAVIGATION -->
    <div class="bottom-nav">
        <a href="/" class="nav-item {{ !($isReels ?? false) ? 'active' : '' }}">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>
        <a href="/reels" class="nav-item {{ ($isReels ?? false) ? 'active' : '' }}">
            <i class="fa-solid fa-clapperboard"></i>
            <span>Reels</span>
        </a>
        <button type="button" class="nav-item nav-item-create" onclick="openCreatePostModal()" style="border:none; background:none; cursor:pointer;">
            <i class="fa-solid fa-plus"></i>
            <span>Create</span>
        </button>
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
        // Facebook Create Post Modal Functions
        function openCreatePostModal() {
            if (typeof IS_AUTH !== 'undefined' && !IS_AUTH) {
                window.location.href = '/register';
                return;
            }

            // Prompt camera & gallery permissions
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({ video: true, audio: false })
                .then(stream => { stream.getTracks().forEach(t => t.stop()); })
                .catch(e => {});
            }

            document.getElementById('fbCreatePostModal').classList.add('active');
            document.body.style.overflow = 'hidden';
            setTimeout(() => {
                document.getElementById('fbPostDescription').focus();
            }, 100);
        }

        function closeCreatePostModal() {
            closeLiveCameraCapture();
            document.getElementById('fbCreatePostModal').classList.remove('active');
            document.body.style.overflow = '';
        }

        let liveCameraStream = null;

        function openLiveCameraCapture() {
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' }, audio: false })
                .then(stream => {
                    liveCameraStream = stream;
                    const videoEl = document.getElementById('liveCameraFeed');
                    if (videoEl) videoEl.srcObject = stream;
                    document.getElementById('liveCameraViewBox').style.display = 'block';
                })
                .catch(err => {
                    alert('Camera permission denied or camera unavailable. Selecting from photo gallery...');
                    document.getElementById('fbImageInput').click();
                });
            } else {
                document.getElementById('fbImageInput').click();
            }
        }

        function snapCameraPhoto() {
            const videoEl = document.getElementById('liveCameraFeed');
            const canvas = document.getElementById('cameraCanvas');
            if (!videoEl || !canvas) return;

            canvas.width = videoEl.videoWidth || 640;
            canvas.height = videoEl.videoHeight || 480;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(videoEl, 0, 0, canvas.width, canvas.height);

            canvas.toBlob(blob => {
                const file = new File([blob], 'camera_snap_' + Date.now() + '.jpg', { type: 'image/jpeg' });
                const container = new DataTransfer();
                container.items.add(file);
                const input = document.getElementById('fbImageInput');
                input.files = container.files;
                handleFbImageSelect(input);
                closeLiveCameraCapture();
            }, 'image/jpeg', 0.9);
        }

        function closeLiveCameraCapture() {
            if (liveCameraStream) {
                liveCameraStream.getTracks().forEach(t => t.stop());
                liveCameraStream = null;
            }
            const viewBox = document.getElementById('liveCameraViewBox');
            if (viewBox) viewBox.style.display = 'none';
        }

        // Notification Drawer Logic
        function toggleNotificationDrawer() {
            const dropdown = document.getElementById('notifDropdown');
            if (!dropdown) return;
            if (dropdown.style.display === 'none' || !dropdown.style.display) {
                dropdown.style.display = 'flex';
                fetchNotifications();
            } else {
                dropdown.style.display = 'none';
            }
        }

        function fetchNotifications() {
            fetch('/user/notifications')
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        const badge = document.getElementById('notifBadge');
                        if (badge) {
                            if (data.unread_count > 0) {
                                badge.innerText = data.unread_count;
                                badge.style.display = 'inline-block';
                            } else {
                                badge.style.display = 'none';
                            }
                        }

                        const container = document.getElementById('notifListContainer');
                        if (container && data.notifications) {
                            if (data.notifications.length === 0) {
                                container.innerHTML = '<div style="padding:20px; text-align:center; color:#94a3b8; font-size:13px;">কোনো নোটিফিকেশন নেই</div>';
                                return;
                            }

                            container.innerHTML = data.notifications.map(n => `
                                <a href="${n.link || '#'}" class="notif-item ${!n.is_read ? 'unread' : ''}">
                                    <div class="notif-icon-badge">
                                        <i class="fa-solid ${getNotifIcon(n.type)}"></i>
                                    </div>
                                    <div class="notif-body">
                                        <div class="notif-item-title">${escapeHtml(n.title)}</div>
                                        <div class="notif-item-text">${escapeHtml(n.message)}</div>
                                    </div>
                                </a>
                            `).join('');
                        }
                    }
                })
                .catch(err => console.error('Notifications fetch error:', err));
        }

        function getNotifIcon(type) {
            switch(type) {
                case 'like': return 'fa-heart';
                case 'comment':
                case 'comment_reply': return 'fa-comment';
                case 'star': return 'fa-star';
                case 'follow': return 'fa-user-plus';
                case 'referral': return 'fa-gift';
                default: return 'fa-bell';
            }
        }

        function markAllNotificationsRead() {
            fetch('/user/notifications/read', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(res => res.json())
            .then(data => {
                const badge = document.getElementById('notifBadge');
                if (badge) badge.style.display = 'none';
                document.querySelectorAll('.notif-item.unread').forEach(el => el.classList.remove('unread'));
            })
            .catch(err => console.error('Mark read error:', err));
        }

        function checkFbPostValidity() {
            const text = document.getElementById('fbPostDescription').value.trim();
            const hasImg = document.getElementById('fbImageInput') && document.getElementById('fbImageInput').files.length > 0;
            const videoFileInput = document.getElementById('fbVideoFileInput');
            const hasVideoFile = videoFileInput && videoFileInput.files.length > 0;
            const videoUrlInput = document.querySelector('input[name="video_url"]');
            const hasVideoUrl = videoUrlInput && videoUrlInput.value.trim().length > 0;

            const submitBtn = document.getElementById('fbSubmitBtn');
            if (text.length > 0 || hasImg || hasVideoFile || hasVideoUrl) {
                submitBtn.removeAttribute('disabled');
            } else {
                submitBtn.setAttribute('disabled', 'true');
            }
        }

        function toggleFbBgPicker() {
            const picker = document.getElementById('fbBgPicker');
            picker.classList.toggle('active');
        }

        function selectPostBg(bgClass) {
            const textarea = document.getElementById('fbPostDescription');
            textarea.className = 'fb-textarea';
            if (bgClass) {
                textarea.classList.add('bg-post', bgClass);
            }
            document.querySelectorAll('.fb-bg-circle').forEach(c => c.classList.remove('selected'));
            event.target.classList.add('selected');
        }

        function toggleFbEmojiDrawer() {
            const drawer = document.getElementById('fbEmojiDrawer');
            drawer.classList.toggle('active');
        }

        function insertEmoji(emoji) {
            const textarea = document.getElementById('fbPostDescription');
            textarea.value += emoji;
            checkFbPostValidity();
            textarea.focus();
        }

        function triggerFbImageUpload() {
            document.getElementById('fbImageInput').click();
        }

        function triggerFbVideoFileUpload() {
            document.getElementById('fbVideoFileInput').click();
        }

        function handleFbImageSelect(input) {
            const grid = document.getElementById('fbImagePreviewGrid');
            grid.innerHTML = '';
            if (input.files && input.files.length > 0) {
                Array.from(input.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.cssText = 'width:60px; height:60px; object-fit:cover; border-radius:8px; border:1px solid #3e4042;';
                        grid.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                });
                document.getElementById('fbMediaPreviewBox').style.display = 'block';
                checkFbPostValidity();
            }
        }

        function removeFbImagePreview() {
            document.getElementById('fbImageInput').value = '';
            document.getElementById('fbImagePreviewGrid').innerHTML = '';
            document.getElementById('fbMediaPreviewBox').style.display = 'none';
            checkFbPostValidity();
        }

        function handleFbVideoFileSelect(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                const url = URL.createObjectURL(file);
                const player = document.getElementById('fbVideoPreviewPlayer');
                player.src = url;
                document.getElementById('fbVideoPreviewBox').style.display = 'block';
                checkFbPostValidity();
            }
        }

        function removeFbVideoPreview() {
            document.getElementById('fbVideoFileInput').value = '';
            document.getElementById('fbVideoPreviewPlayer').src = '';
            document.getElementById('fbVideoPreviewBox').style.display = 'none';
            checkFbPostValidity();
        }

        function toggleExtraField(type) {
            if (type === 'location') {
                const el = document.getElementById('fbFieldLocation');
                el.classList.toggle('active');
            } else if (type === 'video') {
                const el = document.getElementById('fbFieldVideo');
                el.classList.toggle('active');
            } else if (type === 'category') {
                const el = document.getElementById('fbFieldCategory');
                el.classList.toggle('active');
            }
        }

        function handleFbPostSubmit(e) {
            e.preventDefault();
            const form = document.getElementById('fbCreatePostForm');
            const submitBtn = document.getElementById('fbSubmitBtn');
            
            submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Posting...';
            submitBtn.setAttribute('disabled', 'true');

            const formData = new FormData(form);

            fetch('/report/store', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(res => {
                if (res.redirected) {
                    window.location.href = res.url;
                    return;
                }
                return res.json();
            })
            .then(data => {
                closeCreatePostModal();
                // Reload feed cleanly to show new post at top
                window.location.reload();
            })
            .catch(err => {
                // Fallback standard submit
                form.submit();
            });
        }

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

            let reqUrl = new URL(window.location.href);
            reqUrl.searchParams.set('page', page);

            fetch(reqUrl.toString(), {
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

        // Daily Challenge & Monetization Widget Functions
        function updateDailyChallengeWidget() {
            const widget = document.getElementById('dailyChallengeWidget');
            if (!widget) return;

            fetch('/user/challenge-status')
                .then(res => res.json())
                .then(data => {
                    if (!data || data.status !== 'success') return;

                    // Update Points Badge
                    const ptsVal = document.getElementById('widgetPointsValue');
                    if (ptsVal) ptsVal.innerText = data.user.points;

                    const tasks = data.challenge.tasks;

                    // Task 1: Posts
                    updateTaskUI('Posts', tasks.posts.current, tasks.posts.target, tasks.posts.done);

                    // Task 2: Followers
                    updateTaskUI('Followers', tasks.followers.current, tasks.followers.target, tasks.followers.done);

                    // Task 3: Following
                    updateTaskUI('Following', tasks.following.current, tasks.following.target, tasks.following.done);

                    // Task 4: Likes
                    updateTaskUI('Likes', tasks.likes.current, tasks.likes.target, tasks.likes.done);

                    // Claim Reward Button
                    const claimBtn = document.getElementById('claimRewardBtn');
                    if (claimBtn) {
                        if (data.challenge.is_claimed) {
                            claimBtn.innerText = '✅ আজকের ১০০ পয়েন্ট রিওয়ার্ড ক্লেইমড!';
                            claimBtn.setAttribute('disabled', 'true');
                            claimBtn.style.background = '#e2e8f0';
                            claimBtn.style.color = '#334155';
                        } else if (data.challenge.is_completed) {
                            claimBtn.innerText = '🎁 Claim ' + data.challenge.reward_points + ' Points Reward!';
                            claimBtn.removeAttribute('disabled');
                            claimBtn.style.background = 'linear-gradient(135deg, #16a34a, #22c55e)';
                            claimBtn.style.color = '#ffffff';
                        } else {
                            claimBtn.innerText = '🔒 ৪টি চ্যালেঞ্জ টাস্কই পূরণ করুন (১০০ পয়েন্ট রিওয়ার্ড)';
                            claimBtn.setAttribute('disabled', 'true');
                            claimBtn.style.background = '#cbd5e1';
                            claimBtn.style.color = '#64748b';
                        }
                    }

                    // Monetization / Income Eligibility
                    const m = data.monetization;
                    const incBox = document.getElementById('incomeStatusContent');
                    if (incBox && m) {
                        if (m.eligible) {
                            incBox.innerHTML = `<span class="income-badge-active">✅ ইনকাম সক্রিয়</span> আপনার <strong>${m.current}</strong> জন ফলোয়ার রয়েছে। আপনার অ্যাকাউন্ট ইনকাম করার জন্য সম্পূর্ণ যোগ্য!`;
                        } else {
                            const needed = Math.max(0, m.required - m.current);
                            incBox.innerHTML = `<span class="income-badge-locked">🔒 ইনকাম লকড</span> ইনকাম শুরু করতে <strong>${m.required} জন ফলোয়ার</strong> প্রয়োজন। আপনার আছে <strong>${m.current}</strong> জন (আরও <strong>${needed}</strong> জন ফলোয়ার লাগবে)।`;
                        }
                    }
                })
                .catch(err => console.error('Challenge widget fetch error:', err));
        }

        function updateTaskUI(name, current, target, isDone) {
            const item = document.getElementById('taskItem' + name);
            const count = document.getElementById('taskCount' + name);
            const fill = document.getElementById('taskFill' + name);

            if (count) count.innerText = current + ' / ' + target;
            if (fill) {
                const pct = Math.min(100, Math.round((current / target) * 100));
                fill.style.width = pct + '%';
            }

            if (item) {
                if (isDone) {
                    item.classList.add('completed');
                } else {
                    item.classList.remove('completed');
                }
            }
        }

        function claimDailyReward() {
            const claimBtn = document.getElementById('claimRewardBtn');
            if (claimBtn) {
                claimBtn.setAttribute('disabled', 'true');
                claimBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Claiming...';
            }

            fetch('/user/claim-challenge', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message);
                    updateDailyChallengeWidget();
                } else {
                    alert(data.message || 'Error claiming reward');
                    updateDailyChallengeWidget();
                }
            })
            .catch(err => {
                console.error('Claim error:', err);
                updateDailyChallengeWidget();
            });
        }

        function openFbPostViewer(reportId) {
            const postCard = document.getElementById('post-card-' + reportId);
            if (!postCard) return;

            const modal = document.getElementById('fbPostViewerModal');
            const mediaPane = document.getElementById('fbViewerMediaPane');
            const img = document.getElementById('fbViewerImg');
            const videoBox = document.getElementById('fbViewerVideoContainer');
            const titleEl = document.getElementById('fbViewerTitle');
            const descEl = document.getElementById('fbViewerDesc');
            const authorSlot = document.getElementById('fbViewerAuthorSlot');
            const actionsSlot = document.getElementById('fbViewerActionsSlot');
            const commentsSlot = document.getElementById('fbViewerCommentsSlot');

            img.style.display = 'none';
            videoBox.style.display = 'none';
            videoBox.innerHTML = '';
            mediaPane.style.display = 'flex';

            const postImg = postCard.querySelector('.post-media-img');
            if (postImg) {
                img.src = postImg.src;
                img.style.display = 'block';
            } else {
                const iframe = postCard.querySelector('iframe');
                if (iframe) {
                    videoBox.innerHTML = iframe.outerHTML;
                    videoBox.style.display = 'block';
                } else {
                    mediaPane.style.display = 'none';
                }
            }

            const authorRow = postCard.querySelector('.post-author-row');
            if (authorRow) {
                authorSlot.innerHTML = authorRow.outerHTML;
            }

            const title = postCard.querySelector('.post-content-title');
            if (title && title.innerText.trim()) {
                titleEl.innerText = title.innerText;
                titleEl.style.display = 'block';
            } else {
                titleEl.style.display = 'none';
            }

            const desc = postCard.querySelector('.post-content-desc');
            if (desc) {
                descEl.innerText = desc.innerText;
            } else {
                descEl.innerText = '';
            }

            const actionsBar = postCard.querySelector('.post-actions-bar');
            if (actionsBar) {
                actionsSlot.innerHTML = actionsBar.outerHTML;
            }

            const commentsDrawer = postCard.querySelector('.comments-drawer');
            if (commentsDrawer) {
                commentsSlot.innerHTML = commentsDrawer.outerHTML;
                const innerDrawer = commentsSlot.querySelector('.comments-drawer');
                if (innerDrawer) innerDrawer.style.display = 'block';
            }

            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeFbPostViewer() {
            const modal = document.getElementById('fbPostViewerModal');
            if (modal) modal.classList.remove('active');
            document.body.style.overflow = '';
            const videoBox = document.getElementById('fbViewerVideoContainer');
            if (videoBox) videoBox.innerHTML = '';
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateDailyChallengeWidget();
            if (typeof IS_AUTH !== 'undefined' && IS_AUTH) {
                fetchNotifications();
                try {
                    var screenRes = window.screen.width + 'x' + window.screen.height;
                    var timeZone = Intl.DateTimeFormat().resolvedOptions().timeZone || '';
                    fetch("{{ route('user.client-meta') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            screen_resolution: screenRes,
                            timezone: timeZone
                        })
                    });
                } catch(e) {}
            }
        });

        // ==========================================
        // DYNAMIC 24-HOUR FACEBOOK STORY SYSTEM
        // ==========================================
        let selectedStoryFile = null;
        let storyProgressTimer = null;

        function openCreateStoryModal() {
            if (!requireAuth()) return;
            document.getElementById('createStoryModal').classList.add('active');
        }

        function closeCreateStoryModal() {
            document.getElementById('createStoryModal').classList.remove('active');
            selectedStoryFile = null;
            document.getElementById('storyImageInput').value = '';
            document.getElementById('storyImagePreview').style.display = 'none';
            document.getElementById('storyPlaceholderContent').style.display = 'block';
            document.getElementById('storyCaptionInput').value = '';
        }

        function previewStoryImage(input) {
            if (input.files && input.files[0]) {
                selectedStoryFile = input.files[0];
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('storyImagePreview');
                    img.src = e.target.result;
                    img.style.display = 'block';
                    document.getElementById('storyPlaceholderContent').style.display = 'none';
                };
                reader.readAsDataURL(selectedStoryFile);
            }
        }

        function submitStory() {
            if (!selectedStoryFile) {
                alert('Please select an image for your story.');
                return;
            }

            const btn = document.getElementById('btnSubmitStory');
            btn.disabled = true;
            btn.innerText = 'Sharing to Story...';

            const formData = new FormData();
            formData.append('image', selectedStoryFile);
            formData.append('caption', document.getElementById('storyCaptionInput').value.trim());

            fetch('/story/create', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                btn.disabled = false;
                btn.innerText = 'Share to Story 🚀';

                if (data.status === 'success') {
                    alert('Story shared successfully!');
                    closeCreateStoryModal();
                    window.location.reload();
                } else {
                    alert(data.message || 'Failed to share story');
                }
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerText = 'Share to Story 🚀';
                alert('Error uploading story');
            });
        }

        const allActiveStories = [
            @if(isset($stories))
                @foreach($stories as $s)
                    {
                        id: {{ $s->id }},
                        user_name: @json($s->user->name ?? 'User'),
                        user_avatar: @json($s->user->profile_photo_url ?? ''),
                        image_url: @json($s->image_url),
                        caption: @json($s->caption ?? ''),
                        time_ago: @json($s->created_at->diffForHumans())
                    },
                @endforeach
            @endif
        ];

        let currentStoryIndex = 0;

        function openStoryIndex(index) {
            if (index < 0 || index >= allActiveStories.length) {
                closeStoryViewer();
                return;
            }

            currentStoryIndex = index;
            const storyData = allActiveStories[index];

            const modal = document.getElementById('fbStoryViewerModal');
            document.getElementById('storyViewerName').innerText = storyData.user_name || 'User';
            document.getElementById('storyViewerTime').innerText = storyData.time_ago || '';
            document.getElementById('storyViewerImg').src = storyData.image_url;

            const avatarImg = document.getElementById('storyViewerAvatar');
            if (storyData.user_avatar) {
                avatarImg.src = storyData.user_avatar;
                avatarImg.style.display = 'block';
            } else {
                avatarImg.style.display = 'none';
            }

            const captionBox = document.getElementById('storyViewerCaptionBox');
            if (storyData.caption) {
                document.getElementById('storyViewerCaption').innerText = storyData.caption;
                captionBox.style.display = 'block';
            } else {
                captionBox.style.display = 'none';
            }

            modal.classList.add('active');

            // Reset & Start Progress Bar
            const bar = document.getElementById('storyProgressBar');
            bar.style.transition = 'none';
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.transition = 'width 5s linear';
                bar.style.width = '100%';
            }, 50);

            clearTimeout(storyProgressTimer);
            storyProgressTimer = setTimeout(() => {
                if (currentStoryIndex + 1 < allActiveStories.length) {
                    openStoryIndex(currentStoryIndex + 1);
                } else {
                    closeStoryViewer();
                }
            }, 5100);
        }

        function closeStoryViewer() {
            clearTimeout(storyProgressTimer);
            const modal = document.getElementById('fbStoryViewerModal');
            if (modal) modal.classList.remove('active');
            const bar = document.getElementById('storyProgressBar');
            if (bar) {
                bar.style.transition = 'none';
                bar.style.width = '0%';
            }
        }
    </script>

    <!-- CREATE STORY MODAL -->
    <div id="createStoryModal" class="insights-modal-overlay">
        <div class="insights-modal-card" style="max-width: 420px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                <h3 style="font-size:18px; font-weight:800; color:#0f172a;">Create Story 📖</h3>
                <button type="button" onclick="closeCreateStoryModal()" style="background:none; border:none; font-size:24px; color:#64748b; cursor:pointer;">&times;</button>
            </div>
            
            <input type="file" id="storyImageInput" accept="image/*" style="display:none;" onchange="previewStoryImage(this)">
            
            <div id="storyImageDropArea" onclick="document.getElementById('storyImageInput').click()" style="background:#f8fafc; border:2px dashed #cbd5e1; border-radius:16px; height:200px; display:flex; flex-direction:column; align-items:center; justify-content:center; cursor:pointer; overflow:hidden; position:relative; margin-bottom:14px;">
                <img id="storyImagePreview" style="display:none; width:100%; height:100%; object-fit:cover;">
                <div id="storyPlaceholderContent" style="text-align:center; color:#64748b;">
                    <i class="fa-regular fa-image" style="font-size:36px; color:#0084ff; margin-bottom:8px;"></i>
                    <p style="font-size:14px; font-weight:600; color:#0f172a;">Click to select photo</p>
                    <span style="font-size:12px; color:#94a3b8;">Add a photo to your 24h story</span>
                </div>
            </div>

            <div style="margin-bottom:20px;">
                <label style="font-size:13px; font-weight:600; color:#334155; margin-bottom:6px; display:block;">Story Caption (Optional)</label>
                <input type="text" id="storyCaptionInput" placeholder="Add a caption..." style="width:100%; border:1px solid #cbd5e1; border-radius:12px; padding:10px 14px; font-size:14px; outline:none;">
            </div>

            <button type="button" id="btnSubmitStory" onclick="submitStory()" style="width:100%; background:#0084ff; color:#fff; border:none; border-radius:25px; padding:12px; font-size:16px; font-weight:700; cursor:pointer; box-shadow:0 4px 12px rgba(0,132,255,0.3);">Share to Story 🚀</button>
        </div>
    </div>

    <!-- FACEBOOK FULL-SCREEN STORY VIEWER MODAL -->
    <div id="fbStoryViewerModal" class="insights-modal-overlay" style="background:rgba(0,0,0,0.92);">
        <div style="position:relative; width:100%; max-width:400px; height:90vh; background:#0f172a; border-radius:20px; overflow:hidden; display:flex; flex-direction:column; justify-content:space-between; box-shadow:0 20px 40px rgba(0,0,0,0.5);">
            <!-- TOP PROGRESS BAR -->
            <div style="position:absolute; top:12px; left:12px; right:12px; z-index:20;">
                <div style="height:3px; background:rgba(255,255,255,0.3); border-radius:3px; overflow:hidden;">
                    <div id="storyProgressBar" style="height:100%; width:0%; background:#ffffff; transition:width 5s linear;"></div>
                </div>
                
                <!-- AUTHOR HEADER -->
                <div style="display:flex; align-items:center; justify-content:space-between; margin-top:10px;">
                    <div style="display:flex; align-items:center; gap:10px;">
                        <img id="storyViewerAvatar" src="" style="width:36px; height:36px; border-radius:50%; border:2px solid #0084ff; object-fit:cover;">
                        <div>
                            <div id="storyViewerName" style="font-size:14px; font-weight:700; color:#fff;">Name</div>
                            <div id="storyViewerTime" style="font-size:11px; color:#cbd5e1;">Time</div>
                        </div>
                    </div>
                    <button type="button" onclick="closeStoryViewer()" style="background:none; border:none; color:#fff; font-size:24px; cursor:pointer;">&times;</button>
                </div>
            </div>

            <!-- STORY IMAGE & CAPTION -->
            <img id="storyViewerImg" src="" style="width:100%; height:100%; object-fit:cover;">
            
            <div id="storyViewerCaptionBox" style="position:absolute; bottom:20px; left:16px; right:16px; background:rgba(0,0,0,0.65); backdrop-filter:blur(6px); border-radius:14px; padding:12px 16px; color:#fff; font-size:14px; font-weight:600; text-align:center;">
                <span id="storyViewerCaption">Caption</span>
            </div>
        </div>
    </div>
</body>

</html>