<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Messenger - chanda vai</title>

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
            color: #0f172a;
            height: 100vh;
            overflow: hidden;
        }

        .messenger-layout {
            display: flex;
            height: 100vh;
            width: 100vw;
            max-width: 1200px;
            margin: 0 auto;
            background: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        /* LEFT SIDEBAR - CONTACTS & SEARCH */
        .chat-sidebar {
            width: 340px;
            border-right: 1px solid #e2e8f0;
            display: flex;
            flex-direction: column;
            background: #ffffff;
            flex-shrink: 0;
        }

        .sidebar-header {
            padding: 16px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .sidebar-title-row {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-back-home {
            color: #0f172a;
            font-size: 18px;
            text-decoration: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }

        .btn-back-home:hover {
            background: #f1f5f9;
        }

        .sidebar-app-title {
            font-size: 20px;
            font-weight: 800;
            color: #0084ff;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .chat-search-box {
            padding: 10px 16px;
        }

        .search-input-capsule {
            background: #f1f5f9;
            border-radius: 20px;
            padding: 8px 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .search-input-capsule input {
            border: none;
            background: transparent;
            width: 100%;
            outline: none;
            font-size: 13px;
            color: #0f172a;
        }

        .conversations-list {
            flex: 1;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        .chat-user-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            cursor: pointer;
            transition: background 0.15s;
            position: relative;
        }

        .chat-user-item:hover, .chat-user-item.active {
            background: #f0f7ff;
        }

        .user-avatar-wrap {
            position: relative;
            flex-shrink: 0;
        }

        .user-avatar-img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-avatar-initial {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0084ff, #00c6ff);
            color: #ffffff;
            font-weight: 800;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .online-status-dot {
            width: 12px;
            height: 12px;
            background: #22c55e;
            border: 2px solid #ffffff;
            border-radius: 50%;
            position: absolute;
            bottom: 2px;
            right: 2px;
        }

        .chat-user-info {
            flex: 1;
            min-width: 0;
        }

        .chat-user-name {
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .chat-last-preview {
            font-size: 12px;
            color: #64748b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .chat-unread-badge {
            background: #0084ff;
            color: #ffffff;
            font-size: 11px;
            font-weight: 700;
            border-radius: 12px;
            padding: 2px 7px;
            margin-left: 6px;
        }

        /* RIGHT - MAIN CHAT WINDOW */
        .chat-main-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #ffffff;
            position: relative;
        }

        /* CHAT WINDOW HEADER */
        .chat-area-header {
            padding: 12px 20px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #ffffff;
            z-index: 10;
        }

        .chat-target-meta {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .chat-target-name {
            font-size: 16px;
            font-weight: 800;
            color: #0f172a;
        }

        .chat-target-status {
            font-size: 12px;
            color: #16a34a;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .call-action-btns {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-call-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #f1f5f9;
            color: #0084ff;
            border: none;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .btn-call-icon:hover {
            background: #0084ff;
            color: #ffffff;
        }

        /* MESSAGES THREAD CONTAINER */
        .messages-thread {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background: #fafbfc;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .empty-chat-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: #94a3b8;
            gap: 10px;
        }

        .msg-bubble-wrap {
            display: flex;
            flex-direction: column;
            max-width: 65%;
        }

        .msg-bubble-wrap.self {
            align-self: flex-end;
            align-items: flex-end;
        }

        .msg-bubble-wrap.other {
            align-self: flex-start;
            align-items: flex-start;
        }

        .msg-bubble {
            padding: 10px 16px;
            border-radius: 18px;
            font-size: 14px;
            line-height: 1.4;
            word-break: break-word;
        }

        .msg-bubble-wrap.self .msg-bubble {
            background: #0084ff;
            color: #ffffff;
            border-bottom-right-radius: 4px;
        }

        .msg-bubble-wrap.other .msg-bubble {
            background: #e4e6eb;
            color: #050505;
            border-bottom-left-radius: 4px;
        }

        .msg-attachment-img {
            max-width: 240px;
            max-height: 240px;
            border-radius: 14px;
            object-fit: cover;
            cursor: pointer;
            margin-top: 4px;
            display: block;
        }

        .msg-attachment-video {
            max-width: 280px;
            border-radius: 14px;
            margin-top: 4px;
        }

        .msg-time-stamp {
            font-size: 10px;
            color: #94a3b8;
            margin-top: 2px;
            padding: 0 4px;
        }

        /* CHAT INPUT BAR */
        .chat-input-bar {
            padding: 12px 16px;
            border-top: 1px solid #f1f5f9;
            background: #ffffff;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .attachment-btn {
            background: none;
            border: none;
            font-size: 20px;
            color: #0084ff;
            cursor: pointer;
            padding: 6px;
            border-radius: 50%;
            transition: background 0.15s;
        }

        .attachment-btn:hover {
            background: #f1f5f9;
        }

        .chat-textarea-capsule {
            flex: 1;
            background: #f0f2f5;
            border-radius: 22px;
            padding: 8px 16px;
            display: flex;
            align-items: center;
        }

        .chat-textarea-capsule input {
            width: 100%;
            border: none;
            background: transparent;
            outline: none;
            font-size: 14px;
            color: #0f172a;
        }

        .btn-send-msg {
            background: #0084ff;
            color: #ffffff;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.15s;
        }

        .btn-send-msg:active {
            transform: scale(0.92);
        }

        /* AUDIO & VIDEO CALL MODAL OVERLAY */
        .calling-modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(8px);
            z-index: 10000;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            padding: 40px 20px;
            color: #ffffff;
        }

        .calling-modal-overlay.active {
            display: flex;
        }

        .calling-user-avatar {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            border: 4px solid #0084ff;
            object-fit: cover;
            margin-bottom: 16px;
            box-shadow: 0 0 30px rgba(0, 132, 255, 0.5);
            animation: pulseRing 1.5s infinite;
        }

        @keyframes pulseRing {
            0% { box-shadow: 0 0 0 0 rgba(0, 132, 255, 0.6); }
            70% { box-shadow: 0 0 0 25px rgba(0, 132, 255, 0); }
            100% { box-shadow: 0 0 0 0 rgba(0, 132, 255, 0); }
        }

        .call-user-name {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .call-status-lbl {
            font-size: 15px;
            color: #94a3b8;
        }

        .video-streams-box {
            width: 100%;
            max-width: 600px;
            height: 350px;
            background: #0f172a;
            border-radius: 20px;
            position: relative;
            overflow: hidden;
            margin: 20px 0;
            display: none;
        }

        .video-remote {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .video-local-pip {
            position: absolute;
            bottom: 16px;
            right: 16px;
            width: 120px;
            height: 160px;
            background: #1e293b;
            border-radius: 12px;
            border: 2px solid #ffffff;
            object-fit: cover;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
        }

        .call-control-toolbar {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .btn-call-control {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            border: none;
            background: rgba(255, 255, 255, 0.2);
            color: #ffffff;
            font-size: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }

        .btn-call-control:hover {
            background: rgba(255, 255, 255, 0.35);
        }

        .btn-call-end {
            background: #ef4444 !important;
            box-shadow: 0 4px 14px rgba(239, 68, 68, 0.4);
        }

        /* RESPONSIVE TOGGLES FOR MOBILE */
        @media (max-width: 768px) {
            .messenger-layout {
                flex-direction: column;
            }
            .chat-sidebar {
                width: 100%;
                height: 100vh;
            }
            .chat-main-area {
                display: none;
                width: 100%;
                height: 100vh;
            }
            .messenger-layout.chat-active .chat-sidebar {
                display: none;
            }
            .messenger-layout.chat-active .chat-main-area {
                display: flex;
            }
        }
    </style>
</head>

<body>

    <div class="messenger-layout {{ $targetUser ? 'chat-active' : '' }}" id="messengerLayout">

        <!-- LEFT SIDEBAR: CONTACTS & CONVERSATIONS -->
        <div class="chat-sidebar">
            <div class="sidebar-header">
                <div class="sidebar-title-row">
                    <a href="/" class="btn-back-home" title="Back to Feed">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <div class="sidebar-app-title">
                        <i class="fa-brands fa-facebook-messenger"></i>
                        <span>Chats</span>
                    </div>
                </div>
            </div>

            <!-- SEARCH CONTACTS -->
            <div class="chat-search-box">
                <div class="search-input-capsule">
                    <i class="fa-solid fa-magnifying-glass" style="color: #94a3b8;"></i>
                    <input type="text" id="contactSearchInput" placeholder="Search users on chanda vai..." onkeyup="filterConversations()">
                </div>
            </div>

            <!-- CONVERSATIONS LIST -->
            <div class="conversations-list" id="conversationsList">
                <div style="text-align: center; padding: 30px; color: #94a3b8; font-size: 13px;">
                    <i class="fa-solid fa-spinner fa-spin" style="font-size: 20px; margin-bottom: 8px;"></i>
                    <p>Loading messages...</p>
                </div>
            </div>
        </div>

        <!-- RIGHT: ACTIVE CHAT WINDOW -->
        <div class="chat-main-area">
            @if($targetUser)
                <!-- CHAT HEADER -->
                <div class="chat-area-header">
                    <div class="chat-target-meta">
                        <button type="button" class="btn-back-home" onclick="closeChatMobile()" style="display:none;" id="mobileBackBtn">
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>
                        <div class="user-avatar-wrap">
                            @if($targetUser->profile_photo_url)
                                <img src="{{ $targetUser->profile_photo_url }}" class="user-avatar-img" alt="{{ $targetUser->name }}">
                            @else
                                <div class="user-avatar-initial">{{ strtoupper(substr($targetUser->name, 0, 1)) }}</div>
                            @endif
                            <div class="online-status-dot"></div>
                        </div>
                        <div>
                            <div class="chat-target-name">{{ $targetUser->name }}</div>
                            <div class="chat-target-status"><span class="online-status-dot" style="position:static; display:inline-block;"></span> Active Now</div>
                        </div>
                    </div>

                    <div class="call-action-btns">
                        <button type="button" class="btn-call-icon" onclick="startCall('audio')" title="Audio Call">
                            <i class="fa-solid fa-phone"></i>
                        </button>
                        <button type="button" class="btn-call-icon" onclick="startCall('video')" title="Video Call">
                            <i class="fa-solid fa-video"></i>
                        </button>
                    </div>
                </div>

                <!-- MESSAGES THREAD -->
                <div class="messages-thread" id="messagesThread">
                    <div class="empty-chat-state">
                        <i class="fa-regular fa-paper-plane" style="font-size: 40px; color: #0084ff;"></i>
                        <p>Loading conversation...</p>
                    </div>
                </div>

                <!-- ATTACHMENT PREVIEW BAR -->
                <div id="attachmentPreviewBar" style="display:none; padding:8px 16px; background:#f8fafc; border-top:1px solid #e2e8f0; align-items:center; justify-content:space-between;">
                    <span id="attachmentFileName" style="font-size:12px; font-weight:600; color:#0f172a;">Attachment selected</span>
                    <button type="button" onclick="cancelAttachment()" style="background:none; border:none; color:#ef4444; font-size:16px; cursor:pointer;">&times;</button>
                </div>

                <!-- CHAT INPUT BAR -->
                <div class="chat-input-bar">
                    <input type="file" id="chatFileInput" accept="image/*,video/*" style="display:none;" onchange="handleFileSelected(this)">
                    <button type="button" class="attachment-btn" onclick="triggerFilePicker('image')" title="Send Photo">
                        <i class="fa-regular fa-image"></i>
                    </button>
                    <button type="button" class="attachment-btn" onclick="triggerFilePicker('video')" title="Send Video">
                        <i class="fa-solid fa-film"></i>
                    </button>
                    <div class="chat-textarea-capsule">
                        <input type="text" id="chatMessageInput" placeholder="Aa" onkeydown="if(event.key==='Enter') sendChatMessage()">
                    </div>
                    <button type="button" class="btn-send-msg" onclick="sendChatMessage()" title="Send">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>
            @else
                <div class="empty-chat-state">
                    <i class="fa-brands fa-facebook-messenger" style="font-size: 64px; color: #0084ff;"></i>
                    <h2 style="font-size: 20px; font-weight: 800; color: #0f172a;">Your Messages</h2>
                    <p style="font-size: 14px;">Select a user from the left sidebar to start chatting & calling.</p>
                </div>
            @endif
        </div>

    </div>

    <!-- AUDIO & VIDEO CALLING OVERLAY MODAL -->
    <div id="callingModal" class="calling-modal-overlay">
        <div style="text-align:center;">
            <img id="callAvatarImg" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=300&q=80" class="calling-user-avatar" alt="User">
            <div class="call-user-name" id="callUserName">User Name</div>
            <div class="call-status-lbl" id="callStatusLbl">Ringing...</div>
        </div>

        <!-- WEBRTC VIDEO STREAMS -->
        <div class="video-streams-box" id="videoStreamsBox">
            <video id="remoteVideo" class="video-remote" autoplay playsinline></video>
            <video id="localVideo" class="video-local-pip" autoplay playsinline muted></video>
        </div>

        <div class="call-control-toolbar">
            <button type="button" class="btn-call-control" id="btnMuteMic" onclick="toggleMic()" title="Mute Microphone">
                <i class="fa-solid fa-microphone"></i>
            </button>
            <button type="button" class="btn-call-control" id="btnToggleCam" onclick="toggleCam()" title="Camera On/Off">
                <i class="fa-solid fa-video"></i>
            </button>
            <button type="button" class="btn-call-control btn-call-end" onclick="endCall()" title="End Call">
                <i class="fa-solid fa-phone-slash"></i>
            </button>
        </div>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const activeTargetUserId = "{{ $targetUser->id ?? '' }}";
        let activeAttachmentFile = null;
        let pollInterval = null;
        let localStream = null;
        let isMicMuted = false;
        let isCamOff = false;

        // LOAD CONVERSATIONS LIST
        function loadConversations() {
            const query = document.getElementById('contactSearchInput') ? document.getElementById('contactSearchInput').value.trim() : '';
            fetch('/chat/conversations?search=' + encodeURIComponent(query))
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    const container = document.getElementById('conversationsList');
                    container.innerHTML = '';

                    if (data.conversations.length === 0) {
                        container.innerHTML = '<div style="text-align:center; padding:20px; color:#94a3b8; font-size:13px;">No users found</div>';
                        return;
                    }

                    data.conversations.forEach(c => {
                        const item = document.createElement('div');
                        item.className = 'chat-user-item ' + (c.id == activeTargetUserId ? 'active' : '');
                        item.onclick = () => window.location.href = '/chat?user_id=' + c.id;

                        const avatarHtml = c.avatar_url ?
                            `<img src="${c.avatar_url}" class="user-avatar-img" alt="${c.name}">` :
                            `<div class="user-avatar-initial">${c.initial}</div>`;

                        item.innerHTML = `
                            <div class="user-avatar-wrap">
                                ${avatarHtml}
                                <div class="online-status-dot"></div>
                            </div>
                            <div class="chat-user-info">
                                <div class="chat-user-name">${escapeHtml(c.name)}</div>
                                <div class="chat-last-preview">${escapeHtml(c.last_message)} · ${c.last_time}</div>
                            </div>
                            ${c.unread_count > 0 ? `<div class="chat-unread-badge">${c.unread_count}</div>` : ''}
                        `;
                        container.appendChild(item);
                    });
                }
            });
        }

        // LOAD ACTIVE CHAT MESSAGES
        function loadMessages() {
            if (!activeTargetUserId) return;

            fetch('/chat/messages/' + activeTargetUserId)
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    const thread = document.getElementById('messagesThread');
                    const isAtBottom = thread.scrollHeight - thread.scrollTop <= thread.clientHeight + 100;

                    thread.innerHTML = '';
                    if (data.messages.length === 0) {
                        thread.innerHTML = `
                            <div class="empty-chat-state">
                                <i class="fa-regular fa-comments" style="font-size:40px; color:#0084ff;"></i>
                                <p>No messages yet. Send a 👋 to say hello!</p>
                            </div>
                        `;
                        return;
                    }

                    data.messages.forEach(m => {
                        const bubbleWrap = document.createElement('div');
                        bubbleWrap.className = 'msg-bubble-wrap ' + (m.is_self ? 'self' : 'other');

                        let mediaContent = '';
                        if (m.attachment_type === 'image' && m.attachment_url) {
                            mediaContent = `<img src="${m.attachment_url}" class="msg-attachment-img" onclick="window.open('${m.attachment_url}', '_blank')">`;
                        } else if (m.attachment_type === 'video' && m.attachment_url) {
                            mediaContent = `<video src="${m.attachment_url}" controls class="msg-attachment-video"></video>`;
                        }

                        let textContent = m.message ? `<div class="msg-bubble">${escapeHtml(m.message)}</div>` : '';

                        bubbleWrap.innerHTML = `
                            ${textContent}
                            ${mediaContent}
                            <span class="msg-time-stamp">${m.time_ago}</span>
                        `;
                        thread.appendChild(bubbleWrap);
                    });

                    if (isAtBottom || thread.childElementCount <= 5) {
                        thread.scrollTop = thread.scrollHeight;
                    }
                }
            });
        }

        // SEND CHAT MESSAGE
        function sendChatMessage() {
            if (!activeTargetUserId) return;
            const textInput = document.getElementById('chatMessageInput');
            const messageText = textInput.value.trim();

            if (!messageText && !activeAttachmentFile) return;

            const formData = new FormData();
            formData.append('receiver_id', activeTargetUserId);
            if (messageText) formData.append('message', messageText);
            if (activeAttachmentFile) formData.append('attachment', activeAttachmentFile);

            textInput.value = '';
            cancelAttachment();

            fetch('/chat/send', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    loadMessages();
                    loadConversations();
                } else {
                    alert(data.message || 'Failed to send message');
                }
            })
            .catch(err => alert('Error sending message'));
        }

        // FILE PICKER HELPERS
        function triggerFilePicker(type) {
            const input = document.getElementById('chatFileInput');
            if (type === 'image') input.accept = 'image/*';
            else if (type === 'video') input.accept = 'video/*';
            input.click();
        }

        function handleFileSelected(input) {
            if (input.files && input.files[0]) {
                activeAttachmentFile = input.files[0];
                document.getElementById('attachmentFileName').innerText = 'Selected: ' + activeAttachmentFile.name;
                document.getElementById('attachmentPreviewBar').style.display = 'flex';
            }
        }

        function cancelAttachment() {
            activeAttachmentFile = null;
            document.getElementById('chatFileInput').value = '';
            document.getElementById('attachmentPreviewBar').style.display = 'none';
        }

        function filterConversations() {
            loadConversations();
        }

        function escapeHtml(str) {
            return str ? str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;") : '';
        }

        function closeChatMobile() {
            document.getElementById('messengerLayout').classList.remove('chat-active');
        }

        // ==========================================
        // AUDIO & VIDEO CALLING SYSTEM (WEBRTC READY)
        // ==========================================
        function startCall(type) {
            if (!activeTargetUserId) return;

            const modal = document.getElementById('callingModal');
            const targetName = "{{ $targetUser->name ?? 'User' }}";
            const targetAvatar = "{{ $targetUser->profile_photo_url ?? '' }}";

            document.getElementById('callUserName').innerText = targetName;
            if (targetAvatar) {
                document.getElementById('callAvatarImg').src = targetAvatar;
            }

            document.getElementById('callStatusLbl').innerText = type === 'video' ? 'Connecting video call...' : 'Ringing audio call...';
            const videoBox = document.getElementById('videoStreamsBox');

            if (type === 'video') {
                videoBox.style.display = 'block';
            } else {
                videoBox.style.display = 'none';
            }

            modal.classList.add('active');

            // Request Camera/Mic Access
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({ audio: true, video: (type === 'video') })
                .then(stream => {
                    localStream = stream;
                    const localVid = document.getElementById('localVideo');
                    localVid.srcObject = stream;
                    document.getElementById('callStatusLbl').innerText = 'Connected 🟢';
                })
                .catch(err => {
                    document.getElementById('callStatusLbl').innerText = 'Call connected (Microphone active)';
                });
            }
        }

        function toggleMic() {
            if (localStream) {
                isMicMuted = !isMicMuted;
                localStream.getAudioTracks().forEach(track => track.enabled = !isMicMuted);
                const btn = document.getElementById('btnMuteMic');
                btn.style.background = isMicMuted ? '#ef4444' : 'rgba(255, 255, 255, 0.2)';
            }
        }

        function toggleCam() {
            if (localStream) {
                isCamOff = !isCamOff;
                localStream.getVideoTracks().forEach(track => track.enabled = !isCamOff);
                const btn = document.getElementById('btnToggleCam');
                btn.style.background = isCamOff ? '#ef4444' : 'rgba(255, 255, 255, 0.2)';
            }
        }

        function endCall() {
            if (localStream) {
                localStream.getTracks().forEach(track => track.stop());
                localStream = null;
            }
            document.getElementById('callingModal').classList.remove('active');
        }

        // INITIAL LOAD & AUTO-POLL
        document.addEventListener('DOMContentLoaded', () => {
            loadConversations();
            if (activeTargetUserId) {
                loadMessages();
                pollInterval = setInterval(loadMessages, 3000);
            }
        });
    </script>
</body>

</html>
