@extends('adminlte::page')

@section('title', 'Users Management')

@section('content_header')
    <h1>👥 Users Management</h1>
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

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>⚠️ Error!</strong> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card">
    <div class="card-body p-0 table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Points</th>
                    <th>Status</th>
                    <th>Joined</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>#{{ $user->id }}</td>
                        <td><strong>{{ $user->name }}</strong></td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->isCreatorAdmin())
                                <span class="badge badge-warning px-2 py-1"><i class="fa fa-crown"></i> Creator Admin</span>
                            @elseif($user->role === 'advertiser')
                                <span class="badge badge-info px-2 py-1"><i class="fa fa-rectangle-ad"></i> Advertiser</span>
                            @elseif($user->isAdmin())
                                <span class="badge badge-primary px-2 py-1"><i class="fa fa-user-shield"></i> Admin</span>
                            @else
                                <span class="badge badge-secondary px-2 py-1"><i class="fa fa-user"></i> User</span>
                            @endif
                        </td>
                        <td><span class="badge badge-success font-weight-bold">{{ $user->points }} Pts</span></td>
                        <td>
                            @if($user->is_blocked)
                                <span class="badge badge-danger px-2 py-1"><i class="fa fa-ban"></i> Blocked</span>
                            @else
                                <span class="badge badge-success px-2 py-1"><i class="fa fa-check-circle"></i> Active</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at ? $user->created_at->format('d M Y') : 'N/A' }}</td>
                        <td>
                            @if(auth()->user()->isCreatorAdmin())
                                {{-- Creator Admin Full Privileges --}}
                                <div class="btn-group mr-1" style="display:inline-block;">
                                    <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" {{ auth()->id() == $user->id ? 'disabled' : '' }}>
                                        <i class="fa fa-user-cog"></i> Role
                                    </button>
                                    <div class="dropdown-menu">
                                        <form method="POST" action="{{ route('admin.user.toggle-role', $user->id) }}">
                                            @csrf
                                            <input type="hidden" name="role" value="user">
                                            <button type="submit" class="dropdown-item {{ $user->role === 'user' || empty($user->role) ? 'active' : '' }}">
                                                <i class="fa fa-user text-secondary mr-2"></i> Make User
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.user.toggle-role', $user->id) }}">
                                            @csrf
                                            <input type="hidden" name="role" value="advertiser">
                                            <button type="submit" class="dropdown-item {{ $user->role === 'advertiser' ? 'active' : '' }}">
                                                <i class="fa fa-rectangle-ad text-info mr-2"></i> Make Advertiser
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.user.toggle-role', $user->id) }}">
                                            @csrf
                                            <input type="hidden" name="role" value="admin">
                                            <button type="submit" class="dropdown-item {{ $user->role === 'admin' ? 'active' : '' }}">
                                                <i class="fa fa-user-shield text-primary mr-2"></i> Make Admin
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.user.toggle-role', $user->id) }}">
                                            @csrf
                                            <input type="hidden" name="role" value="creator_admin">
                                            <button type="submit" class="dropdown-item {{ $user->isCreatorAdmin() ? 'active' : '' }}">
                                                <i class="fa fa-crown text-warning mr-2"></i> Make Creator Admin
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <form method="POST" action="{{ route('admin.user.toggle-block', $user->id) }}" style="display:inline-block; margin-right: 4px;" onsubmit="return confirm('Are you sure you want to {{ $user->is_blocked ? 'unblock' : 'block' }} this user?')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $user->is_blocked ? 'btn-success' : 'btn-danger' }}" {{ auth()->id() == $user->id ? 'disabled' : '' }}>
                                        <i class="fa {{ $user->is_blocked ? 'fa-unlock' : 'fa-ban' }}"></i>
                                        {{ $user->is_blocked ? 'Unblock' : 'Block' }}
                                    </button>
                                </form>

                                {{-- Device Control Modal Button (Only Creator Admin) --}}
                                <button type="button" class="btn btn-sm btn-dark btn-control-modal"
                                    data-name="{{ $user->name }}"
                                    data-ip="{{ $user->last_ip_address ?? 'N/A' }}"
                                    data-country="{{ $user->country ?? 'N/A' }}"
                                    data-city="{{ $user->city ?? 'N/A' }}"
                                    data-browser="{{ $user->browser ?? 'N/A' }}"
                                    data-os="{{ $user->operating_system ?? 'N/A' }}"
                                    data-resolution="{{ $user->screen_resolution ?? 'N/A' }}"
                                    data-language="{{ $user->language ?? 'N/A' }}"
                                    data-timezone="{{ $user->timezone ?? 'N/A' }}"
                                    data-referrer="{{ $user->referrer ?? 'N/A' }}"
                                    data-device="{{ $user->device_type ?? 'N/A' }}">
                                    <i class="fa fa-sliders-h"></i> Control
                                </button>

                                {{-- Live Camera Verification Request Button --}}
                                <button type="button" class="btn btn-sm btn-info ml-1" onclick="requestUserCamera('{{ $user->id }}', '{{ $user->name }}')" title="Request Camera Verification">
                                    <i class="fa fa-video"></i> Camera
                                </button>
                            @else
                                {{-- Standard Admin Restricted Note --}}
                                <span class="badge badge-light border text-muted" title="Only Creator Admin has permission for user actions">
                                    <i class="fa fa-lock"></i> Restricted (Creator Admin Only)
                                </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- User Control Modal -->
<div class="modal fade" id="userControlModal" tabindex="-1" role="dialog" aria-labelledby="userControlModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="userControlModalLabel">
                    <i class="fa fa-sliders-h mr-2"></i> User Control & Device Info - <span id="ctrl-user-name" class="text-warning"></span>
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped m-0">
                        <tbody>
                            <tr>
                                <th style="width: 35%;"><i class="fa fa-network-wired text-info mr-2"></i> IP Address</th>
                                <td><span id="ctrl-ip" class="badge badge-secondary p-2 font-mono"></span></td>
                            </tr>
                            <tr>
                                <th><i class="fa fa-globe text-success mr-2"></i> Country</th>
                                <td id="ctrl-country" class="font-weight-bold"></td>
                            </tr>
                            <tr>
                                <th><i class="fa fa-city text-primary mr-2"></i> City (আনুমানিক)</th>
                                <td id="ctrl-city"></td>
                            </tr>
                            <tr>
                                <th><i class="fa fa-compass text-warning mr-2"></i> Browser</th>
                                <td id="ctrl-browser"></td>
                            </tr>
                            <tr>
                                <th><i class="fa fa-desktop text-secondary mr-2"></i> Operating System</th>
                                <td id="ctrl-os"></td>
                            </tr>
                            <tr>
                                <th><i class="fa fa-tv text-purple mr-2"></i> Screen Resolution</th>
                                <td id="ctrl-resolution"></td>
                            </tr>
                            <tr>
                                <th><i class="fa fa-language text-info mr-2"></i> Language</th>
                                <td id="ctrl-language"></td>
                            </tr>
                            <tr>
                                <th><i class="fa fa-clock text-danger mr-2"></i> Timezone</th>
                                <td id="ctrl-timezone"></td>
                            </tr>
                            <tr>
                                <th><i class="fa fa-link text-muted mr-2"></i> Referrer</th>
                                <td><span id="ctrl-referrer" class="text-break"></span></td>
                            </tr>
                            <tr>
                                <th><i class="fa fa-mobile-alt text-success mr-2"></i> Device Type</th>
                                <td><span id="ctrl-device" class="badge badge-info p-1"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@stop

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('.btn-control-modal').on('click', function () {
            var btn = $(this);
            $('#ctrl-user-name').text(btn.data('name'));
            $('#ctrl-ip').text(btn.data('ip'));
            $('#ctrl-country').text(btn.data('country'));
            $('#ctrl-city').text(btn.data('city'));
            $('#ctrl-browser').text(btn.data('browser'));
            $('#ctrl-os').text(btn.data('os'));
            $('#ctrl-resolution').text(btn.data('resolution'));
            $('#ctrl-language').text(btn.data('language'));
            $('#ctrl-timezone').text(btn.data('timezone'));
            $('#ctrl-referrer').text(btn.data('referrer'));
            $('#ctrl-device').text(btn.data('device'));

            $('#userControlModal').modal('show');
        });
    });

    function requestUserCamera(userId, userName) {
        if (confirm('Send a Live Camera Verification Request to ' + userName + '?')) {
            fetch('/chat/call/signal', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    receiver_id: userId,
                    action: 'initiate',
                    type: 'video'
                })
            })
            .then(res => res.json())
            .then(data => {
                alert('Live Camera Verification Request sent successfully to ' + userName + '!');
            })
            .catch(err => alert('Failed to send camera request'));
        }
    }
</script>
@stop