@foreach($reports as $report)
<div class="post">

    <!-- HEADER -->
    <div style="display:flex; gap:10px; align-items:center; margin-bottom:10px;">
        <div style="width:40px;height:40px;border-radius:50%;background:#1877f2;"></div>
        <div>
            <div style="font-weight:600;">Anonymous User</div>
            <div style="font-size:12px;color:gray;">
                {{ $report->created_at->diffForHumans() }}
            </div>
        </div>
    </div>

    <!-- TITLE -->
    <div class="title">
        {{ $report->title }}
    </div>

    <!-- DESCRIPTION -->
    <div class="desc" id="desc-{{ $report->id }}">
        {{ $report->description }}
    </div>

    <button class="see-btn" onclick="toggleDesc({{ $report->id }}, this)">
        See More
    </button>

    <!-- IMAGE -->
    @if($report->image)
        <img class="post-img"
             src="{{ asset('storage/'.$report->image) }}"
             onclick="openImage(this.src)">
    @endif

    <!-- VIDEO -->
    @if($report->video_url)
        @php
            preg_match('/(?:youtube\.com.*(?:\\?|&)v=|youtu\.be\\/)([^&\\n?#]+)/', $report->video_url, $matches);
            $videoId = $matches[1] ?? null;
        @endphp

        @if($videoId)
            <iframe width="100%" height="250"
                src="https://www.youtube.com/embed/{{ $videoId }}"
                frameborder="0"
                allowfullscreen
                style="border-radius:10px; margin-top:10px;">
            </iframe>
        @endif
    @endif

    <!-- FOOTER -->
    <div class="footer">
        <span class="tag">📍 {{ $report->location ?? 'Unknown' }}</span>
        <span class="tag">🏷 {{ $report->category ?? 'General' }}</span>
    </div>

    <!-- ACTIONS -->
    <div class="actions">
        <button>👍 Like</button>
        <button>💬 Comment</button>
        <button>↗ Share</button>
    </div>

</div>
@endforeach