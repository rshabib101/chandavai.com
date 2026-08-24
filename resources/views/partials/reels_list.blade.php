@foreach($reports as $index => $report)
@php
    $isLiked = false;
    $isFollowing = false;
    if (auth()->check()) {
        $isLiked = $report->reactions->where('user_id', auth()->id())->isNotEmpty();
        if ($report->user_id) {
            $isFollowing = \App\Models\Follow::where('follower_id', auth()->id())->where('following_id', $report->user_id)->exists();
        }
    }
    $videoSrc = !empty($report->video) ? asset('storage/' . $report->video) : ($report->video_url ?? '');
    $authorName = $report->user->name ?? 'Chanda User';
    $authorInitial = strtoupper(substr($authorName, 0, 1));
    $authorPhoto = ($report->user && $report->user->profile_photo_url) ? $report->user->profile_photo_url : null;
    $isAd = !empty($report->sponsored_ad_id) || !empty($report->destination_link);
@endphp

<div class="reel-item" data-reel-id="{{ $report->id }}" id="reel-item-{{ $report->id }}">
    
    <!-- MAIN REEL CONTAINER CARD -->
    <div class="reel-video-card">
        
        <!-- VIDEO PLAYER -->
        @if(!empty($videoSrc))
            <video class="reel-video" src="{{ $videoSrc }}" loop playsinline preload="metadata" onclick="togglePlayPause(this)"></video>
        @else
            <!-- FALLBACK BACKGROUND FOR IMAGE REEL AD -->
            <div class="reel-image-bg" style="background-image: url('{{ asset('storage/' . ($report->image ?: '')) }}');"></div>
        @endif

        <!-- MUTE / UNMUTE FLOATING BUTTON (TOP RIGHT OF CARD) -->
        <button type="button" class="reel-top-btn mute-btn" onclick="toggleMute(this, event)" title="Toggle Mute">
            <i class="fa-solid fa-volume-xmark"></i>
        </button>

        <!-- PLAY/PAUSE CENTER ANIMATED INDICATOR -->
        <div class="play-indicator">
            <i class="fa-solid fa-play"></i>
        </div>

        <!-- REEL BOTTOM OVERLAY (AUTHOR INFO & CAPTION) -->
        <div class="reel-bottom-overlay">
            
            <!-- AUTHOR & FOLLOW ROW -->
            <div class="reel-author-row">
                <a href="{{ $report->user_id ? route('user.profile', $report->user_id) : '#' }}" class="reel-author-link">
                    @if($authorPhoto)
                        <img src="{{ $authorPhoto }}" class="reel-avatar-img" alt="{{ $authorName }}">
                    @else
                        <div class="reel-avatar-initial">{{ $authorInitial }}</div>
                    @endif
                    <span class="reel-author-name">{{ $authorName }}</span>
                </a>

                @if(auth()->check() && $report->user_id && auth()->id() !== $report->user_id)
                    <button type="button" onclick="toggleReelFollow(this, {{ $report->user_id }})" class="reel-follow-btn {{ $isFollowing ? 'following' : '' }}">
                        {{ $isFollowing ? 'Following' : '· Follow' }}
                    </button>
                @endif

                @if($isAd)
                    <span class="reel-sponsored-badge"><i class="fa-solid fa-bullhorn"></i> Sponsored</span>
                @endif
            </div>

            <!-- AUDIO TRACK TAG -->
            <div class="reel-audio-tag">
                <i class="fa-solid fa-music" style="font-size: 11px;"></i>
                <span class="reel-audio-text">{{ $authorName }} · Original audio</span>
            </div>

            <!-- CAPTION & HASHTAGS -->
            @if(!empty($report->description) || !empty($report->title))
                <div class="reel-caption-box">
                    <p class="reel-caption-text">
                        {{ $report->title ? $report->title . ' - ' : '' }}{{ $report->description }}
                    </p>
                </div>
            @endif

            <!-- SPONSORED AD CTA BUTTON -->
            @if($isAd && !empty($report->destination_link))
                <a href="{{ $report->destination_link }}" target="_blank" onclick="trackAdClick({{ $report->sponsored_ad_id ?: 0 }})" class="reel-cta-btn">
                    <span>{{ $report->cta_text ?: 'Learn More' }}</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            @endif

        </div>

    </div>

    <!-- REEL ACTION BUTTONS (VERTICAL STACK BESIDE VIDEO CARD) -->
    <div class="reel-action-stack">
        
        <!-- LIKE BUTTON -->
        <div class="action-item">
            <button type="button" onclick="toggleReelLike(this, {{ $report->id }})" class="action-circle-btn {{ $isLiked ? 'liked' : '' }}" title="Like">
                <i class="fa-solid fa-thumbs-up"></i>
            </button>
            <span class="action-count" id="reel-like-count-{{ $report->id }}">{{ $report->reactions_count ?? $report->reactions->count() }}</span>
        </div>

        <!-- COMMENT BUTTON -->
        <div class="action-item">
            <button type="button" onclick="openReelComments({{ $report->id }})" class="action-circle-btn" title="Comments">
                <i class="fa-solid fa-comment"></i>
            </button>
            <span class="action-count" id="reel-comment-count-{{ $report->id }}">{{ $report->comments_count ?? $report->comments->count() }}</span>
        </div>

        <!-- SHARE / COPY LINK BUTTON -->
        <div class="action-item">
            <button type="button" onclick="shareReel({{ $report->id }})" class="action-circle-btn" title="Share">
                <i class="fa-solid fa-share"></i>
            </button>
            <span class="action-count">Share</span>
        </div>

        <!-- STARS BUTTON -->
        <div class="action-item">
            <button type="button" onclick="openSendStarsModal({{ $report->id }}, '{{ addslashes($authorName) }}')" class="action-circle-btn star-btn" title="Send Stars">
                <i class="fa-solid fa-star"></i>
            </button>
            <span class="action-count">{{ $report->star_transactions_count ?? 0 }}</span>
        </div>

        <!-- MORE OPTIONS (...) -->
        <div class="action-item">
            <button type="button" onclick="openReelOptions({{ $report->id }})" class="action-circle-btn" title="More Options">
                <i class="fa-solid fa-ellipsis"></i>
            </button>
        </div>

    </div>

</div>
@endforeach
