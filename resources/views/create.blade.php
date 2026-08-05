<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Create Post - chanda vai</title>

<!-- Fonts & Icons -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="{{ asset('css/habib-custom.css') }}">
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: #18191a;
    font-family: 'Inter', sans-serif;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px 12px;
}

.fb-page-card {
    background: #242526;
    color: #e4e6eb;
    width: 100%;
    max-width: 520px;
    border-radius: 12px;
    border: 1px solid #3e4042;
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.5);
    overflow: hidden;
}

.fb-page-header {
    position: relative;
    padding: 14px 16px;
    border-bottom: 1px solid #3e4042;
    text-align: center;
}

.fb-page-title {
    font-size: 20px;
    font-weight: 700;
    color: #e4e6eb;
    margin: 0;
}

.fb-page-close-btn {
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
    text-decoration: none;
    transition: background 0.2s, color 0.2s;
}

.fb-page-close-btn:hover {
    background: #4e4f50;
    color: #ffffff;
}

.fb-page-body {
    padding: 18px;
}

/* User Info Row */
.fb-user-row {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 16px;
}

.fb-user-avatar {
    width: 46px;
    height: 46px;
    border-radius: 50%;
    background: linear-gradient(135deg, #0284c7, #2563eb);
    color: #ffffff;
    font-weight: 700;
    font-size: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.fb-user-details {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.fb-user-name {
    font-size: 15px;
    font-weight: 700;
    color: #e4e6eb;
}

.fb-badges-row {
    display: flex;
    gap: 6px;
}

.fb-badge-btn {
    background: #3a3b3c;
    color: #e4e6eb;
    border: none;
    border-radius: 6px;
    padding: 3px 8px;
    font-size: 12px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 4px;
    cursor: pointer;
}

.fb-badge-btn:hover {
    background: #4e4f50;
}

/* Text Area */
.fb-input-area {
    margin-bottom: 14px;
}

.fb-textarea {
    width: 100%;
    min-height: 110px;
    background: transparent;
    border: none;
    color: #e4e6eb;
    font-size: 16px;
    font-family: inherit;
    resize: none;
    outline: none;
}

.fb-textarea::placeholder {
    color: #8a8d91;
}

.fb-textarea.bg-post {
    min-height: 180px;
    border-radius: 12px;
    padding: 24px 16px;
    font-size: 22px;
    font-weight: 700;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
}

.bg-gradient-1 { background: linear-gradient(135deg, #ff416c, #ff4b2b) !important; color: #ffffff !important; }
.bg-gradient-2 { background: linear-gradient(135deg, #8a2387, #e94057, #f27121) !important; color: #ffffff !important; }
.bg-gradient-3 { background: linear-gradient(135deg, #11998e, #38ef7d) !important; color: #ffffff !important; }
.bg-gradient-4 { background: linear-gradient(135deg, #00c6ff, #0072ff) !important; color: #ffffff !important; }
.bg-gradient-5 { background: linear-gradient(135deg, #f857a6, #ff5858) !important; color: #ffffff !important; }

/* Color Background Palette */
.fb-bg-picker {
    display: none;
    gap: 8px;
    margin-bottom: 14px;
}

.fb-bg-picker.active {
    display: flex;
}

.fb-bg-circle {
    width: 28px;
    height: 28px;
    border-radius: 8px;
    cursor: pointer;
    border: 2px solid transparent;
    transition: transform 0.15s;
}

.fb-bg-circle.selected, .fb-bg-circle:hover {
    transform: scale(1.1);
    border-color: #ffffff;
}

/* Emoji Drawer */
.fb-emoji-drawer {
    display: none;
    background: #3a3b3c;
    border-radius: 10px;
    padding: 10px;
    margin-bottom: 14px;
    grid-template-columns: repeat(6, 1fr);
    gap: 8px;
    text-align: center;
}

.fb-emoji-drawer.active {
    display: grid;
}

.fb-emoji-item {
    font-size: 20px;
    cursor: pointer;
    user-select: none;
    transition: transform 0.15s;
}

.fb-emoji-item:hover {
    transform: scale(1.2);
}

/* Input Tools Row */
.fb-input-tools {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 14px;
}

.fb-aa-btn {
    background: linear-gradient(135deg, #8a2387, #e94057);
    color: #ffffff;
    border: none;
    width: 32px;
    height: 32px;
    border-radius: 8px;
    font-weight: 800;
    font-size: 14px;
    cursor: pointer;
}

.fb-emoji-trigger {
    background: none;
    border: none;
    color: #b0b3b8;
    font-size: 22px;
    cursor: pointer;
}

/* Media Previews */
.fb-media-preview-box {
    position: relative;
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 14px;
    border: 1px solid #3e4042;
    background: #18191a;
    padding: 8px;
}

.fb-remove-preview-btn {
    position: absolute;
    top: 8px;
    right: 8px;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: rgba(0, 0, 0, 0.7);
    color: #ffffff;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 14px;
    z-index: 10;
}

/* Add Box */
.fb-add-box {
    border: 1px solid #3e4042;
    border-radius: 10px;
    padding: 10px 14px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.fb-add-label {
    font-size: 14px;
    font-weight: 600;
    color: #e4e6eb;
}

.fb-add-actions {
    display: flex;
    gap: 8px;
}

.fb-icon-btn {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: transparent;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    cursor: pointer;
    transition: background 0.2s;
}

.fb-icon-btn:hover { background: #3a3b3c; }
.icon-photo { color: #45bd62; }
.icon-tag { color: #1877f2; }
.icon-feeling { color: #f7b928; }
.icon-location { color: #f5533d; }
.icon-video { color: #ff0000; }

.fb-extra-field {
    display: none;
    margin-bottom: 12px;
}

.fb-extra-field.active { display: block; }

.fb-text-input {
    width: 100%;
    padding: 10px 12px;
    background: #3a3b3c;
    border: 1px solid #4e4f50;
    border-radius: 8px;
    color: #e4e6eb;
    font-size: 13px;
    outline: none;
}

.fb-submit-btn {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: none;
    background: #1877f2;
    color: #ffffff;
    font-weight: 700;
    font-size: 15px;
    cursor: pointer;
}

.fb-submit-btn:disabled {
    background: #505153;
    color: #8a8d91;
    cursor: not-allowed;
}

.fb-submit-btn:not(:disabled):hover {
    background: #1a6ed8;
}
</style>
</head>
<body>

<div class="fb-page-card">
    <div class="fb-page-header">
        <h3 class="fb-page-title">Create post</h3>
        <a href="/" class="fb-page-close-btn" title="Back to Feed">
            <i class="fa-solid fa-xmark"></i>
        </a>
    </div>

    <form method="POST" action="/report/store" enctype="multipart/form-data">
        @csrf
        <div class="fb-page-body">
            <!-- User Header -->
            <div class="fb-user-row">
                <div class="fb-user-avatar">
                    @if(auth()->user() && auth()->user()->profile_photo_url)
                        <img src="{{ auth()->user()->profile_photo_url }}" style="width:100%; height:100%; object-fit:cover;" alt="Avatar">
                    @else
                        {{ strtoupper(substr(auth()->user()->name ?? 'R', 0, 1)) }}
                    @endif
                </div>
                <div class="fb-user-details">
                    <div class="fb-user-name">{{ auth()->user()->name ?? 'User' }}</div>
                    <div class="fb-badges-row">
                        <button type="button" class="fb-badge-btn">
                            <i class="fa-solid fa-earth-americas"></i> Public <i class="fa-solid fa-caret-down"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Post Text Area (No required tag) -->
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
            <div id="fbMediaPreviewBox" class="fb-media-preview-box" style="display:none;">
                <div id="fbImagePreviewGrid" style="display:flex; flex-wrap:wrap; gap:6px; margin-bottom:6px;"></div>
                <button type="button" class="fb-remove-preview-btn" onclick="removeFbImagePreview()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Video Preview Container -->
            <div id="fbVideoPreviewBox" class="fb-media-preview-box" style="display:none; margin-top:8px;">
                <video id="fbVideoPreviewPlayer" controls style="width:100%; max-height:220px; border-radius:10px; background:#000; display:block;"></video>
                <button type="button" class="fb-remove-preview-btn" onclick="removeFbVideoPreview()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Multiple Image File Input -->
            <input type="file" id="fbImageInput" name="images[]" multiple accept="image/*" style="display:none;" onchange="handleFbImageSelect(this)">

            <!-- Direct Video File Input -->
            <input type="file" id="fbVideoFileInput" name="video" accept="video/*" style="display:none;" onchange="handleFbVideoFileSelect(this)">

            <!-- Optional Extra Fields -->
            <div id="fbFieldCategory" class="fb-extra-field">
                <input type="text" name="category" class="fb-text-input" placeholder="Tag / Category (e.g. News, Discussion, General)">
            </div>

            <div id="fbFieldVideo" class="fb-extra-field">
                <input type="text" name="video_url" class="fb-text-input" placeholder="YouTube Video URL (optional)" oninput="checkFbPostValidity()">
            </div>

            <div id="fbFieldLocation" class="fb-extra-field">
                <input type="text" name="location" class="fb-text-input" placeholder="Location / Thana (e.g. Mirpur, Dhaka)">
            </div>

            <!-- Add to your post Toolbar -->
            <div class="fb-add-box">
                <span class="fb-add-label">Add to your post</span>
                <div class="fb-add-actions">
                    <button type="button" class="fb-icon-btn icon-photo" onclick="triggerFbImageUpload()" title="Photos">
                        <i class="fa-solid fa-images"></i>
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

            <!-- Submit Button -->
            <button type="submit" id="fbSubmitBtn" class="fb-submit-btn" disabled>Post</button>
        </div>
    </form>
</div>

<script>
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
    document.getElementById('fbBgPicker').classList.toggle('active');
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
    document.getElementById('fbEmojiDrawer').classList.toggle('active');
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
        document.getElementById('fbFieldLocation').classList.toggle('active');
    } else if (type === 'video') {
        document.getElementById('fbFieldVideo').classList.toggle('active');
    } else if (type === 'category') {
        document.getElementById('fbFieldCategory').classList.toggle('active');
    }
}
</script>

</body>
</html>