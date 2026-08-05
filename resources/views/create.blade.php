<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Create Post</title>

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
    margin-bottom: 10px;
}

.fb-textarea {
    width: 100%;
    min-height: 130px;
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

.fb-textarea.bg-post {
    min-height: 190px;
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

/* Text Tools Row (Aa & Emoji) */
.fb-input-tools {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 14px;
}

.fb-aa-btn {
    width: 34px;
    height: 34px;
    border-radius: 8px;
    background: linear-gradient(135deg, #ff4757, #2563eb, #10b981);
    color: #ffffff;
    font-weight: 800;
    font-size: 15px;
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
    font-size: 22px;
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
    width: 30px;
    height: 30px;
    border-radius: 50%;
    border: 2px solid transparent;
    cursor: pointer;
    flex-shrink: 0;
}

.fb-bg-circle.selected {
    border-color: #ffffff;
}

/* Emoji Drawer */
.fb-emoji-drawer {
    display: none;
    background: #3a3b3c;
    border-radius: 8px;
    padding: 10px;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 12px;
}

.fb-emoji-drawer.active {
    display: flex;
}

.fb-emoji-item {
    font-size: 22px;
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
    margin-bottom: 16px;
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
    gap: 6px;
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
    margin-bottom: 14px;
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid #3e4042;
}

.fb-media-preview-box img {
    width: 100%;
    max-height: 280px;
    object-fit: cover;
    display: block;
}

.fb-remove-preview-btn {
    position: absolute;
    top: 8px;
    right: 8px;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: rgba(0, 0, 0, 0.7);
    color: #ffffff;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

/* Extra Collapsible Inputs */
.fb-extra-field {
    display: none;
    margin-bottom: 12px;
}

.fb-extra-field.active {
    display: block;
}

.fb-text-input, .fb-select-input {
    width: 100%;
    background: #3a3b3c;
    border: 1px solid #4e4f50;
    color: #e4e6eb;
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 14px;
    outline: none;
    box-sizing: border-box;
}

/* Submit Post Button */
.fb-submit-btn {
    width: 100%;
    height: 40px;
    border-radius: 6px;
    background: #2374e1;
    color: #ffffff;
    font-weight: 600;
    font-size: 16px;
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
                <textarea id="fbPostDescription" name="description" class="fb-textarea" placeholder="What's on your mind, {{ strtok(auth()->user()->name ?? 'Rs', ' ') }}?" oninput="checkFbPostValidity()" required></textarea>
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
            <div id="fbMediaPreviewBox" class="fb-media-preview-box">
                <img id="fbMediaPreviewImg" src="" alt="Preview">
                <button type="button" class="fb-remove-preview-btn" onclick="removeFbImagePreview()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Hidden Image File Input -->
            <input type="file" id="fbImageInput" name="image" accept="image/*" style="display:none;" onchange="handleFbImageSelect(this)">

            <!-- Optional Extra Fields -->
            <div id="fbFieldCategory" class="fb-extra-field">
                <input type="text" name="category" class="fb-text-input" placeholder="Tag / Category (e.g. News, Discussion, General)">
            </div>

            <div id="fbFieldVideo" class="fb-extra-field">
                <input type="text" name="video_url" class="fb-text-input" placeholder="YouTube Video URL (optional)">
            </div>

            <div id="fbFieldLocation" class="fb-extra-field">
                <input type="text" name="location" class="fb-text-input" placeholder="Location / Thana (e.g. Mirpur, Dhaka)">
            </div>

            <!-- Add to your post Toolbar -->
            <div class="fb-add-box">
                <span class="fb-add-label">Add to your post</span>
                <div class="fb-add-actions">
                    <button type="button" class="fb-icon-btn icon-photo" onclick="triggerFbImageUpload()" title="Photo/video">
                        <i class="fa-solid fa-images"></i>
                    </button>
                    <button type="button" class="fb-icon-btn icon-tag" onclick="toggleExtraField('category')" title="Tag people">
                        <i class="fa-solid fa-user-tag"></i>
                    </button>
                    <button type="button" class="fb-icon-btn icon-feeling" onclick="toggleFbEmojiDrawer()" title="Feeling/activity">
                        <i class="fa-regular fa-face-smile"></i>
                    </button>
                    <button type="button" class="fb-icon-btn icon-location" onclick="toggleExtraField('location')" title="Check in / Location">
                        <i class="fa-solid fa-location-dot"></i>
                    </button>
                    <button type="button" class="fb-icon-btn icon-video" onclick="toggleExtraField('video')" title="Video Link">
                        <i class="fa-solid fa-video"></i>
                    </button>
                    <button type="button" class="fb-icon-btn icon-more" onclick="toggleExtraField('category')" title="More">
                        <i class="fa-solid fa-ellipsis"></i>
                    </button>
                </div>
            </div>

            <!-- Submit / Next Button -->
            <button type="submit" id="fbSubmitBtn" class="fb-submit-btn" disabled>Next</button>
        </div>
    </form>
</div>

<script>
function checkFbPostValidity() {
    const text = document.getElementById('fbPostDescription').value.trim();
    const hasImg = document.getElementById('fbImageInput').files.length > 0;
    const submitBtn = document.getElementById('fbSubmitBtn');
    if (text.length > 0 || hasImg) {
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

function handleFbImageSelect(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('fbMediaPreviewImg').src = e.target.result;
            document.getElementById('fbMediaPreviewBox').style.display = 'block';
            checkFbPostValidity();
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function removeFbImagePreview() {
    document.getElementById('fbImageInput').value = '';
    document.getElementById('fbMediaPreviewBox').style.display = 'none';
    document.getElementById('fbMediaPreviewImg').src = '';
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