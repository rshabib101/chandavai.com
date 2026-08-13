<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ad Manager - chanda vai</title>

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
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            -webkit-tap-highlight-color: transparent;
        }

        body {
            background-color: #f0f2f5;
            color: #1c1e21;
            min-height: 100vh;
            padding-bottom: 90px;
        }

        .app-container {
            max-width: 520px;
            margin: 0 auto;
            min-height: 100vh;
            position: relative;
            background-color: #f0f2f5;
            padding: 16px 16px 80px 16px;
        }

        .top-nav-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 6px 0;
        }

        .nav-back-btn {
            background: #ffffff;
            border: 1px solid #e4e6eb;
            font-size: 18px;
            color: #050505;
            cursor: pointer;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.04);
            transition: background 0.2s;
        }

        .nav-page-title {
            font-size: 20px;
            font-weight: 800;
            color: #050505;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .role-badge-pill {
            background: #e7f3ff;
            color: #1877f2;
            border-radius: 20px;
            padding: 5px 12px;
            font-size: 12px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .white-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border: 1px solid #e4e6eb;
        }

        .card-title-head {
            font-size: 17px;
            font-weight: 700;
            color: #050505;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 6px;
            display: block;
        }

        .form-label small {
            font-weight: 400;
            color: #64748b;
        }

        .form-control {
            width: 100%;
            background: #f8fafc;
            border: 1.5px solid #cbd5e1;
            border-radius: 10px;
            padding: 11px 14px;
            font-size: 14px;
            color: #0f172a;
            outline: none;
            transition: border-color 0.2s, background 0.2s;
        }

        .form-control:focus {
            border-color: #1877f2;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(24, 119, 242, 0.15);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 90px;
        }

        .file-upload-dropzone {
            border: 2px dashed #cbd5e1;
            background: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
        }

        .file-upload-dropzone:hover {
            border-color: #1877f2;
            background: #edf5ff;
        }

        .file-upload-dropzone input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .upload-icon {
            font-size: 28px;
            color: #1877f2;
            margin-bottom: 8px;
        }

        .preview-media-box {
            display: none;
            margin-top: 10px;
            border-radius: 10px;
            overflow: hidden;
            max-height: 240px;
            position: relative;
            background: #000;
        }

        .preview-media-box img, .preview-media-box video {
            width: 100%;
            height: 240px;
            object-fit: contain;
            display: block;
        }

        .btn-submit-ad {
            width: 100%;
            background: linear-gradient(135deg, #1877f2 0%, #166fe5 100%);
            color: #ffffff;
            border: none;
            border-radius: 25px;
            padding: 14px;
            font-size: 16px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(24, 119, 242, 0.35);
            transition: transform 0.15s;
        }

        .btn-submit-ad:active {
            transform: scale(0.98);
        }

        /* FACEBOOK LIVE AD PREVIEW CARD */
        .fb-preview-title {
            font-size: 12px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .fb-ad-card-preview {
            background: #ffffff;
            border-radius: 14px;
            border: 1px solid #e4e6eb;
            padding: 14px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            margin-bottom: 20px;
        }

        .fb-ad-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .fb-ad-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid #e4e6eb;
        }

        .fb-ad-brand-name {
            font-weight: 700;
            font-size: 14px;
            color: #050505;
        }

        .fb-ad-subtext {
            font-size: 11px;
            color: #65676b;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .fb-ad-body-text {
            font-size: 14px;
            color: #050505;
            line-height: 1.45;
            margin-bottom: 10px;
            word-break: break-word;
        }

        .fb-ad-media-holder {
            width: 100%;
            max-height: 280px;
            background: #000;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 160px;
        }

        .fb-ad-media-holder img, .fb-ad-media-holder video {
            width: 100%;
            max-height: 280px;
            object-fit: cover;
            display: block;
        }

        .fb-ad-cta-bar {
            background: #f0f2f5;
            border: 1px solid #e4e6eb;
            border-radius: 8px;
            padding: 10px 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .fb-ad-link-host {
            font-size: 11px;
            color: #65676b;
            text-transform: uppercase;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .fb-ad-headline-text {
            font-size: 14px;
            font-weight: 700;
            color: #050505;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.3;
            margin-top: 2px;
            word-break: break-word;
        }

        .fb-ad-cta-button {
            background: #e4e6eb;
            color: #050505;
            border-radius: 6px;
            padding: 7px 14px;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
            border: none;
        }

        /* ADS LIST TABLE / CARDS */
        .ad-item-card {
            background: #ffffff;
            border-radius: 14px;
            border: 1px solid #e4e6eb;
            padding: 14px;
            margin-bottom: 14px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03);
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .ad-item-top {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .ad-item-thumb {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
            background: #000;
            flex-shrink: 0;
        }

        .ad-item-info {
            flex: 1;
            overflow: hidden;
        }

        .ad-item-headline {
            font-size: 14px;
            font-weight: 700;
            color: #050505;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .ad-item-sub {
            font-size: 12px;
            color: #65676b;
            margin-top: 2px;
        }

        .ad-metrics-row {
            display: flex;
            align-items: center;
            justify-content: space-around;
            background: #f8fafc;
            border-radius: 8px;
            padding: 8px;
            font-size: 12px;
            color: #475569;
        }

        .ad-metric-item {
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: 600;
        }

        .ad-actions-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 8px;
            border-top: 1px solid #f1f5f9;
        }

        .status-toggle-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 12px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 12px;
        }

        .status-toggle-btn.active {
            background: #dcfce7;
            color: #15803d;
        }

        .status-toggle-btn.inactive {
            background: #fee2e2;
            color: #b91c1c;
        }

        .btn-delete-ad {
            background: none;
            border: none;
            color: #ef4444;
            font-size: 14px;
            cursor: pointer;
            padding: 4px 8px;
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
            z-index: 3000;
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

        <!-- TOP NAV BAR -->
        <div class="top-nav-bar">
            <a href="/user/analytics" class="nav-back-btn" title="Back to Analytics">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h1 class="nav-page-title">
                <i class="fa-solid fa-rectangle-ad" style="color:#1877f2;"></i>
                Ad Manager
            </h1>
            <div class="role-badge-pill">
                <i class="fa-solid fa-circle-check"></i> Advertiser
            </div>
        </div>

        <!-- CREATE AD FORM CARD -->
        <div class="white-card">
            <div class="card-title-head" style="display: flex; align-items: center; justify-content: space-between; position: relative;">
                <div style="position: relative;">
                    <button type="button" id="adModeDropdownBtn" onclick="toggleAdModeDropdown(event)" style="background: #eff6ff; color: #1877f2; border: 1px solid #bfdbfe; padding: 8px 16px; border-radius: 20px; font-weight: 700; font-size: 14px; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                        <span id="selectedModeText">➕ Create New Sponsored Ad</span>
                        <i class="fa-solid fa-chevron-down" style="font-size: 11px;"></i>
                    </button>
                    <div id="adModeDropdownMenu" style="display: none; position: absolute; top: 115%; left: 0; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.15); width: 260px; z-index: 100; overflow: hidden;">
                        <div onclick="selectAdMode('create_new')" style="padding: 12px 16px; cursor: pointer; font-size: 13.5px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 10px;">
                            <i class="fa-solid fa-plus-circle" style="color: #1877f2; font-size: 16px;"></i>
                            <div>
                                <div style="font-weight: 700;">➕ Create New Sponsored Ad</div>
                                <div style="font-size: 11px; color: #64748b;">Upload new photo or video</div>
                            </div>
                        </div>
                        <div onclick="selectAdMode('use_existing')" style="padding: 12px 16px; cursor: pointer; font-size: 13.5px; font-weight: 600; color: #0f172a; display: flex; align-items: center; gap: 10px;">
                            <i class="fa-solid fa-thumbtack" style="color: #10b981; font-size: 16px;"></i>
                            <div>
                                <div style="font-weight: 700;">📌 Use Existing Post</div>
                                <div style="font-size: 11px; color: #64748b;">Select an existing profile post</div>
                            </div>
                        </div>
                    </div>
                </div>
                <span style="font-size:12px; color:#1877f2; font-weight:600;">Facebook Vibe</span>
            </div>

            <form id="createAdForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="existing_report_id" id="inputExistingReportId" value="">

                <!-- SELECTED EXISTING POST BANNER -->
                <div id="selectedPostBanner" style="display: none; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 12px 16px; margin-bottom: 16px; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 10px; flex: 1; overflow: hidden;">
                        <div style="background: #10b981; color: #ffffff; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; flex-shrink: 0;">✓</div>
                        <div style="overflow: hidden;">
                            <div style="font-size: 11px; color: #15803d; font-weight: 700; text-transform: uppercase;">Existing Post Selected</div>
                            <div style="font-size: 13.5px; font-weight: 700; color: #0f172a; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" id="bannerPostTitle">Post Title</div>
                        </div>
                    </div>
                    <button type="button" onclick="openExistingPostsModal()" style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 8px; padding: 6px 12px; font-size: 12px; font-weight: 700; color: #0f172a; cursor: pointer; white-space: nowrap; margin-left: 10px;">Change Post</button>
                </div>

                <!-- PRIMARY TEXT -->
                <div class="form-group">
                    <label class="form-label">Primary Text <small>(Main post description)</small></label>
                    <textarea name="primary_text" id="inputPrimaryText" class="form-control" placeholder="e.g. ৪টি ভিন্ন ফ্লেভারের, ৪টি স্বাদ, ৪টি গুণ—এক সাথে এক কম্বোতে!..." oninput="updateLivePreview()"></textarea>
                </div>

                <!-- MEDIA UPLOAD -->
                <div class="form-group" id="mediaUploadFormGroup">
                    <label class="form-label">Media Upload <small>(Image or Video file)</small></label>
                    <div class="file-upload-dropzone" id="dropzoneBox">
                        <i class="fa-solid fa-cloud-arrow-up upload-icon"></i>
                        <div style="font-size:13px; font-weight:700; color:#0f172a;">Click or drag photo/video here</div>
                        <div style="font-size:11px; color:#64748b; margin-top:2px;">PNG, JPG, WEBP, MP4, MOV (Max 50MB)</div>
                        <input type="file" name="media" id="inputMediaFile" accept="image/*,video/*" required onchange="handleMediaPreview(event)">
                    </div>
                    <div class="preview-media-box" id="mediaPreviewContainer">
                        <img id="imagePreview" src="" alt="Ad Media Preview" style="display:none;">
                        <video id="videoPreview" controls src="" style="display:none;"></video>
                    </div>
                </div>

                <!-- SHORT HEADLINE -->
                <div class="form-group">
                    <label class="form-label">Short Headline <small>(Appears next to CTA button)</small></label>
                    <input type="text" name="headline" id="inputHeadline" class="form-control" placeholder="e.g. ২০০ টাকা ছাড় + ফ্রি গিফট 🎁" required oninput="updateLivePreview()">
                </div>

                <!-- CALL TO ACTION BUTTON SELECT -->
                <div class="form-group">
                    <label class="form-label">Call to Action Button</label>
                    <select name="cta_text" id="selectCtaText" class="form-control" required onchange="updateLivePreview()">
                        <option value="Order now" selected>Order now</option>
                        <option value="Shop now">Shop now</option>
                        <option value="Install now">Install now</option>
                        <option value="Visit now">Visit now</option>
                        <option value="Apply now">Apply now</option>
                    </select>
                </div>

                <!-- DESTINATION LINK -->
                <div class="form-group">
                    <label class="form-label">Destination Link <small>(Landing page / website URL)</small></label>
                    <input type="url" name="destination_link" id="inputDestinationLink" class="form-control" placeholder="https://example.com/shop" required oninput="updateLivePreview()">
                </div>

                <!-- TARGET PLACEMENT -->
                <div class="form-group">
                    <label class="form-label">Placement</label>
                    <select name="placement" class="form-control">
                        <option value="both" selected>Both (Feed & Reels)</option>
                        <option value="feed">Feed Only</option>
                        <option value="reels">Reels Only</option>
                    </select>
                </div>

                <!-- SUBMIT BUTTON -->
                <button type="button" id="btnPublishAd" class="btn-submit-ad" onclick="submitAdForm()">
                    <i class="fa-solid fa-paper-plane"></i>
                    <span>Publish Sponsored Ad</span>
                </button>
            </form>
        </div>

        <!-- FACEBOOK LIVE PREVIEW CARD -->
        <div class="fb-preview-title">
            <i class="fa-brands fa-facebook" style="color:#1877f2; font-size:14px;"></i>
            Live Sponsored Ad Preview
        </div>

        <div class="fb-ad-card-preview">
            <div class="fb-ad-header">
                @if(auth()->user()->profile_photo_url)
                    <img src="{{ auth()->user()->profile_photo_url }}" class="fb-ad-avatar" alt="Brand">
                @else
                    <div class="fb-ad-avatar" style="background:#1877f2; color:#fff; font-weight:700; display:flex; align-items:center; justify-content:center; font-size:16px;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <div class="fb-ad-brand-name">{{ auth()->user()->name }}</div>
                    <div class="fb-ad-subtext">
                        <span>Ad</span> • <i class="fa-solid fa-earth-americas" style="font-size:10px;"></i>
                    </div>
                </div>
            </div>

            <div class="fb-ad-body-text" id="prevPrimaryText">
                primary text preview will appear here...
            </div>

            <div style="border-radius: 12px; overflow: hidden; border: 1px solid #e4e6eb; background: #ffffff;">
                <div class="fb-ad-media-holder" id="prevMediaHolder" style="border-radius:0; margin-bottom:0;">
                    <div style="color:#64748b; font-size:13px; text-align:center; padding:20px;">
                        <i class="fa-regular fa-image" style="font-size:32px; display:block; margin-bottom:6px;"></i>
                        Media Preview Box
                    </div>
                </div>

                <div class="fb-ad-cta-bar" style="border-radius:0; border:none; border-top:1px solid #e4e6eb;">
                    <div style="flex:1; overflow:hidden;">
                        <div class="fb-ad-link-host" id="prevLinkHost">EXAMPLE.COM</div>
                        <div class="fb-ad-headline-text" id="prevHeadline">Short Headline preview</div>
                    </div>
                    <button type="button" class="fb-ad-cta-button" id="prevCtaBtn">Order now</button>
                </div>
            </div>
        </div>

        <!-- MY SPONSORED ADS LIST -->
        <div class="card-title-head" style="margin-top:24px; margin-bottom:12px;">
            <span>📋 My Sponsored Ads ({{ count($ads) }})</span>
        </div>

        <div id="myAdsListContainer">
            @forelse($ads as $ad)
                <div class="ad-item-card" id="ad-card-{{ $ad->id }}">
                    <div class="ad-item-top">
                        @if($ad->media_path)
                            @if($ad->media_type === 'video')
                                <video src="{{ asset('storage/' . $ad->media_path) }}" class="ad-item-thumb"></video>
                            @else
                                <img src="{{ asset('storage/' . $ad->media_path) }}" class="ad-item-thumb" alt="Ad Thumbnail">
                            @endif
                        @else
                            <div class="ad-item-thumb" style="background:#e2e8f0; display:flex; align-items:center; justify-content:center; color:#64748b;">
                                <i class="fa-solid fa-image"></i>
                            </div>
                        @endif
                        <div class="ad-item-info">
                            <div class="ad-item-headline">{{ $ad->headline }}</div>
                            <div class="ad-item-sub">{{ Str::limit($ad->primary_text, 50) }}</div>
                            <div style="font-size:11px; color:#1877f2; font-weight:700; margin-top:2px;">
                                CTA: {{ $ad->cta_text }} • {{ strtoupper($ad->placement) }}
                            </div>
                        </div>
                    </div>

                    <div class="ad-metrics-row">
                        <div class="ad-metric-item">
                            <i class="fa-regular fa-eye" style="color:#2563eb;"></i>
                            <span>{{ $ad->views_count }} Views</span>
                        </div>
                        <div class="ad-metric-item">
                            <i class="fa-solid fa-hand-pointer" style="color:#16a34a;"></i>
                            <span>{{ $ad->clicks_count }} Clicks</span>
                        </div>
                    </div>

                    <div class="ad-actions-row">
                        <button type="button" class="status-toggle-btn {{ $ad->is_active ? 'active' : 'inactive' }}" id="status-btn-{{ $ad->id }}" onclick="toggleAdStatus({{ $ad->id }})">
                            <i class="fa-solid {{ $ad->is_active ? 'fa-circle-check' : 'fa-circle-pause' }}"></i>
                            <span>{{ $ad->is_active ? 'Active' : 'Paused' }}</span>
                        </button>
                        <button type="button" class="btn-delete-ad" onclick="deleteAd({{ $ad->id }})" title="Delete Ad">
                            <i class="fa-solid fa-trash-can"></i> Delete
                        </button>
                    </div>
                </div>
            @empty
                <div class="white-card" style="text-align:center; padding:30px 10px; color:#94a3b8;">
                    <i class="fa-solid fa-rectangle-ad" style="font-size:36px; margin-bottom:8px; color:#cbd5e1;"></i>
                    <p style="font-size:14px; font-weight:600; color:#475569;">No sponsored ads created yet</p>
                    <p style="font-size:12px; color:#94a3b8; margin-top:4px;">Fill out the form above to launch your first Facebook Vibe ad!</p>
                </div>
            @endforelse
        </div>

    </div>

    <!-- EXISTING POSTS MODAL -->
    <div id="existingPostsModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.65); backdrop-filter: blur(4px); z-index: 2000; align-items: center; justify-content: center; padding: 16px;">
        <div style="background: #ffffff; border-radius: 20px; width: 100%; max-width: 520px; max-height: 85vh; display: flex; flex-direction: column; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.25);">
            <div style="padding: 16px 20px; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between; background: #f8fafc;">
                <div>
                    <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0;">📌 Select Existing Profile Post</h3>
                    <p style="font-size: 12px; color: #64748b; margin: 2px 0 0 0;">Choose a post from your profile to convert into a Sponsored Ad</p>
                </div>
                <button type="button" onclick="closeExistingPostsModal()" style="background: #e2e8f0; border: none; width: 32px; height: 32px; border-radius: 50%; cursor: pointer; font-weight: 700; color: #475569;">✕</button>
            </div>

            <div style="padding: 16px; overflow-y: auto; flex: 1;">
                @if(isset($userPosts) && $userPosts->count() > 0)
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        @foreach($userPosts as $p)
                            @php
                                $thumb = null;
                                if ($p->video) {
                                    $thumb = 'video';
                                } elseif (!empty($p->image_list)) {
                                    $thumb = asset('storage/' . $p->image_list[0]);
                                } elseif ($p->image) {
                                    $thumb = asset('storage/' . $p->image);
                                }
                            @endphp
                            <div onclick='selectPostFromList(@json($p))' style="border: 1px solid #e2e8f0; border-radius: 12px; padding: 12px; display: flex; align-items: center; gap: 12px; cursor: pointer; transition: all 0.2s; background: #ffffff;" onmouseover="this.style.borderColor='#1877f2'; this.style.background='#f0f7ff';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.background='#ffffff';">
                                @if($thumb === 'video')
                                    <div style="width: 54px; height: 54px; border-radius: 8px; background: #0f172a; color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
                                        <i class="fa-solid fa-film"></i>
                                    </div>
                                @elseif($thumb)
                                    <img src="{{ $thumb }}" style="width: 54px; height: 54px; border-radius: 8px; object-fit: cover; flex-shrink: 0; border: 1px solid #e2e8f0;">
                                @else
                                    <div style="width: 54px; height: 54px; border-radius: 8px; background: #f1f5f9; color: #64748b; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
                                        <i class="fa-solid fa-align-left"></i>
                                    </div>
                                @endif
                                <div style="flex: 1; overflow: hidden;">
                                    <div style="font-size: 14px; font-weight: 700; color: #0f172a; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        {{ $p->title ?: ($p->description ? Str::limit($p->description, 40) : 'Post #' . $p->id) }}
                                    </div>
                                    <div style="font-size: 12px; color: #64748b; margin-top: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        {{ $p->description ? Str::limit($p->description, 60) : 'No description' }}
                                    </div>
                                    <div style="font-size: 11px; color: #94a3b8; margin-top: 4px;">
                                        {{ $p->created_at ? $p->created_at->format('M d, Y') : '' }}
                                    </div>
                                </div>
                                <button type="button" style="background: #1877f2; color: #ffffff; border: none; border-radius: 8px; padding: 6px 14px; font-size: 12.5px; font-weight: 700; white-space: nowrap; pointer-events: none;">Select</button>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align: center; padding: 40px 10px; color: #94a3b8;">
                        <i class="fa-solid fa-folder-open" style="font-size: 40px; margin-bottom: 8px; color: #cbd5e1;"></i>
                        <p style="font-weight: 600; color: #475569;">No existing profile posts found</p>
                        <p style="font-size: 12px;">Create a normal post on your profile first, or switch to "Create New Ad".</p>
                    </div>
                @endif
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

        // AD MODE DROPDOWN HANDLERS
        function toggleAdModeDropdown(e) {
            e.stopPropagation();
            const menu = document.getElementById('adModeDropdownMenu');
            menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
        }

        document.addEventListener('click', function() {
            const menu = document.getElementById('adModeDropdownMenu');
            if (menu) menu.style.display = 'none';
        });

        function selectAdMode(mode) {
            const dropdownMenu = document.getElementById('adModeDropdownMenu');
            if (dropdownMenu) dropdownMenu.style.display = 'none';

            if (mode === 'use_existing') {
                document.getElementById('selectedModeText').innerText = '📌 Use Existing Post';
                openExistingPostsModal();
            } else {
                document.getElementById('selectedModeText').innerText = '➕ Create New Sponsored Ad';
                clearSelectedExistingPost();
            }
        }

        function openExistingPostsModal() {
            document.getElementById('existingPostsModal').style.display = 'flex';
        }

        function closeExistingPostsModal() {
            document.getElementById('existingPostsModal').style.display = 'none';
        }

        function selectPostFromList(post) {
            document.getElementById('inputExistingReportId').value = post.id;
            closeExistingPostsModal();

            const banner = document.getElementById('selectedPostBanner');
            banner.style.display = 'flex';
            document.getElementById('bannerPostTitle').innerText = post.title || post.description || ('Post #' + post.id);

            if (post.description) {
                document.getElementById('inputPrimaryText').value = post.description;
            }
            if (post.title) {
                document.getElementById('inputHeadline').value = post.title;
            } else if (post.description) {
                document.getElementById('inputHeadline').value = post.description.substring(0, 45);
            }

            document.getElementById('inputMediaFile').removeAttribute('required');
            document.getElementById('mediaUploadFormGroup').style.display = 'none';

            const prevHolder = document.getElementById('prevMediaHolder');
            if (post.video) {
                prevHolder.innerHTML = `<video controls src="/storage/${post.video}" style="width:100%; max-height:280px; object-fit:contain; display:block; margin:0; border-radius:0;"></video>`;
            } else if (post.image || (post.images && post.images.length > 0)) {
                const imgUrl = post.image || (Array.isArray(post.images) ? post.images[0] : post.image);
                prevHolder.innerHTML = `<img src="/storage/${imgUrl}" style="width:100%; max-height:280px; object-fit:cover; display:block; margin:0; border-radius:0;">`;
            }

            updateLivePreview();
        }

        function clearSelectedExistingPost() {
            document.getElementById('inputExistingReportId').value = '';
            document.getElementById('selectedPostBanner').style.display = 'none';
            document.getElementById('mediaUploadFormGroup').style.display = 'block';
            document.getElementById('inputMediaFile').setAttribute('required', 'required');
            document.getElementById('selectedModeText').innerText = '➕ Create New Sponsored Ad';
            document.getElementById('createAdForm').reset();
            document.getElementById('mediaPreviewContainer').style.display = 'none';
            document.getElementById('prevMediaHolder').innerHTML = `
                <div style="color:#64748b; font-size:13px; text-align:center; padding:20px;">
                    <i class="fa-regular fa-image" style="font-size:32px; display:block; margin-bottom:6px;"></i>
                    Media Preview Box
                </div>`;
            updateLivePreview();
        }

        // LIVE PREVIEW UPDATER
        function updateLivePreview() {
            const pText = document.getElementById('inputPrimaryText').value.trim() || 'primary text preview will appear here...';
            const headline = document.getElementById('inputHeadline').value.trim() || 'Short Headline preview';
            const cta = document.getElementById('selectCtaText').value;
            const destUrl = document.getElementById('inputDestinationLink').value.trim();

            document.getElementById('prevPrimaryText').innerText = pText;
            document.getElementById('prevHeadline').innerText = headline;
            document.getElementById('prevCtaBtn').innerText = cta;

            try {
                if (destUrl) {
                    const host = new URL(destUrl).hostname.toUpperCase();
                    document.getElementById('prevLinkHost').innerText = host;
                } else {
                    document.getElementById('prevLinkHost').innerText = 'EXAMPLE.COM';
                }
            } catch(e) {
                document.getElementById('prevLinkHost').innerText = 'EXAMPLE.COM';
            }
        }

        // MEDIA PREVIEW HANDLER
        function handleMediaPreview(e) {
            const file = e.target.files[0];
            const prevContainer = document.getElementById('mediaPreviewContainer');
            const imgEl = document.getElementById('imagePreview');
            const videoEl = document.getElementById('videoPreview');
            const prevHolder = document.getElementById('prevMediaHolder');

            if (!file) return;

            const url = URL.createObjectURL(file);
            prevContainer.style.display = 'block';

            if (file.type.startsWith('video/')) {
                imgEl.style.display = 'none';
                videoEl.style.display = 'block';
                videoEl.src = url;

                prevHolder.innerHTML = `<video controls src="${url}" style="width:100%; max-height:280px; object-fit:contain; display:block; margin:0; border-radius:0;"></video>`;
            } else {
                videoEl.style.display = 'none';
                imgEl.style.display = 'block';
                imgEl.src = url;

                prevHolder.innerHTML = `<img src="${url}" style="width:100%; max-height:280px; object-fit:cover; display:block; margin:0; border-radius:0;">`;
            }
        }

        // SUBMIT AD FORM VIA AJAX
        function submitAdForm() {
            const form = document.getElementById('createAdForm');
            const formData = new FormData(form);
            const btn = document.getElementById('btnPublishAd');
            const existingId = document.getElementById('inputExistingReportId').value;

            if (!formData.get('headline') || !formData.get('destination_link')) {
                showToast("Please fill in headline and destination link!");
                return;
            }

            if (!existingId && !formData.get('media')?.name) {
                showToast("Please upload a photo or video for your ad!");
                return;
            }

            btn.disabled = true;
            btn.style.opacity = '0.7';
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Publishing Ad...';

            fetch('/user/ads', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                btn.disabled = false;
                btn.style.opacity = '1';
                btn.innerHTML = '<i class="fa-solid fa-paper-plane"></i> Publish Sponsored Ad';

                if (data.status === 'success') {
                    showToast(data.message);
                    form.reset();
                    document.getElementById('mediaPreviewContainer').style.display = 'none';
                    updateLivePreview();
                    setTimeout(() => window.location.reload(), 1200);
                } else {
                    showToast(data.message || "Failed to create ad.");
                }
            })
            .catch(err => {
                btn.disabled = false;
                btn.style.opacity = '1';
                btn.innerHTML = '<i class="fa-solid fa-paper-plane"></i> Publish Sponsored Ad';
                showToast("Error creating ad. Please check file size and fields.");
            });
        }

        // TOGGLE AD ACTIVE STATUS
        function toggleAdStatus(adId) {
            fetch('/user/ads/' + adId + '/toggle', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    const btn = document.getElementById('status-btn-' + adId);
                    if (data.is_active) {
                        btn.className = 'status-toggle-btn active';
                        btn.innerHTML = '<i class="fa-solid fa-circle-check"></i> Active';
                    } else {
                        btn.className = 'status-toggle-btn inactive';
                        btn.innerHTML = '<i class="fa-solid fa-circle-pause"></i> Paused';
                    }
                    showToast(data.message);
                }
            })
            .catch(err => showToast("Error updating status"));
        }

        // DELETE AD
        function deleteAd(adId) {
            if (!confirm("Are you sure you want to delete this sponsored ad?")) return;

            fetch('/user/ads/' + adId, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    const card = document.getElementById('ad-card-' + adId);
                    if (card) card.remove();
                    showToast(data.message);
                }
            })
            .catch(err => showToast("Error deleting ad"));
        }

        // TOAST HELPER
        function showToast(msg) {
            const toast = document.getElementById('toastMessage');
            document.getElementById('toastText').innerText = msg;
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 3500);
        }
    </script>
</body>
</html>
