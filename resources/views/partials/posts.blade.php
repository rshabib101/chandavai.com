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
        gap: 6px;
        cursor: pointer;
        padding: 6px 12px;
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

    /* COMMENTS SECTION */
    .comments-drawer {
        margin-top: 12px;
        padding-top: 12px;
        border-top: 1px dashed #e2e8f0;
    }

    .comments-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-bottom: 12px;
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
        background: #0284c7;
        color: #ffffff;
        font-weight: 700;
        font-size: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .comment-bubble {
        background: #f1f5f9;
        border-radius: 14px;
        padding: 8px 12px;
        flex: 1;
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
        line-height: 1.3;
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
</style>

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
@endphp
<div class="post-card" id="post-card-{{ $report->id }}">

    <!-- AUTHOR HEADER -->
    <div class="post-author-row">
        <a href="/user/profile" class="author-left" style="text-decoration:none;">
            <div class="author-avatar-initial">
                {{ strtoupper(substr($authorName, 0, 1)) }}
            </div>
            <div class="author-meta">
                <div class="author-name-wrap">
                    <span class="author-name">
                        {{ $authorName }}
                    </span>
                    <button type="button" class="follow-badge-btn">Follow</button>
                </div>
                <div class="author-sub">
                    {{ $authorHandle }} · {{ $report->created_at ? $report->created_at->diffForHumans() : '25 min ago' }}
                </div>
            </div>
        </a>
        <a href="/settings" class="more-options-btn" title="Settings & Options">
            <i class="fa-solid fa-ellipsis-vertical"></i>
        </a>
    </div>

    <!-- TITLE -->
    @if($report->title)
        <div class="post-content-title">
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

    <!-- IMAGE MEDIA -->
    @if($report->image)
        <div class="post-media-container">
            <img class="post-media-img"
                 src="{{ asset('storage/'.$report->image) }}"
                 alt="Report image"
                 onclick="openImage(this.src)">
        </div>
    @endif

    <!-- VIDEO MEDIA -->
    @if($report->video_url)
        @php
            preg_match('/(?:youtube\.com.*(?:\\?|&)v=|youtu\.be\\/)([^&\\n?#]+)/', $report->video_url, $matches);
            $videoId = $matches[1] ?? null;
        @endphp

        @if($videoId)
            <div class="post-media-container">
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

    <!-- INTERACTION BUTTONS (FACEBOOK LOVE REACT, COMMENT, SHARE) -->
    <div class="post-actions-bar">
        <button class="action-button love-btn {{ $isLoved ? 'loved' : '' }}" id="react-btn-{{ $report->id }}" onclick="toggleLove({{ $report->id }})">
            <i class="{{ $isLoved ? 'fa-solid' : 'fa-regular' }} fa-heart" id="react-icon-{{ $report->id }}"></i>
            <span id="react-text-{{ $report->id }}">Love</span>
            (<span id="react-count-{{ $report->id }}">{{ $reactionsCount }}</span>)
        </button>
        <button class="action-button" onclick="toggleComments({{ $report->id }})">
            <i class="fa-regular fa-comment"></i> Comment (<span id="comment-count-{{ $report->id }}">{{ $commentsCount }}</span>)
        </button>
        <button class="action-button" onclick="sharePost({{ $report->id }})">
            <i class="fa-regular fa-paper-plane"></i> Share
        </button>
    </div>

    <!-- DYNAMIC COMMENTS DRAWER -->
    <div class="comments-drawer" id="comments-drawer-{{ $report->id }}" style="display: none;">
        <div class="comments-list" id="comments-list-{{ $report->id }}">
            @if($report->comments && $report->comments->count() > 0)
                @foreach($report->comments as $c)
                    <div class="comment-item">
                        <div class="comment-avatar">
                            {{ strtoupper(substr($c->user->name ?? 'U', 0, 1)) }}
                        </div>
                        <div class="comment-bubble">
                            <div class="comment-author-name">{{ $c->user->name ?? 'User' }}</div>
                            <div class="comment-text">{{ $c->comment }}</div>
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
@endforeach

<script>
    // Facebook Love React Toggle with AJAX DB persistence
    function toggleLove(reportId) {
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
                window.location.href = '/login';
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
        })
        .catch(err => {
            console.error('Reaction error:', err);
        });
    }

    // Toggle Comments Drawer
    function toggleComments(reportId) {
        const drawer = document.getElementById('comments-drawer-' + reportId);
        if (drawer.style.display === 'none' || !drawer.style.display) {
            drawer.style.display = 'block';
        } else {
            drawer.style.display = 'none';
        }
    }

    // Submit Dynamic Comment with AJAX DB persistence
    function submitComment(reportId) {
        const input = document.getElementById('comment-input-' + reportId);
        const text = input.value.trim();
        if (!text) return;

        fetch('/report/' + reportId + '/comment', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ comment: text })
        })
        .then(res => {
            if (res.status === 401) {
                window.location.href = '/login';
                return;
            }
            return res.json();
        })
        .then(data => {
            if (!data || data.status !== 'success') return;

            const commentsList = document.getElementById('comments-list-' + reportId);
            const countSpan = document.getElementById('comment-count-' + reportId);

            countSpan.innerText = data.comments_count;

            const newComment = document.createElement('div');
            newComment.className = 'comment-item';
            newComment.innerHTML = `
                <div class="comment-avatar">${escapeHtml(data.comment.user_name.charAt(0).toUpperCase())}</div>
                <div class="comment-bubble">
                    <div class="comment-author-name">${escapeHtml(data.comment.user_name)}</div>
                    <div class="comment-text">${escapeHtml(data.comment.text)}</div>
                </div>
            `;
            commentsList.appendChild(newComment);
            input.value = '';
        })
        .catch(err => {
            console.error('Comment error:', err);
        });
    }

    function escapeHtml(str) {
        return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
    }

    // Facebook Share Dialog / Link Copy
    function sharePost(reportId) {
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
</script>