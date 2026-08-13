<style>
    .post-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 14px;
        margin-bottom: 14px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        border: 1px solid #f1f5f9;
    }

    .post-author-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .author-left {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .author-avatar-img {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        object-fit: cover;
        flex-shrink: 0;
    }

    .author-avatar-initial {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0284c7, #2563eb);
        color: #ffffff;
        font-weight: 700;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    /* FACEBOOK MULTI-IMAGE GALLERY STYLES */
    .fb-gallery-grid {
        display: grid;
        gap: 4px;
        margin-top: 10px;
        border-radius: 12px;
        overflow: hidden;
        background: #0f172a;
    }
    .fb-gallery-grid.grid-2 {
        grid-template-columns: 1fr 1fr;
        height: 220px;
    }
    .fb-gallery-grid.grid-3 {
        grid-template-columns: 1fr 1fr;
        grid-template-rows: 130px 100px;
        height: 234px;
    }
    .fb-gallery-grid.grid-3 .gallery-item:first-child {
        grid-column: span 2;
    }
    .fb-gallery-grid.grid-4, .fb-gallery-grid.grid-more {
        grid-template-columns: 1fr 1fr;
        grid-template-rows: 130px 130px;
        height: 264px;
    }
    .gallery-item {
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
        cursor: pointer;
    }
    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.2s ease;
    }
    .gallery-item:hover img {
        transform: scale(1.02);
    }
    .gallery-more-overlay {
        position: absolute;
        inset: 0;
        background: rgba(15, 23, 42, 0.65);
        color: #ffffff;
        font-size: 26px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(2px);
    }

    .author-meta {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .author-name-wrap {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .author-name {
        font-weight: 700;
        font-size: 14px;
        color: #0f172a;
        line-height: 1.2;
    }

    .follow-badge-btn {
        background: #ff4757;
        color: #ffffff;
        border: none;
        border-radius: 12px;
        padding: 2px 10px;
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.15s ease, background 0.2s ease;
    }

    .follow-badge-btn:hover {
        background: #ff6b81;
        transform: scale(1.04);
    }

    .follow-badge-btn.following {
        background: #e2e8f0;
        color: #334155;
    }

    .follow-badge-btn.following:hover {
        background: #cbd5e1;
        color: #0f172a;
    }

    .author-sub {
        font-size: 12px;
        color: #64748b;
    }

    .more-options-btn {
        background: none;
        border: none;
        color: #94a3b8;
        font-size: 16px;
        cursor: pointer;
        padding: 4px 8px;
        border-radius: 50%;
        transition: color 0.2s;
    }

    .more-options-btn:hover {
        color: #0f172a;
        background: #f1f5f9;
    }

    .post-content-title {
        font-size: 15px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 6px;
        line-height: 1.4;
    }

    .post-content-desc {
        font-size: 14px;
        color: #334155;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .post-content-desc.expanded {
        display: block;
        -webkit-line-clamp: unset;
    }

    .see-more-toggle {
        background: none;
        border: none;
        color: #ff4757;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        padding: 0;
        margin-top: 4px;
    }

    .post-media-container {
        margin-top: 10px;
        border-radius: 12px;
        overflow: hidden;
    }

    .post-media-img {
        width: 100%;
        max-height: 420px;
        object-fit: cover;
        border-radius: 12px;
        cursor: pointer;
        display: block;
        transition: transform 0.2s ease;
    }

    .post-media-img:hover {
        transform: scale(1.01);
    }

    .post-tags-row {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: 10px;
    }

    .post-tag-pill {
        background: #f1f5f9;
        color: #475569;
        padding: 4px 10px;
        border-radius: 16px;
        font-size: 12px;
        font-weight: 500;
    }

    .post-actions-bar {
        display: flex;
        justify-content: space-around;
        align-items: center;
        margin-top: 12px;
        padding-top: 10px;
        border-top: 1px solid #f1f5f9;
    }

    .action-button {
        background: none;
        border: none;
        color: #64748b;
        font-size: 13px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 5px;
        cursor: pointer;
        padding: 6px 10px;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .action-button:hover {
        background: #f8fafc;
        color: #ff4757;
    }

    .action-button.loved {
        color: #e11d48;
    }

    .action-button.loved i {
        color: #e11d48;
    }

    .action-button.star-btn {
        color: #d97706;
    }

    .action-button.star-btn:hover {
        background: #fef3c7;
        color: #b45309;
    }

    /* COMMENTS SECTION & NESTED REPLIES */
    .comments-drawer {
        margin-top: 12px;
        padding-top: 12px;
        border-top: 1px dashed #e2e8f0;
    }

    .comments-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-bottom: 12px;
    }

    .comment-item {
        display: flex;
        gap: 10px;
        align-items: flex-start;
    }

    .comment-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #0284c7;
        color: #ffffff;
        font-weight: 700;
        font-size: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .comment-body-wrap {
        flex: 1;
    }

    .comment-bubble {
        background: #f1f5f9;
        border-radius: 14px;
        padding: 8px 12px;
        display: inline-block;
        max-width: 100%;
    }

    .comment-author-name {
        font-size: 12px;
        font-weight: 700;
        color: #0f172a;
    }

    .comment-text {
        font-size: 13px;
        color: #334155;
        margin-top: 2px;
        line-height: 1.35;
    }

    .comment-meta-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 3px;
        margin-left: 6px;
    }

    .comment-time {
        font-size: 11px;
        color: #94a3b8;
    }

    .comment-reply-btn {
        background: none;
        border: none;
        color: #2563eb;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        padding: 0;
    }

    .comment-reply-btn:hover {
        text-decoration: underline;
    }

    /* NESTED REPLIES LIST */
    .replies-list {
        margin-top: 8px;
        padding-left: 12px;
        border-left: 2px solid #e2e8f0;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .reply-item .comment-avatar {
        width: 28px;
        height: 28px;
        font-size: 11px;
        background: #3b82f6;
    }

    .reply-item .comment-bubble {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
    }

    .comment-input-row {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .comment-field {
        flex: 1;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 8px 14px;
        font-size: 13px;
        outline: none;
    }

    .comment-field:focus {
        border-color: #cbd5e1;
        background: #ffffff;
    }

    .comment-submit-btn {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #ff4757;
        color: #ffffff;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 13px;
        flex-shrink: 0;
    }

    /* STAR SENDER MODAL STYLES */
    .star-modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.75);
        backdrop-filter: blur(4px);
        z-index: 10001;
        align-items: center;
        justify-content: center;
        padding: 16px;
    }

    .star-modal-overlay.active {
        display: flex;
    }

    .star-modal-card {
        background: #ffffff;
        color: #0f172a;
        width: 100%;
        max-width: 420px;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        overflow: hidden;
        animation: starPop 0.2s ease-out;
    }

    @keyframes starPop {
        from { transform: scale(0.9); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    .star-modal-header {
        position: relative;
        padding: 14px 16px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .star-modal-header h4 {
        font-size: 16px;
        font-weight: 700;
        color: #0f172a;
    }

    .star-close-btn {
        background: #f1f5f9;
        border: none;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        color: #64748b;
        font-size: 18px;
        cursor: pointer;
    }

    .star-modal-body {
        padding: 16px;
    }

    .star-balance-text {
        font-size: 13px;
        color: #475569;
        margin-bottom: 12px;
        background: #fffbeb;
        border: 1px solid #fef3c7;
        padding: 8px 12px;
        border-radius: 8px;
    }

    .star-preset-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 8px;
        margin-bottom: 14px;
    }

    .star-preset-btn {
        background: #f8fafc;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        padding: 10px 4px;
        font-size: 13px;
        font-weight: 700;
        color: #d97706;
        cursor: pointer;
        transition: all 0.15s;
    }

    .star-preset-btn:hover, .star-preset-btn.selected {
        background: #fef3c7;
        border-color: #d97706;
        transform: scale(1.03);
    }

    .star-input-field {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        font-size: 13px;
        outline: none;
        box-sizing: border-box;
    }

    .confirm-stars-btn {
        width: 100%;
        padding: 12px;
        border-radius: 10px;
        border: none;
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: #ffffff;
        font-weight: 700;
        font-size: 15px;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(217, 119, 6, 0.3);
        transition: transform 0.2s;
    }

    /* DROPDOWN & MODAL EXTRA STYLES */
    .dropdown-item-btn {
        width: 100%;
        text-align: left;
        background: none;
        border: none;
        padding: 10px 16px;
        font-size: 13.5px;
        font-weight: 600;
        color: #334155;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: background 0.15s;
    }
    .dropdown-item-btn:hover {
        background: #f8fafc;
        color: #0f172a;
    }
    .dropdown-item-btn.delete-item:hover {
        background: #fef2f2;
        color: #dc2626;
    }

    /* INSIGHTS & EDIT MODAL STYLES */
    .insights-modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.65);
        backdrop-filter: blur(4px);
        z-index: 10002;
        align-items: center;
        justify-content: center;
        padding: 16px;
    }
    .insights-modal-overlay.active {
        display: flex;
    }
    .insights-modal-card {
        background: #ffffff;
        color: #0f172a;
        width: 100%;
        max-width: 440px;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        max-height: 90vh;
        overflow-y: auto;
    }
    .insights-metric-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        margin: 16px 0;
    }
    .insights-metric-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 14px;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .insights-metric-val {
        font-size: 22px;
        font-weight: 800;
        color: #0f172a;
    }
    .insights-metric-lbl {
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
    }
    .country-bar-row {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-top: 10px;
    }
    .country-bar-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        font-weight: 600;
    }
    .country-bar-track {
        flex: 1;
        height: 8px;
        background: #e2e8f0;
        border-radius: 4px;
        overflow: hidden;
    }
    .country-bar-fill {
        height: 100%;
        background: #2563eb;
        border-radius: 4px;
    }
</style>

@if($reports->isEmpty())
    <div style="background: #ffffff; border-radius: 16px; padding: 40px 20px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.04); border: 1px solid #f1f5f9; margin-bottom: 14px;">
        <div style="width: 64px; height: 64px; border-radius: 50%; background: #fef2f2; color: #ef4444; display: inline-flex; align-items: center; justify-content: center; font-size: 28px; margin-bottom: 14px;">
            <i class="fa-solid fa-clapperboard"></i>
        </div>
        @if($isReels ?? false)
            <h4 style="font-size: 18px; font-weight: 700; color: #0f172a; margin-bottom: 6px;">কোন রিলস বা ভিডিও পোস্ট পাওয়া যায়নি</h4>
            <p style="font-size: 13px; color: #64748b; margin-bottom: 18px;">প্রথম রিলস/ভিডিও পোস্টটি আপনিই তৈরি করুন!</p>
        @else
            <h4 style="font-size: 18px; font-weight: 700; color: #0f172a; margin-bottom: 6px;">কোন পোস্ট পাওয়া যায়নি</h4>
            <p style="font-size: 13px; color: #64748b; margin-bottom: 18px;">নতুন পোস্ট তৈরি করে কমিউনিটির সাথে যুক্ত থাকুন।</p>
        @endif
        <button type="button" onclick="openCreatePostModal()" style="background: linear-gradient(135deg, #0284c7, #2563eb); color: #ffffff; border: none; border-radius: 20px; padding: 10px 22px; font-size: 14px; font-weight: 700; cursor: pointer; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);">
            <i class="fa-solid fa-plus" style="margin-right: 6px;"></i> Create Post
        </button>
    </div>
@endif

@foreach($reports as $report)
@php
    $reactionsCount = $report->reactions ? $report->reactions->count() : 0;
    $isLoved = false;
    if (auth()->check() && $report->reactions) {
        $isLoved = $report->reactions->where('user_id', auth()->id())->first() !== null;
    }
    $commentsCount = $report->comments ? $report->comments->count() : 0;
    $authorName = $report->user->name ?? 'MD Abdullah Rana';
    $authorHandle = '@' . Str::slug($authorName, '_');
    $authorUserId = $report->user_id ?: 1;
    $isFollowingAuthor = false;
    if (auth()->check()) {
        $isFollowingAuthor = auth()->user()->isFollowing($authorUserId);
    }
    $isSelf = auth()->check() && auth()->id() == $authorUserId;
@endphp

@if($isReels ?? false)
    <!-- FACEBOOK STYLE REEL CARD -->
    <div class="post-card reel-card" id="post-card-{{ $report->id }}" style="background: #0f172a; border-radius: 20px; overflow: hidden; margin-bottom: 20px; box-shadow: 0 8px 24px rgba(0,0,0,0.3); border: 1px solid #1e293b; padding: 0;">
        <!-- REEL VIDEO PLAYER -->
        <div class="reel-video-wrapper" style="position: relative; width: 100%; background: #000000; display: flex; align-items: center; justify-content: center; min-height: 320px; max-height: 560px;">
            @if($report->video)
                <video controls playsinline loop preload="metadata" src="{{ asset('storage/' . $report->video) }}" style="width: 100%; max-height: 540px; object-fit: contain; background: #000; display: block;"></video>
            @elseif($report->video_url)
                @php
                    preg_match('/(?:youtube\.com.*(?:\\?|&)v=|youtu\.be\\/)([^&\\n?#]+)/', $report->video_url, $matches);
                    $videoId = $matches[1] ?? null;
                @endphp
                @if($videoId)
                    <iframe width="100%" height="340"
                        src="https://www.youtube.com/embed/{{ $videoId }}?autoplay=0&rel=0"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                        style="width: 100%; min-height: 340px; border: none; display: block;">
                    </iframe>
                @endif
            @endif
        </div>

        <!-- REEL METADATA & ACTIONS -->
        <div class="reel-overlay-info" style="padding: 16px; background: #0f172a; color: #ffffff;">
            <!-- Author Row -->
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;">
                <a href="/user/profile/{{ $authorUserId }}" style="display: flex; align-items: center; gap: 10px; text-decoration: none;">
                    @if($report->user && $report->user->profile_photo_url)
                        <img src="{{ $report->user->profile_photo_url }}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid #2563eb;">
                    @else
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #0284c7, #2563eb); color: #fff; font-weight: 700; display: flex; align-items: center; justify-content: center;">
                            {{ strtoupper(substr($authorName, 0, 1)) }}
                        </div>
                    @endif
                    <div>
                        <div style="color: #ffffff; font-weight: 700; font-size: 14px; display: flex; align-items: center; gap: 6px;">
                            {{ $authorName }}
                        </div>
                        <span style="font-size: 11px; color: #94a3b8;">{{ $report->created_at ? $report->created_at->diffForHumans() : 'Just now' }}</span>
                    </div>
                </a>

                @if(!$isSelf)
                    <button type="button" class="follow-badge-btn {{ $isFollowingAuthor ? 'following' : '' }}" onclick="toggleFollowUser({{ $authorUserId }}, this, {{ $report->id }}); event.preventDefault(); event.stopPropagation();" style="border-radius: 20px; padding: 4px 14px; font-size: 12px;">
                        {{ $isFollowingAuthor ? '✓ Following' : '+ Follow' }}
                    </button>
                @endif
            </div>

            <!-- Reel Caption / Title -->
            @if($report->description)
                <p style="font-size: 14px; color: #e2e8f0; margin: 0 0 10px 0; line-height: 1.4;">
                    {{ $report->description }}
                </p>
            @elseif($report->title && !($report->destination_link || $report->sponsored_ad_id))
                <p style="font-size: 14px; font-weight: 700; color: #ffffff; margin: 0 0 10px 0;">
                    {{ $report->title }}
                </p>
            @endif

            @if($report->destination_link)
                <div style="background: #1e293b; border: 1px solid #334155; border-radius: 10px; padding: 10px 14px; display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 10px;">
                    <div style="flex: 1; overflow: hidden;">
                        <div style="font-size: 11px; text-transform: uppercase; color: #94a3b8; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ parse_url($report->destination_link, PHP_URL_HOST) ?: 'SPONSORED' }}
                        </div>
                        <div style="font-size: 14px; font-weight: 700; color: #ffffff; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.3; margin-top: 2px; word-break: break-word;">
                            {{ $report->title ?: 'Sponsored Ad' }}
                        </div>
                    </div>
                    <a href="{{ $report->destination_link }}" target="_blank" onclick="trackAdClick({{ $report->sponsored_ad_id ?? 0 }})" style="background: #e4e6eb; color: #050505; border-radius: 6px; padding: 8px 16px; font-size: 13.5px; font-weight: 700; text-decoration: none; display: inline-block; white-space: nowrap;">
                        {{ $report->cta_text ?: 'Order now' }}
                    </a>
                </div>
            @endif

            <!-- Reel Actions Bar -->
            <div style="display: flex; align-items: center; justify-content: space-around; padding-top: 10px; border-top: 1px solid rgba(255,255,255,0.1); margin-top: 6px;">
                <button class="action-button love-btn {{ $isLoved ? 'loved' : '' }}" id="react-btn-{{ $report->id }}" onclick="toggleLove({{ $report->id }})" title="Love" style="color: {{ $isLoved ? '#ff4757' : '#ffffff' }};">
                    <i class="{{ $isLoved ? 'fa-solid' : 'fa-regular' }} fa-heart" id="react-icon-{{ $report->id }}"></i>
                    <span id="react-count-{{ $report->id }}">{{ $reactionsCount }}</span>
                </button>

                <button class="action-button" onclick="toggleComments({{ $report->id }})" title="Comment" style="color: #ffffff;">
                    <i class="fa-regular fa-comment"></i>
                    <span id="comment-count-{{ $report->id }}">{{ $commentsCount }}</span>
                </button>

                <button class="action-button star-btn" onclick="openStarModal({{ $report->id }}, '{{ addslashes($authorName) }}', {{ $report->user_id ?? 0 }})" title="Send Stars" style="color: #f59e0b;">
                    ⭐ <span id="star-count-{{ $report->id }}">{{ $report->star_transactions_count ?? 0 }}</span>
                </button>

                <div class="action-button view-btn" title="Unique Views" style="cursor:default; color:#94a3b8;">
                    <i class="fa-regular fa-eye"></i>
                    <span>{{ $report->views_count ?? 0 }}</span>
                </div>

                <button class="action-button" onclick="sharePost({{ $report->id }})" title="Share" style="color: #ffffff;">
                    <i class="fa-regular fa-paper-plane"></i>
                </button>
            </div>

            <!-- COMMENTS DRAWER FOR REEL -->
            <div class="comments-drawer" id="comments-drawer-{{ $report->id }}" style="display: none; background: #1e293b; border-radius: 12px; padding: 12px; margin-top: 10px;">
                <div class="comments-list" id="comments-list-{{ $report->id }}">
                    @if($report->comments && $report->comments->count() > 0)
                        @foreach($report->comments as $c)
                            @php
                                $commentUserId = $c->user_id ?: 1;
                                $isCommentAuthorFollowing = false;
                                if (auth()->check()) {
                                    $isCommentAuthorFollowing = auth()->user()->isFollowing($commentUserId);
                                }
                                $isCommentSelf = auth()->check() && auth()->id() == $commentUserId;
                            @endphp
                            <div class="comment-item" id="comment-row-{{ $c->id }}" style="margin-bottom: 8px;">
                                <div class="comment-avatar">
                                    {{ strtoupper(substr($c->user->name ?? 'U', 0, 1)) }}
                                </div>
                                <div class="comment-bubble" style="background: #334155; color: #fff;">
                                    <div class="comment-author-name" style="color: #38bdf8;">{{ $c->user->name ?? 'User' }}</div>
                                    <div class="comment-text" style="color: #f8fafc;">{{ $c->comment }}</div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="comment-input-row" style="margin-top: 8px;">
                    <input type="text" class="comment-field" id="comment-input-{{ $report->id }}" placeholder="Write a comment..." onkeydown="if(event.key==='Enter') submitComment({{ $report->id }})" style="background: #334155; color: #fff; border: 1px solid #475569;">
                    <button class="comment-submit-btn" onclick="submitComment({{ $report->id }})" title="Post comment">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@else
<div class="post-card" id="post-card-{{ $report->id }}">

    <!-- AUTHOR HEADER -->
    <div class="post-author-row">
        <a href="/user/profile/{{ $authorUserId }}" class="author-left" style="text-decoration:none;">
            @if($report->user && $report->user->profile_photo_url)
                <img src="{{ $report->user->profile_photo_url }}" alt="{{ $authorName }}" class="author-avatar-img">
            @else
                <div class="author-avatar-initial">
                    {{ strtoupper(substr($authorName, 0, 1)) }}
                </div>
            @endif
            <div class="author-meta">
                <div class="author-name-wrap" style="display: flex; align-items: center; gap: 8px;">
                    <span class="author-name">
                        {{ $authorName }}
                    </span>
                    @if(!$isSelf)
                        <button type="button" class="follow-badge-btn {{ $isFollowingAuthor ? 'following' : '' }}" onclick="toggleFollowUser({{ $authorUserId }}, this, {{ $report->id }}); event.preventDefault(); event.stopPropagation();">
                            {{ $isFollowingAuthor ? '✓ Following' : '+ Follow' }}
                        </button>
                    @endif
                </div>
                <div class="author-sub">
                    @if($report->destination_link || $report->sponsored_ad_id)
                        <span style="font-weight:700; color:#1877f2;">Sponsored</span> · <i class="fa-solid fa-earth-americas" style="font-size:10px;"></i> · {{ $report->created_at ? $report->created_at->diffForHumans() : 'Just now' }}
                    @else
                        {{ $authorHandle }} · {{ $report->created_at ? $report->created_at->diffForHumans() : '25 min ago' }}
                    @endif
                </div>
            </div>
        </a>
        <div class="post-dropdown-wrap" style="position: relative;">
            <button type="button" class="more-options-btn" onclick="togglePostDropdown({{ $report->id }}, event)" title="Post Options">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </button>
            <div id="postDropdown-{{ $report->id }}" class="post-dropdown-menu" style="display:none; position:absolute; right:0; top:30px; background:#ffffff; border:1px solid #e2e8f0; border-radius:14px; box-shadow:0 10px 25px rgba(0,0,0,0.12); width:180px; z-index:100; padding:6px 0; overflow:hidden;">
                @if($isSelf || (auth()->check() && auth()->user()->isAdmin()))
                    <button type="button" class="dropdown-item-btn" onclick="openEditPostModal({{ $report->id }}, '{{ addslashes($report->description) }}', '{{ addslashes($report->location) }}')">
                        <i class="fa-solid fa-pen-to-square" style="color:#2563eb;"></i> Edit Post
                    </button>
                    <button type="button" class="dropdown-item-btn" onclick="openPostInsightsModal({{ $report->id }})">
                        <i class="fa-solid fa-chart-line" style="color:#16a34a;"></i> View Insights 📊
                    </button>
                    <button type="button" class="dropdown-item-btn delete-item" onclick="confirmDeletePost({{ $report->id }})">
                        <i class="fa-solid fa-trash-can" style="color:#dc2626;"></i> Delete Post
                    </button>
                @else
                    <button type="button" class="dropdown-item-btn" onclick="sharePost({{ $report->id }})">
                        <i class="fa-solid fa-share-nodes" style="color:#2563eb;"></i> Share Post
                    </button>
                    <button type="button" class="dropdown-item-btn" onclick="showToast('Post link copied!')">
                        <i class="fa-solid fa-link" style="color:#64748b;"></i> Copy Link
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- TITLE (Render ONLY if distinct from description and not a sponsored ad) -->
    @if(!empty($report->title) && trim($report->title) !== trim($report->description ?? '') && !($report->destination_link || $report->sponsored_ad_id))
        <div class="post-content-title" onclick="openFbPostViewer({{ $report->id }})" style="cursor:pointer; font-weight: 700; font-size: 15px; margin-bottom: 6px; color: #0f172a;">
            {{ $report->title }}
        </div>
    @endif

    <!-- DESCRIPTION -->
    @if($report->description)
        <div class="post-content-desc" id="desc-{{ $report->id }}">
            {{ $report->description }}
        </div>
        <button class="see-more-toggle" onclick="toggleDesc({{ $report->id }}, this)">
            See More
        </button>
    @endif

    <!-- MEDIA & SPONSORED AD CONTENT -->
    @if($report->destination_link)
        <!-- UNIFIED FACEBOOK SPONSORED AD CARD (ZERO GAP BETWEEN MEDIA & CTA BAR, CLICKABLE ANYWHERE) -->
        <div class="fb-sponsored-unified-box" style="margin-top: 10px; border-radius: 12px; overflow: hidden; border: 1px solid #e4e6eb; background: #ffffff;">
            <a href="{{ $report->destination_link }}" target="_blank" onclick="trackAdClick({{ $report->sponsored_ad_id ?? 0 }})" style="text-decoration: none; color: inherit; display: block;">
                <!-- MEDIA IMAGE OR VIDEO -->
                @if(!empty($report->image_list) && count($report->image_list) > 0)
                    <img src="{{ asset('storage/' . $report->image_list[0]) }}" alt="{{ $report->title }}" style="width: 100%; max-height: 440px; object-fit: cover; display: block; margin: 0; border: none; border-radius: 0;">
                @elseif($report->video)
                    <div style="position: relative; width: 100%; background: #000;">
                        <video playsinline controls src="{{ asset('storage/' . $report->video) }}" style="width: 100%; max-height: 440px; object-fit: contain; display: block; margin: 0;"></video>
                    </div>
                @elseif($report->video_url)
                    @php
                        preg_match('/(?:youtube\.com.*(?:\\?|&)v=|youtu\.be\\/)([^&\\n?#]+)/', $report->video_url, $matches);
                        $videoId = $matches[1] ?? null;
                    @endphp
                    @if($videoId)
                        <iframe width="100%" height="260" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allowfullscreen style="border: none; display: block; margin: 0; width: 100%;"></iframe>
                    @endif
                @endif

                <!-- SEAMLESS CTA BANNER BAR (JOINED WITH 0px GAP) -->
                <div style="background: #f0f2f5; padding: 12px 14px; display: flex; align-items: center; justify-content: space-between; gap: 12px; border-top: 1px solid #e4e6eb;">
                    <div style="flex: 1; overflow: hidden;">
                        <div style="font-size: 11px; text-transform: uppercase; color: #65676b; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ parse_url($report->destination_link, PHP_URL_HOST) ?: 'SPONSORED' }}
                        </div>
                        <div style="font-size: 14.5px; font-weight: 700; color: #050505; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.3; margin-top: 2px; word-break: break-word;">
                            {{ $report->title ?: 'Special Offer' }}
                        </div>
                    </div>
                    <div style="background: #e4e6eb; color: #050505; border-radius: 6px; padding: 8px 16px; font-size: 13.5px; font-weight: 700; white-space: nowrap; border: none; display: inline-block; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        {{ $report->cta_text ?: 'Order now' }}
                    </div>
                </div>
            </a>
        </div>
    @else
        <!-- FACEBOOK MULTI-IMAGE GALLERY -->
        @php
            $imageList = $report->image_list;
            $imgCount = count($imageList);
        @endphp

        @if($imgCount > 0)
            @if($imgCount == 1)
                <div class="post-media-container" style="margin-top: 10px;">
                    <img class="post-media-img"
                         src="{{ asset('storage/' . $imageList[0]) }}"
                         alt="Post image"
                         onclick="openFbPostViewer({{ $report->id }})">
                </div>
            @else
                @php
                    $gridClass = $imgCount == 2 ? 'grid-2' : ($imgCount == 3 ? 'grid-3' : ($imgCount == 4 ? 'grid-4' : 'grid-more'));
                    $displayImages = array_slice($imageList, 0, 4);
                    $remainingCount = $imgCount - 4;
                @endphp
                <div class="fb-gallery-grid {{ $gridClass }}">
                    @foreach($displayImages as $idx => $imgFile)
                        <div class="gallery-item" onclick="openFbPostViewer({{ $report->id }})">
                            <img src="{{ asset('storage/' . $imgFile) }}" alt="Post image {{ $idx + 1 }}">
                            @if($idx === 3 && $remainingCount > 0)
                                <div class="gallery-more-overlay">+{{ $remainingCount }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        @endif

        <!-- VIDEO MEDIA -->
        @if($report->video)
            <div class="post-media-container" style="margin-top: 10px;">
                <video controls src="{{ asset('storage/' . $report->video) }}" style="width:100%; max-height:360px; border-radius:12px; background:#000; display:block;"></video>
            </div>
        @elseif($report->video_url)
            @php
                preg_match('/(?:youtube\.com.*(?:\\?|&)v=|youtu\.be\\/)([^&\\n?#]+)/', $report->video_url, $matches);
                $videoId = $matches[1] ?? null;
            @endphp

            @if($videoId)
                <div class="post-media-container" style="margin-top: 10px;">
                    <iframe width="100%" height="260"
                        src="https://www.youtube.com/embed/{{ $videoId }}"
                        frameborder="0"
                        allowfullscreen
                        style="border-radius:12px; border:none; display:block;">
                    </iframe>
                </div>
            @endif
        @endif

        <!-- LOCATION & CATEGORY BADGES -->
        <div class="post-tags-row">
            @if($report->location)
                <span class="post-tag-pill">📍 {{ $report->location }}</span>
            @endif
            @if($report->category)
                <span class="post-tag-pill">🏷 {{ $report->category }}</span>
            @endif
        </div>
    @endif

    <!-- INTERACTION BUTTONS (LOVE REACT, COMMENT, STARS, UNIQUE VIEWS, SHARE) -->
    <div class="post-actions-bar">
        <button class="action-button love-btn {{ $isLoved ? 'loved' : '' }}" id="react-btn-{{ $report->id }}" onclick="toggleLove({{ $report->id }})" title="Love">
            <i class="{{ $isLoved ? 'fa-solid' : 'fa-regular' }} fa-heart" id="react-icon-{{ $report->id }}"></i>
            <span id="react-count-{{ $report->id }}">{{ $reactionsCount }}</span>
        </button>
        <button class="action-button" onclick="toggleComments({{ $report->id }})" title="Comment">
            <i class="fa-regular fa-comment"></i>
            <span id="comment-count-{{ $report->id }}">{{ $commentsCount }}</span>
        </button>
        <button class="action-button star-btn" onclick="openStarModal({{ $report->id }}, '{{ addslashes($authorName) }}', {{ $report->user_id ?? 0 }})" title="Send Stars">
            ⭐ <span id="star-count-{{ $report->id }}">{{ $report->star_transactions_count ?? 0 }}</span>
        </button>
        <div class="action-button view-btn" title="Unique Views" style="cursor:default; color:#64748b;">
            <i class="fa-regular fa-eye"></i>
            <span>{{ $report->views_count ?? 0 }}</span>
        </div>
        <button class="action-button" onclick="sharePost({{ $report->id }})" title="Share">
            <i class="fa-regular fa-paper-plane"></i>
        </button>
    </div>

    <!-- DYNAMIC COMMENTS DRAWER & NESTED REPLIES -->
    <div class="comments-drawer" id="comments-drawer-{{ $report->id }}" style="display: none;">
        <div class="comments-list" id="comments-list-{{ $report->id }}">
            @if($report->comments && $report->comments->count() > 0)
                @foreach($report->comments as $c)
                    @php
                        $commentUserId = $c->user_id ?: 1;
                        $isCommentAuthorFollowing = false;
                        if (auth()->check()) {
                            $isCommentAuthorFollowing = auth()->user()->isFollowing($commentUserId);
                        }
                        $isCommentSelf = auth()->check() && auth()->id() == $commentUserId;
                    @endphp
                    <div class="comment-item" id="comment-item-{{ $c->id }}">
                        @if($c->user && $c->user->profile_photo_url)
                            <img src="{{ $c->user->profile_photo_url }}" class="comment-avatar" style="object-fit:cover;" alt="{{ $c->user->name }}">
                        @else
                            <div class="comment-avatar">
                                {{ strtoupper(substr($c->user->name ?? 'U', 0, 1)) }}
                            </div>
                        @endif
                        <div class="comment-body-wrap">
                            <div class="comment-bubble">
                                <div class="comment-author-name-wrap" style="display: flex; align-items: center; gap: 6px;">
                                    <span class="comment-author-name">{{ $c->user->name ?? 'User' }}</span>
                                    @if(!$isCommentSelf)
                                        <button type="button" class="follow-badge-btn {{ $isCommentAuthorFollowing ? 'following' : '' }}" style="font-size:10px; padding:1px 6px;" onclick="toggleFollowUser({{ $commentUserId }}, this); event.preventDefault(); event.stopPropagation();">
                                            {{ $isCommentAuthorFollowing ? '✓ Following' : '+ Follow' }}
                                        </button>
                                    @endif
                                </div>
                                <div class="comment-text">{{ $c->comment }}</div>
                            </div>
                            <div class="comment-meta-actions">
                                <span class="comment-time">{{ $c->created_at ? $c->created_at->diffForHumans() : 'Just now' }}</span>
                                <button type="button" class="comment-reply-btn" onclick="toggleReplyInput({{ $c->id }})">Reply</button>
                            </div>

                            <!-- NESTED REPLIES LIST -->
                            <div class="replies-list" id="replies-list-{{ $c->id }}">
                                @if($c->replies && $c->replies->count() > 0)
                                    @foreach($c->replies as $reply)
                                        @php
                                            $replyUserId = $reply->user_id ?: 1;
                                            $isReplyAuthorFollowing = false;
                                            if (auth()->check()) {
                                                $isReplyAuthorFollowing = auth()->user()->isFollowing($replyUserId);
                                            }
                                            $isReplySelf = auth()->check() && auth()->id() == $replyUserId;
                                        @endphp
                                        <div class="comment-item reply-item">
                                            @if($reply->user && $reply->user->profile_photo_url)
                                                <img src="{{ $reply->user->profile_photo_url }}" class="comment-avatar" style="object-fit:cover;" alt="{{ $reply->user->name }}">
                                            @else
                                                <div class="comment-avatar">
                                                    {{ strtoupper(substr($reply->user->name ?? 'U', 0, 1)) }}
                                                </div>
                                            @endif
                                            <div class="comment-bubble">
                                                <div class="comment-author-name-wrap" style="display: flex; align-items: center; gap: 6px;">
                                                    <span class="comment-author-name">{{ $reply->user->name ?? 'User' }}</span>
                                                    @if(!$isReplySelf)
                                                        <button type="button" class="follow-badge-btn {{ $isReplyAuthorFollowing ? 'following' : '' }}" style="font-size:10px; padding:1px 6px;" onclick="toggleFollowUser({{ $replyUserId }}, this); event.preventDefault(); event.stopPropagation();">
                                                            {{ $isReplyAuthorFollowing ? '✓ Following' : '+ Follow' }}
                                                        </button>
                                                    @endif
                                                </div>
                                                <div class="comment-text">{{ $reply->comment }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <!-- REPLY INPUT ROW -->
                            <div class="reply-input-row" id="reply-input-row-{{ $c->id }}" style="display: none; margin-top: 6px;">
                                <div class="comment-input-row">
                                    <input type="text" class="comment-field" id="reply-input-{{ $c->id }}" placeholder="Write a reply..." onkeydown="if(event.key==='Enter') submitComment({{ $report->id }}, {{ $c->id }})">
                                    <button class="comment-submit-btn" onclick="submitComment({{ $report->id }}, {{ $c->id }})" title="Post reply">
                                        <i class="fa-solid fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="comment-input-row">
            <input type="text" class="comment-field" id="comment-input-{{ $report->id }}" placeholder="Write a comment..." onkeydown="if(event.key==='Enter') submitComment({{ $report->id }})">
            <button class="comment-submit-btn" onclick="submitComment({{ $report->id }})" title="Post comment">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </div>
    </div>

</div>
@endif

@if($loop->iteration % 3 == 0 && \App\Models\Setting::get('ad_script_feed'))
    <div class="in-feed-ad-wrapper" style="background:#ffffff; border-radius:16px; padding:14px; margin-bottom:14px; box-shadow:0 2px 8px rgba(0,0,0,0.04); text-align:center;">
        <span style="font-size:10px; color:#94a3b8; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; display:block; margin-bottom:6px;">Sponsored Ad</span>
        {!! \App\Models\Setting::get('ad_script_feed') !!}
    </div>
@endif
@endforeach

<!-- STAR SENDER MODAL -->
<div id="starSenderModal" class="star-modal-overlay" onclick="if(event.target===this) closeStarModal()">
    <div class="star-modal-card">
        <div class="star-modal-header">
            <h4>⭐ Send Stars to <span id="starAuthorName">Author</span></h4>
            <button type="button" class="star-close-btn" onclick="closeStarModal()">&times;</button>
        </div>
        <div class="star-modal-body">
            <div class="star-balance-text">Your Balance: 🪙 <strong id="starModalUserPoints">{{ auth()->user()->points ?? 0 }}</strong> Points</div>
            <div class="star-preset-grid">
                <button type="button" class="star-preset-btn" onclick="selectStarAmount(10)">⭐ 10</button>
                <button type="button" class="star-preset-btn" onclick="selectStarAmount(50)">⭐ 50</button>
                <button type="button" class="star-preset-btn" onclick="selectStarAmount(100)">⭐ 100</button>
                <button type="button" class="star-preset-btn" onclick="selectStarAmount(500)">⭐ 500</button>
            </div>
            <div style="margin-bottom:12px;">
                <label style="font-size:12px; font-weight:600; color:#475569;">Custom Star Count:</label>
                <input type="number" id="customStarInput" class="star-input-field" value="10" min="1" placeholder="Enter stars count">
            </div>
            <div style="margin-bottom:14px;">
                <input type="text" id="starMessageInput" class="star-input-field" placeholder="Add an appreciation message (optional)">
            </div>
            <button type="button" id="confirmSendStarsBtn" class="confirm-stars-btn" onclick="confirmSendStars()">
                ⭐ Send Stars Now
            </button>
        </div>
    </div>
</div>

<script>
    const IS_AUTH = @json(auth()->check());

    function requireAuth() {
        if (!IS_AUTH) {
            window.location.href = '/register';
            return false;
        }
        return true;
    }

    let activeStarReportId = null;

    function openStarModal(reportId, authorName, authorId) {
        if (!requireAuth()) return;
        activeStarReportId = reportId;
        document.getElementById('starAuthorName').innerText = authorName;
        document.getElementById('starSenderModal').classList.add('active');
    }

    function closeStarModal() {
        document.getElementById('starSenderModal').classList.remove('active');
    }

    function selectStarAmount(amt) {
        document.getElementById('customStarInput').value = amt;
        document.querySelectorAll('.star-preset-btn').forEach(b => b.classList.remove('selected'));
        event.target.classList.add('selected');
    }

    function confirmSendStars() {
        if (!requireAuth() || !activeStarReportId) return;

        const stars = parseInt(document.getElementById('customStarInput').value) || 10;
        const msg = document.getElementById('starMessageInput').value.trim();
        const btn = document.getElementById('confirmSendStarsBtn');

        btn.setAttribute('disabled', 'true');
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Sending Stars...';

        fetch('/report/' + activeStarReportId + '/stars', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ stars: stars, message: msg })
        })
        .then(res => {
            if (res.status === 401) {
                window.location.href = '/register';
                return;
            }
            return res.json();
        })
        .then(data => {
            btn.removeAttribute('disabled');
            btn.innerHTML = '⭐ Send Stars Now';
            if (data.status === 'success') {
                alert(data.message);
                closeStarModal();
                if (document.getElementById('starModalUserPoints')) {
                    document.getElementById('starModalUserPoints').innerText = data.sender_points;
                }
                if (typeof updateDailyChallengeWidget === 'function') {
                    updateDailyChallengeWidget();
                }
            } else {
                alert(data.message || 'Error sending stars');
            }
        })
        .catch(err => {
            btn.removeAttribute('disabled');
            btn.innerHTML = '⭐ Send Stars Now';
            alert('Error processing transaction');
        });
    }

    // Facebook Love React Toggle
    function toggleLove(reportId) {
        if (!requireAuth()) return;

        const btn = document.getElementById('react-btn-' + reportId);
        const icon = document.getElementById('react-icon-' + reportId);
        const countSpan = document.getElementById('react-count-' + reportId);

        fetch('/report/' + reportId + '/react', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => {
            if (res.status === 401) {
                window.location.href = '/register';
                return;
            }
            return res.json();
        })
        .then(data => {
            if (!data) return;
            if (data.loved) {
                btn.classList.add('loved');
                icon.className = 'fa-solid fa-heart';
            } else {
                btn.classList.remove('loved');
                icon.className = 'fa-regular fa-heart';
            }
            countSpan.innerText = data.reactions_count;
            if (typeof updateDailyChallengeWidget === 'function') {
                updateDailyChallengeWidget();
            }
        })
        .catch(err => {
            console.error('Reaction error:', err);
        });
    }

    function toggleComments(reportId) {
        if (!requireAuth()) return;
        const drawer = document.getElementById('comments-drawer-' + reportId);
        if (drawer.style.display === 'none' || !drawer.style.display) {
            drawer.style.display = 'block';
        } else {
            drawer.style.display = 'none';
        }
    }

    function toggleReplyInput(commentId) {
        if (!requireAuth()) return;
        const row = document.getElementById('reply-input-row-' + commentId);
        if (row.style.display === 'none' || !row.style.display) {
            row.style.display = 'block';
            document.getElementById('reply-input-' + commentId).focus();
        } else {
            row.style.display = 'none';
        }
    }

    // Submit Comment or Reply
    function submitComment(reportId, parentId = null) {
        if (!requireAuth()) return;

        let input;
        if (parentId) {
            input = document.getElementById('reply-input-' + parentId);
        } else {
            input = document.getElementById('comment-input-' + reportId);
        }

        const text = input.value.trim();
        if (!text) return;

        fetch('/report/' + reportId + '/comment', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ comment: text, parent_id: parentId })
        })
        .then(res => {
            if (res.status === 401) {
                window.location.href = '/register';
                return;
            }
            return res.json();
        })
        .then(data => {
            if (!data || data.status !== 'success') return;

            const countSpan = document.getElementById('comment-count-' + reportId);
            if (countSpan) countSpan.innerText = data.comments_count;

            if (parentId) {
                const repliesList = document.getElementById('replies-list-' + parentId);
                const replyItem = document.createElement('div');
                replyItem.className = 'comment-item reply-item';
                replyItem.innerHTML = `
                    <div class="comment-avatar">${escapeHtml(data.comment.user_initial)}</div>
                    <div class="comment-bubble">
                        <div class="comment-author-name">${escapeHtml(data.comment.user_name)}</div>
                        <div class="comment-text">${escapeHtml(data.comment.text)}</div>
                    </div>
                `;
                repliesList.appendChild(replyItem);
                document.getElementById('reply-input-row-' + parentId).style.display = 'none';
            } else {
                const commentsList = document.getElementById('comments-list-' + reportId);
                const newComment = document.createElement('div');
                newComment.className = 'comment-item';
                newComment.id = 'comment-item-' + data.comment.id;
                newComment.innerHTML = `
                    <div class="comment-avatar">${escapeHtml(data.comment.user_initial)}</div>
                    <div class="comment-body-wrap">
                        <div class="comment-bubble">
                            <div class="comment-author-name">${escapeHtml(data.comment.user_name)}</div>
                            <div class="comment-text">${escapeHtml(data.comment.text)}</div>
                        </div>
                        <div class="comment-meta-actions">
                            <span class="comment-time">${data.comment.time_ago}</span>
                            <button type="button" class="comment-reply-btn" onclick="toggleReplyInput(${data.comment.id})">Reply</button>
                        </div>
                        <div class="replies-list" id="replies-list-${data.comment.id}"></div>
                        <div class="reply-input-row" id="reply-input-row-${data.comment.id}" style="display: none; margin-top: 6px;">
                            <div class="comment-input-row">
                                <input type="text" class="comment-field" id="reply-input-${data.comment.id}" placeholder="Write a reply..." onkeydown="if(event.key==='Enter') submitComment(${reportId}, ${data.comment.id})">
                                <button class="comment-submit-btn" onclick="submitComment(${reportId}, ${data.comment.id})" title="Post reply">
                                    <i class="fa-solid fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                commentsList.appendChild(newComment);
            }

            input.value = '';
            if (typeof updateDailyChallengeWidget === 'function') {
                updateDailyChallengeWidget();
            }
        })
        .catch(err => {
            console.error('Comment error:', err);
        });
    }

    function escapeHtml(str) {
        return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
    }

    // Toggle Follow User AJAX with optional report_id
    function toggleFollowUser(targetUserId, btn, reportId = null) {
        if (!requireAuth()) return;

        let url = '/user/' + targetUserId + '/follow';

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ report_id: reportId })
        })
        .then(res => {
            if (res.status === 401) {
                window.location.href = '/register';
                return;
            }
            return res.json();
        })
        .then(data => {
            if (!data || data.status !== 'success') return;
            document.querySelectorAll(`button[onclick*="toggleFollowUser(${targetUserId},"]`).forEach(b => {
                if (data.is_following) {
                    b.classList.add('following');
                    b.innerText = '✓ Following';
                } else {
                    b.classList.remove('following');
                    b.innerText = '+ Follow';
                }
            });
            if (typeof updateDailyChallengeWidget === 'function') {
                updateDailyChallengeWidget();
            }
        })
        .catch(err => console.error('Follow error:', err));
    }

    // Facebook Share Dialog / Link Copy
    function sharePost(reportId) {
        if (!requireAuth()) return;

        const shareUrl = window.location.origin + '/#post-' + reportId;
        if (navigator.share) {
            navigator.share({
                title: 'Chandavai Post',
                url: shareUrl
            }).catch(() => {});
        } else {
            const fbShareUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(shareUrl);
            window.open(fbShareUrl, '_blank', 'width=600,height=400');
        }
    }

    // TOGGLE POST OPTIONS DROPDOWN
    function togglePostDropdown(reportId, e) {
        if (e) e.stopPropagation();
        const menu = document.getElementById('postDropdown-' + reportId);
        document.querySelectorAll('.post-dropdown-menu').forEach(m => {
            if (m !== menu) m.style.display = 'none';
        });
        if (menu) {
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        }
    }

    document.addEventListener('click', function() {
        document.querySelectorAll('.post-dropdown-menu').forEach(m => m.style.display = 'none');
    });

    // EDIT POST MODAL
    function openEditPostModal(reportId, description, location) {
        document.getElementById('editReportId').value = reportId;
        document.getElementById('editDescriptionInput').value = description || '';
        document.getElementById('editLocationInput').value = location || '';
        document.getElementById('editPostModal').classList.add('active');
    }

    function closeEditPostModal() {
        document.getElementById('editPostModal').classList.remove('active');
    }

    function submitEditPost() {
        const reportId = document.getElementById('editReportId').value;
        const desc = document.getElementById('editDescriptionInput').value;
        const loc = document.getElementById('editLocationInput').value;

        fetch('/report/' + reportId + '/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ description: desc, location: loc })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                const descEl = document.getElementById('desc-' + reportId);
                if (descEl) descEl.innerText = desc;
                closeEditPostModal();
                alert('Post updated successfully!');
            } else {
                alert(data.message || 'Failed to update post');
            }
        })
        .catch(err => alert('Error updating post'));
    }

    // DELETE POST
    function confirmDeletePost(reportId) {
        if (!confirm('Are you sure you want to delete this post?')) return;

        fetch('/report/' + reportId + '/delete', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                const card = document.getElementById('post-card-' + reportId);
                if (card) card.remove();
                alert('Post deleted successfully!');
            } else {
                alert(data.message || 'Failed to delete post');
            }
        })
        .catch(err => alert('Error deleting post'));
    }

    // FACEBOOK POST INSIGHTS MODAL
    function openPostInsightsModal(reportId) {
        const modal = document.getElementById('postInsightsModal');
        modal.classList.add('active');
        document.getElementById('insightsLoading').style.display = 'block';
        document.getElementById('insightsContent').style.display = 'none';

        fetch('/report/' + reportId + '/insights')
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                const ins = data.insights;
                document.getElementById('insPostTitle').innerText = ins.title || ('Post #' + ins.post_id);
                document.getElementById('insPostDate').innerText = ins.created_at;
                document.getElementById('insViewsVal').innerText = ins.views;
                document.getElementById('insReactionsVal').innerText = ins.reactions;
                document.getElementById('insCommentsVal').innerText = ins.comments;
                document.getElementById('insFollowersVal').innerText = '+' + ins.followers_gained;

                const countryContainer = document.getElementById('insCountriesContainer');
                countryContainer.innerHTML = '';
                ins.countries.forEach(c => {
                    const row = document.createElement('div');
                    row.className = 'country-bar-item';
                    row.innerHTML = `
                        <span>${c.flag} ${c.name}</span>
                        <div class="country-bar-track">
                            <div class="country-bar-fill" style="width: ${c.percentage}%;"></div>
                        </div>
                        <span style="font-size:12px; color:#64748b; width:45px; text-align:right;">${c.percentage}%</span>
                    `;
                    countryContainer.appendChild(row);
                });

                document.getElementById('insightsLoading').style.display = 'none';
                document.getElementById('insightsContent').style.display = 'block';
            }
        })
        .catch(err => alert('Error loading post insights'));
    }

    function closePostInsightsModal() {
        document.getElementById('postInsightsModal').classList.remove('active');
    }

    // ==========================================
    // SINGLE ACTIVE VIDEO PLAYBACK CONTROLLER
    // ==========================================
    document.addEventListener('play', function(e) {
        if (e.target && e.target.tagName && e.target.tagName.toLowerCase() === 'video') {
            const allVideos = document.querySelectorAll('video');
            allVideos.forEach(v => {
                if (v !== e.target && !v.paused) {
                    v.pause();
                }
            });
        }
    }, true);

    // Auto-pause video when scrolled out of view
    if ('IntersectionObserver' in window) {
        const videoObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (!entry.isIntersecting && !entry.target.paused) {
                    entry.target.pause();
                }
            });
        }, { threshold: 0.3 });

        document.querySelectorAll('video').forEach(v => videoObserver.observe(v));
    }

    function trackAdClick(adId) {
        if (!adId) return;
        fetch('/sponsored-ad/' + adId + '/click', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).catch(e => {});
    }
</script>

<!-- EDIT POST MODAL -->
<div id="editPostModal" class="insights-modal-overlay">
    <div class="insights-modal-card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
            <h3 style="font-size:18px; font-weight:700;">Edit Post ✏️</h3>
            <button type="button" style="background:none; border:none; font-size:20px; color:#64748b; cursor:pointer;" onclick="closeEditPostModal()">&times;</button>
        </div>
        <input type="hidden" id="editReportId">
        <div style="margin-bottom:14px;">
            <label style="font-size:13px; font-weight:600; color:#334155; margin-bottom:6px; display:block;">Description</label>
            <textarea id="editDescriptionInput" rows="4" style="width:100%; border:1px solid #cbd5e1; border-radius:12px; padding:10px; font-size:14px; outline:none; font-family:inherit;"></textarea>
        </div>
        <div style="margin-bottom:20px;">
            <label style="font-size:13px; font-weight:600; color:#334155; margin-bottom:6px; display:block;">Location</label>
            <input type="text" id="editLocationInput" style="width:100%; border:1px solid #cbd5e1; border-radius:12px; padding:10px; font-size:14px; outline:none;">
        </div>
        <button type="button" style="width:100%; background:#2563eb; color:#fff; border:none; border-radius:12px; padding:12px; font-size:15px; font-weight:700; cursor:pointer;" onclick="submitEditPost()">Save Changes</button>
    </div>
</div>

<!-- FACEBOOK POST INSIGHTS MODAL -->
<div id="postInsightsModal" class="insights-modal-overlay">
    <div class="insights-modal-card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
            <h3 style="font-size:18px; font-weight:800; color:#0f172a;">Post Insights 📊</h3>
            <button type="button" style="background:none; border:none; font-size:20px; color:#64748b; cursor:pointer;" onclick="closePostInsightsModal()">&times;</button>
        </div>

        <div id="insightsLoading" style="text-align:center; padding:30px; color:#64748b;">
            <i class="fa-solid fa-spinner fa-spin" style="font-size:24px;"></i>
            <p style="margin-top:8px; font-size:13px;">Loading insights...</p>
        </div>

        <div id="insightsContent" style="display:none;">
            <div style="background:#f1f5f9; border-radius:12px; padding:12px; margin-bottom:14px;">
                <div id="insPostTitle" style="font-size:14px; font-weight:700; color:#0f172a; margin-bottom:2px;">Post Title</div>
                <div id="insPostDate" style="font-size:11px; color:#64748b;">Date</div>
            </div>

            <!-- METRICS GRID -->
            <div class="insights-metric-grid">
                <div class="insights-metric-box">
                    <span class="insights-metric-val" id="insViewsVal">0</span>
                    <span class="insights-metric-lbl">👁️ Total Views</span>
                </div>
                <div class="insights-metric-box">
                    <span class="insights-metric-val" id="insReactionsVal">0</span>
                    <span class="insights-metric-lbl">❤️ Likes / Reactions</span>
                </div>
                <div class="insights-metric-box">
                    <span class="insights-metric-val" id="insCommentsVal">0</span>
                    <span class="insights-metric-lbl">💬 Comments</span>
                </div>
                <div class="insights-metric-box">
                    <span class="insights-metric-val" id="insFollowersVal">+0</span>
                    <span class="insights-metric-lbl">👥 Followers Gained</span>
                </div>
            </div>

            <!-- TOP COUNTRIES BREAKDOWN -->
            <div style="font-size:14px; font-weight:700; color:#0f172a; margin-top:16px; margin-bottom:8px;">
                Top View Countries 🌐
            </div>
            <div class="country-bar-row" id="insCountriesContainer">
                <!-- Dynamic country bars -->
            </div>
        </div>
    </div>
</div>