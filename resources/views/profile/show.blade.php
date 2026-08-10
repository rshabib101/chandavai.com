<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $user->name }} - Profile</title>

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
            padding-bottom: 60px;
        }

        .profile-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            min-height: 100vh;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        /* TOP NAVIGATION HEADER */
        .profile-nav-bar {
            position: sticky;
            top: 0;
            background: #ffffff;
            z-index: 100;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #f1f5f9;
        }

        .btn-nav-icon {
            background: none;
            border: none;
            font-size: 18px;
            color: #0f172a;
            cursor: pointer;
            text-decoration: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }

        .btn-nav-icon:hover {
            background: #f1f5f9;
        }

        .nav-user-title {
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
        }

        /* COVER BANNER SECTION */
        .cover-banner-box {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #1877f2 0%, #0052cc 100%);
            position: relative;
            background-size: cover;
            background-position: center;
        }

        .cover-camera-btn {
            position: absolute;
            bottom: 12px;
            right: 12px;
            background: rgba(0, 0, 0, 0.65);
            color: #ffffff;
            border: none;
            border-radius: 20px;
            padding: 6px 14px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* HEADER AVATAR & INFO AREA */
        .profile-header-area {
            padding: 0 16px 16px 16px;
            position: relative;
        }

        .avatar-wrap-row {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-top: -60px;
            margin-bottom: 12px;
            position: relative;
        }

        .main-avatar-box {
            position: relative;
        }

        .profile-avatar-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #ffffff;
            object-fit: cover;
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .profile-avatar-initial {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #ffffff;
            background: linear-gradient(135deg, #0084ff, #00c6ff);
            color: #ffffff;
            font-weight: 800;
            font-size: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .avatar-camera-overlay {
            position: absolute;
            bottom: 4px;
            right: 4px;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #e4e6eb;
            color: #050505;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: 2px solid #ffffff;
            font-size: 14px;
        }

        .thought-bubble-pill {
            background: #e4e6eb;
            border-radius: 18px;
            padding: 6px 14px;
            font-size: 12px;
            font-weight: 600;
            color: #050505;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            cursor: pointer;
        }

        .user-name-title {
            font-size: 22px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .user-stats-row {
            font-size: 14px;
            color: #64748b;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .user-category-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            margin-bottom: 16px;
        }

        /* ACTION BUTTONS ROW */
        .profile-actions-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .btn-action-primary {
            flex: 1;
            background: #1877f2;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            padding: 10px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            box-shadow: 0 2px 6px rgba(24, 119, 242, 0.3);
            transition: opacity 0.2s;
        }

        .btn-action-primary:hover {
            opacity: 0.92;
        }

        .btn-action-secondary {
            flex: 1;
            background: #e4e6eb;
            color: #050505;
            border: none;
            border-radius: 8px;
            padding: 10px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            transition: background 0.2s;
        }

        .btn-action-secondary:hover {
            background: #d8dadf;
        }

        .btn-action-icon-only {
            width: 40px;
            height: 40px;
            background: #e4e6eb;
            color: #050505;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* TABS FILTER BAR */
        .profile-tabs-bar {
            display: flex;
            align-items: center;
            gap: 8px;
            border-top: 1px solid #f1f5f9;
            border-bottom: 1px solid #f1f5f9;
            padding: 8px 16px;
            overflow-x: auto;
            scrollbar-width: none;
        }

        .profile-tab-pill {
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
            text-decoration: none;
            white-space: nowrap;
        }

        .profile-tab-pill.active {
            background: #e7f3ff;
            color: #1877f2;
            font-weight: 700;
        }

        /* PERSONAL DETAILS CARD */
        .details-card {
            padding: 16px;
            border-bottom: 1px solid #f1f5f9;
        }

        .details-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .details-title {
            font-size: 17px;
            font-weight: 800;
            color: #0f172a;
        }

        .btn-edit-pencil {
            background: none;
            border: none;
            font-size: 18px;
            color: #64748b;
            cursor: pointer;
        }

        .detail-item-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            font-size: 14px;
            color: #334155;
        }

        .detail-item-icon {
            width: 24px;
            font-size: 18px;
            color: #64748b;
            text-align: center;
        }

        /* FRIENDS / FOLLOWERS CIRCULAR AVATARS */
        .friends-card {
            padding: 16px;
            border-bottom: 1px solid #f1f5f9;
        }

        .friends-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-top: 12px;
        }

        .friend-item-box {
            text-align: center;
            cursor: pointer;
            text-decoration: none;
        }

        .friend-avatar-img {
            width: 100%;
            aspect-ratio: 1;
            border-radius: 12px;
            object-fit: cover;
            margin-bottom: 4px;
        }

        .friend-avatar-initial {
            width: 100%;
            aspect-ratio: 1;
            border-radius: 12px;
            background: linear-gradient(135deg, #0084ff, #00c6ff);
            color: #ffffff;
            font-weight: 800;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 4px;
        }

        .friend-name-label {
            font-size: 12px;
            font-weight: 600;
            color: #0f172a;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
        }

        /* EDIT PROFILE MODAL */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(4px);
            z-index: 10000;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-card {
            background: #ffffff;
            border-radius: 20px;
            width: 100%;
            max-width: 480px;
            max-height: 90vh;
            overflow-y: auto;
            padding: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .modal-field-group {
            margin-bottom: 14px;
        }

        .modal-field-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }

        .modal-field-group input, .modal-field-group select, .modal-field-group textarea {
            width: 100%;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 14px;
            outline: none;
        }
    </style>
</head>

<body>

    <div class="profile-container">

        <!-- TOP NAV BAR -->
        <div class="profile-nav-bar">
            <a href="/" class="btn-nav-icon" title="Back to Feed">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div class="nav-user-title">{{ $user->name }}</div>
            @auth
                <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <button type="button" class="btn-nav-icon" onclick="document.getElementById('logoutForm').submit();" title="Logout" style="color: #ef4444;">
                    <i class="fa-solid fa-right-from-bracket" style="font-size: 18px;"></i>
                </button>
            @else
                <a href="/login" class="btn-nav-icon" title="Login">
                    <i class="fa-solid fa-right-to-bracket"></i>
                </a>
            @endauth
        </div>

        <!-- COVER BANNER -->
        <div class="cover-banner-box" style="{{ $user->cover_photo_url ? 'background-image: url(' . $user->cover_photo_url . ');' : '' }}">
            @if($isOwner)
                <button type="button" class="cover-camera-btn" onclick="document.getElementById('coverPhotoInput').click()">
                    <i class="fa-solid fa-camera"></i> Edit Cover
                </button>
                <input type="file" id="coverPhotoInput" accept="image/*" style="display:none;" onchange="uploadPhoto('cover')">
            @endif
        </div>

        <!-- PROFILE HEADER AREA -->
        <div class="profile-header-area">
            <div class="avatar-wrap-row">
                <div class="main-avatar-box">
                    @if($user->profile_photo_url)
                        <img src="{{ $user->profile_photo_url }}" class="profile-avatar-img" alt="{{ $user->name }}">
                    @else
                        <div class="profile-avatar-initial">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                    @endif

                    @if($isOwner)
                        <div class="avatar-camera-overlay" onclick="document.getElementById('profilePhotoInput').click()">
                            <i class="fa-solid fa-camera"></i>
                        </div>
                        <input type="file" id="profilePhotoInput" accept="image/*" style="display:none;" onchange="uploadPhoto('profile')">
                    @endif
                </div>

                <div class="thought-bubble-pill">
                    <i class="fa-regular fa-comment-dots"></i> Drop a thought...
                </div>
            </div>

            <h1 class="user-name-title">{{ $user->name }}</h1>
            <div class="user-stats-row">{{ number_format($followersCount) }} followers · {{ number_format($followingCount) }} following</div>

            <div class="user-category-badge">
                <i class="fa-solid fa-briefcase"></i> {{ $user->category ?: 'Digital creator' }}
            </div>

            <!-- ACTION BUTTONS -->
            <div class="profile-actions-row">
                @if($isOwner)
                    <a href="/user/analytics" class="btn-action-primary">
                        <i class="fa-solid fa-chart-column"></i> Dashboard
                    </a>
                    <button type="button" class="btn-action-secondary" onclick="window.location.href='/'">
                        <i class="fa-solid fa-plus"></i> Create
                    </button>
                    <button type="button" class="btn-action-icon-only" onclick="openEditProfileModal()" title="Edit Profile">
                        <i class="fa-solid fa-pen"></i>
                    </button>
                @else
                    <button type="button" class="btn-action-primary" id="btnFollowUser" onclick="toggleFollowUser('{{ $user->id }}')">
                        <i class="fa-solid {{ $isFollowing ? 'fa-check' : 'fa-user-plus' }}"></i>
                        <span id="followBtnTxt">{{ $isFollowing ? 'Following' : 'Follow User' }}</span>
                    </button>
                    <a href="/chat?user_id={{ $user->id }}" class="btn-action-secondary">
                        <i class="fa-brands fa-facebook-messenger" style="color: #0084ff;"></i> Message
                    </a>
                @endif
            </div>
        </div>

        <!-- TABS FILTER BAR -->
        <div class="profile-tabs-bar">
            <a href="#" class="profile-tab-pill active">All</a>
            <a href="#" class="profile-tab-pill">Reels</a>
            <a href="#" class="profile-tab-pill">Photos</a>
            <a href="#" class="profile-tab-pill">More ▾</a>
        </div>

        <!-- PERSONAL DETAILS CARD -->
        <div class="details-card">
            <div class="details-card-header">
                <span class="details-title">Personal details</span>
                @if($isOwner)
                    <button type="button" class="btn-edit-pencil" onclick="openEditProfileModal()" title="Edit Details">
                        <i class="fa-solid fa-pen"></i>
                    </button>
                @endif
            </div>

            <div class="detail-item-row">
                <i class="fa-solid fa-location-dot detail-item-icon"></i>
                <span>{{ $user->hometown ?: ($user->city ? $user->city . ', ' . $user->country : 'Dhaka, Bangladesh') }}</span>
            </div>

            @if($user->work)
                <div class="detail-item-row">
                    <i class="fa-solid fa-briefcase detail-item-icon"></i>
                    <span>{{ $user->work }}</span>
                </div>
            @endif

            @if($user->education)
                <div class="detail-item-row">
                    <i class="fa-solid fa-graduation-cap detail-item-icon"></i>
                    <span>{{ $user->education }}</span>
                </div>
            @endif

            <div class="detail-item-row">
                <i class="fa-solid fa-cake-candles detail-item-icon"></i>
                <span>{{ $user->birthdate ? \Carbon\Carbon::parse($user->birthdate)->format('F j, Y') : 'January 3, 1996' }}</span>
            </div>

            <div class="detail-item-row">
                <i class="fa-solid fa-heart detail-item-icon"></i>
                <span>{{ $user->relationship_status ?: 'Married' }}</span>
            </div>

            @if($user->whatsapp || $user->phone)
                <div class="detail-item-row">
                    <i class="fa-brands fa-whatsapp detail-item-icon" style="color: #22c55e;"></i>
                    <span>{{ $user->whatsapp ?: $user->phone }}</span>
                </div>
            @endif
        </div>

        <!-- FRIENDS / FOLLOWERS CARD -->
        <div class="friends-card">
            <div class="details-card-header">
                <div>
                    <span class="details-title">Friends</span>
                    <div style="font-size:12px; color:#64748b;">{{ number_format($followersCount) }} friends</div>
                </div>
                <a href="#" style="font-size:14px; font-weight:700; color:#1877f2; text-decoration:none;">See all</a>
            </div>

            <div class="friends-grid">
                @if(isset($followersList) && count($followersList) > 0)
                    @foreach($followersList as $f)
                        <a href="/user/profile/{{ $f->id }}" class="friend-item-box">
                            @if($f->profile_photo_url)
                                <img src="{{ $f->profile_photo_url }}" class="friend-avatar-img" alt="{{ $f->name }}">
                            @else
                                <div class="friend-avatar-initial">{{ strtoupper(substr($f->name, 0, 1)) }}</div>
                            @endif
                            <span class="friend-name-label">{{ strtok($f->name, ' ') }}</span>
                        </a>
                    @endforeach
                @else
                    <div style="grid-column: span 4; color: #94a3b8; font-size: 13px; text-align: center; padding: 10px;">No friends to show</div>
                @endif
            </div>
        </div>

        <!-- POSTS FEED SECTION -->
        <div style="padding: 16px 0;">
            @include('partials.posts', ['reports' => $reports])
        </div>

    </div>

    <!-- EDIT PROFILE MODAL -->
    <div id="editProfileModal" class="modal-overlay">
        <div class="modal-card">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                <h3 style="font-size:18px; font-weight:800; color:#0f172a;">Edit Personal Details ✏️</h3>
                <button type="button" onclick="closeEditProfileModal()" style="background:none; border:none; font-size:24px; color:#64748b; cursor:pointer;">&times;</button>
            </div>

            <div class="modal-field-group">
                <label>Category / Title</label>
                <input type="text" id="editCategory" value="{{ $user->category ?: 'Digital creator' }}" placeholder="e.g. Digital creator, Entrepreneur">
            </div>

            <div class="modal-field-group">
                <label>Bio</label>
                <textarea id="editBio" rows="2" placeholder="Write a short bio...">{{ $user->bio }}</textarea>
            </div>

            <div class="modal-field-group">
                <label>Mobile / WhatsApp Number</label>
                <input type="text" id="editWhatsapp" value="{{ $user->whatsapp ?: $user->phone }}" placeholder="e.g. +8801700000000">
            </div>

            <div class="modal-field-group">
                <label>Hometown / Location</label>
                <input type="text" id="editHometown" value="{{ $user->hometown ?: ($user->city ? $user->city . ', ' . $user->country : 'Dhaka, Bangladesh') }}" placeholder="e.g. Dhaka, Bangladesh">
            </div>

            <div class="modal-field-group">
                <label>Work</label>
                <input type="text" id="editWork" value="{{ $user->work }}" placeholder="e.g. Owner and CEO at Omar Car Decoration">
            </div>

            <div class="modal-field-group">
                <label>Education</label>
                <input type="text" id="editEducation" value="{{ $user->education }}" placeholder="e.g. Habibullah Bahar College">
            </div>

            <div class="modal-field-group">
                <label>Relationship Status</label>
                <select id="editRelationship">
                    <option value="Single" {{ $user->relationship_status == 'Single' ? 'selected' : '' }}>Single</option>
                    <option value="Married" {{ $user->relationship_status == 'Married' || !$user->relationship_status ? 'selected' : '' }}>Married</option>
                    <option value="In a relationship" {{ $user->relationship_status == 'In a relationship' ? 'selected' : '' }}>In a relationship</option>
                    <option value="Engaged" {{ $user->relationship_status == 'Engaged' ? 'selected' : '' }}>Engaged</option>
                </select>
            </div>

            <div class="modal-field-group">
                <label>Birthday</label>
                <input type="date" id="editBirthdate" value="{{ $user->birthdate ? \Carbon\Carbon::parse($user->birthdate)->format('Y-m-d') : '1996-01-03' }}">
            </div>

            <button type="button" onclick="saveProfileInfo()" style="width:100%; background:#1877f2; color:#fff; border:none; border-radius:25px; padding:12px; font-size:16px; font-weight:700; cursor:pointer; box-shadow:0 4px 12px rgba(24,119,242,0.3); margin-top:10px;">Save Details 💾</button>
        </div>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function openEditProfileModal() {
            document.getElementById('editProfileModal').classList.add('active');
        }

        function closeEditProfileModal() {
            document.getElementById('editProfileModal').classList.remove('active');
        }

        function saveProfileInfo() {
            const data = {
                category: document.getElementById('editCategory').value.trim(),
                bio: document.getElementById('editBio').value.trim(),
                whatsapp: document.getElementById('editWhatsapp').value.trim(),
                phone: document.getElementById('editWhatsapp').value.trim(),
                hometown: document.getElementById('editHometown').value.trim(),
                work: document.getElementById('editWork').value.trim(),
                education: document.getElementById('editEducation').value.trim(),
                relationship_status: document.getElementById('editRelationship').value,
                birthdate: document.getElementById('editBirthdate').value
            };

            fetch('/user/profile/update-info', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(resData => {
                if (resData.status === 'success') {
                    alert('Profile details updated successfully!');
                    window.location.reload();
                } else {
                    alert(resData.message || 'Failed to update profile details.');
                }
            })
            .catch(err => alert('Error saving profile details.'));
        }

        function uploadPhoto(type) {
            const fileInput = document.getElementById(type + 'PhotoInput');
            if (fileInput && fileInput.files[0]) {
                const formData = new FormData();
                formData.append(type + '_photo', fileInput.files[0]);

                fetch('{{ route("user.profile.photos") }}', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        window.location.reload();
                    } else {
                        alert(data.message || 'Upload failed');
                    }
                });
            }
        }

        function toggleFollowUser(userId) {
            fetch('/user/' + userId + '/follow', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    const btnTxt = document.getElementById('followBtnTxt');
                    const btnIcon = document.getElementById('btnFollowUser').querySelector('i');
                    if (data.is_following) {
                        btnTxt.innerText = 'Following';
                        btnIcon.className = 'fa-solid fa-check';
                    } else {
                        btnTxt.innerText = 'Follow User';
                        btnIcon.className = 'fa-solid fa-user-plus';
                    }
                }
            });
        }
    </script>
</body>

</html>
