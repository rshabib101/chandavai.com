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

                    <!-- COIN TO TAKA CONVERSION RATE -->
                    <div class="form-group bg-light p-3 rounded border border-warning">
                        <label for="coins_per_taka" class="font-weight-bold text-dark">🪙 Coin to BDT (৳) Rate: Coins required for ৳1 Taka</label>
                        <div class="input-group">
                            <input type="number" step="0.1" name="coins_per_taka" id="coins_per_taka" class="form-control font-weight-bold" value="{{ $coinsPerTaka ?? 40 }}" min="0.1" required>
                            <div class="input-group-append">
                                <span class="input-group-text font-weight-bold">Coins = ৳1 BDT</span>
                            </div>
                        </div>
                        <small class="form-text text-muted">উদাহরণ: <strong>40</strong> দিলে ৪০টি কয়েনে ১ টাকা (যেমন: ৬০০ কয়েন = ৳১৫.০০ টাকা)।</small>
                    </div>

                    <!-- MIN CASHOUT COINS -->
                    <div class="form-group">
                        <label for="min_cashout_coins">💳 Minimum Coins Required for Cashout</label>
                        <div class="input-group">
                            <input type="number" name="min_cashout_coins" id="min_cashout_coins" class="form-control" value="{{ $minCashoutCoins ?? 600 }}" min="1" required>
                            <div class="input-group-append">
                                <span class="input-group-text">Coins</span>
                            </div>
                        </div>
                        <small class="form-text text-muted">ইউজার সর্বনিম্ন কত কয়েন জমলে ক্যাশআউট রিকোয়েস্ট করতে পারবে। ডিফল্ট: 600 Coins.</small>
                    </div>

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

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block font-weight-bold">
                        💾 Save Settings
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
