@extends('adminlte::page')

@section('title', 'Monetization & Challenge Settings')

@section('content_header')
    <h1>⚙️ Monetization & Daily Challenge Settings</h1>
@stop

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>✅ Success!</strong> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="row">

    <!-- SETTINGS FORM CARD -->
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">💰 Income & Challenge Configuration</h3>
            </div>

            <form method="POST" action="{{ route('admin.settings.update') }}">
                @csrf
                <div class="card-body">

                    <!-- MIN FOLLOWERS FOR INCOME -->
                    <div class="form-group">
                        <label for="min_followers_for_income">👥 Minimum Followers Required to Start Earning Income</label>
                        <div class="input-group">
                            <input type="number" name="min_followers_for_income" id="min_followers_for_income" class="form-control" value="{{ $minFollowers }}" min="1" required>
                            <div class="input-group-append">
                                <span class="input-group-text">Followers</span>
                            </div>
                        </div>
                        <small class="form-text text-muted">Users must reach this follower count to unlock income monetization. Default: 20 followers.</small>
                    </div>

                    <!-- DAILY CHALLENGE REWARD POINTS -->
                    <div class="form-group">
                        <label for="daily_challenge_reward_points">🎁 Daily Challenge Reward Points</label>
                        <div class="input-group">
                            <input type="number" name="daily_challenge_reward_points" id="daily_challenge_reward_points" class="form-control" value="{{ $rewardPoints }}" min="1" required>
                            <div class="input-group-append">
                                <span class="input-group-text">Points</span>
                            </div>
                        </div>
                        <small class="form-text text-muted">Points awarded when completing all 4 daily challenge tasks. Default: 100 points.</small>
                    </div>

                    <!-- MONTHLY REFERRAL REWARD -->
                    <div class="form-group">
                        <label for="monthly_referral_reward">🏆 Monthly Top Referral Reward (BDT ৳)</label>
                        <div class="input-group">
                            <input type="number" name="monthly_referral_reward" id="monthly_referral_reward" class="form-control" value="{{ $monthlyReferralReward ?? 1000 }}" min="0" required>
                            <div class="input-group-append">
                                <span class="input-group-text">BDT ৳</span>
                            </div>
                        </div>
                        <small class="form-text text-muted">Reward money awarded to top monthly referrer. Default: 1000 Taka.</small>
                    </div>

                    <hr>
                    <h5 class="font-weight-bold text-dark mt-3">📢 Ad Script Manager (Google Ads / Adsterra)</h5>

                    <!-- HEAD AD SCRIPT -->
                    <div class="form-group">
                        <label for="ad_script_head">1. Header Ad Script (&lt;head&gt; section)</label>
                        <textarea name="ad_script_head" id="ad_script_head" class="form-control" rows="3" placeholder="Paste Google Adsense or Adsterra head script here...">{{ $adScriptHead ?? '' }}</textarea>
                        <small class="form-text text-muted">Executed inside &lt;head&gt; element of every page.</small>
                    </div>

                    <!-- IN-FEED AD SCRIPT -->
                    <div class="form-group">
                        <label for="ad_script_feed">2. In-Feed Ad Script (Home Feed Posts)</label>
                        <textarea name="ad_script_feed" id="ad_script_feed" class="form-control" rows="3" placeholder="Paste In-Feed Ad HTML/JS code here...">{{ $adScriptFeed ?? '' }}</textarea>
                        <small class="form-text text-muted">Rendered between posts in the home feed.</small>
                    </div>

                    <!-- SIDEBAR AD SCRIPT -->
                    <div class="form-group">
                        <label for="ad_script_sidebar">3. Sidebar Ad Script (Sidebar Widget)</label>
                        <textarea name="ad_script_sidebar" id="ad_script_sidebar" class="form-control" rows="3" placeholder="Paste Sidebar Ad HTML/JS code here...">{{ $adScriptSidebar ?? '' }}</textarea>
                        <small class="form-text text-muted">Rendered inside sidebar widget box.</small>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block font-weight-bold">
                        💾 Save Settings & Ad Scripts
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- DAILY CHALLENGE INFO CARD -->
    <div class="col-md-6">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">📋 Active Daily Challenge Requirements</h3>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>📝 <strong>3 Posts Created Today</strong></span>
                        <span class="badge badge-primary badge-pill">3 Posts</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>👥 <strong>10 Followers Required</strong></span>
                        <span class="badge badge-primary badge-pill">10 Followers</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>➕ <strong>20 Users Followed</strong></span>
                        <span class="badge badge-primary badge-pill">20 Following</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>❤️ <strong>100 Post Likes Today</strong></span>
                        <span class="badge badge-primary badge-pill">100 Likes</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-light">
                        <span>🏆 <strong>Reward Upon Completion</strong></span>
                        <span class="badge badge-success badge-pill font-weight-bold" style="font-size:14px;">{{ $rewardPoints }} Points</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>

<!-- USERS MONETIZATION STATUS TABLE -->
<div class="card card-outline card-secondary mt-3">
    <div class="card-header">
        <h3 class="card-title">👥 Users Income & Monetization Status Overview</h3>
    </div>

    <div class="card-body p-0 table-responsive">
        <table class="table table-hover table-striped mb-0">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Followers</th>
                    <th>Following</th>
                    <th>Points Balance</th>
                    <th>Income Eligibility</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                @php
                    $isMonetized = $u->followers_count >= $minFollowers;
                @endphp
                <tr>
                    <td>#{{ $u->id }}</td>
                    <td><strong>{{ $u->name }}</strong></td>
                    <td>{{ $u->email }}</td>
                    <td><span class="badge badge-info">{{ $u->followers_count }} Followers</span></td>
                    <td><span class="badge badge-secondary">{{ $u->following_count }} Following</span></td>
                    <td><strong class="text-success">{{ $u->points }} Pts</strong></td>
                    <td>
                        @if($u->is_blocked)
                            <span class="badge badge-danger px-2 py-1"><i class="fa fa-ban"></i> Account Blocked</span>
                        @elseif($isMonetized)
                            <span class="badge badge-success px-2 py-1"><i class="fa fa-check-circle"></i> Income Eligible</span>
                        @else
                            <span class="badge badge-warning px-2 py-1"><i class="fa fa-lock"></i> Locked (Need {{ max(0, $minFollowers - $u->followers_count) }} more followers)</span>
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.user.toggle-block', $u->id) }}" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to {{ $u->is_blocked ? 'unblock' : 'block' }} this user?')">
                            @csrf
                            <button type="submit" class="btn btn-xs {{ $u->is_blocked ? 'btn-success' : 'btn-danger' }}">
                                <i class="fa {{ $u->is_blocked ? 'fa-unlock' : 'fa-ban' }}"></i>
                                {{ $u->is_blocked ? 'Unblock' : 'Block' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop
