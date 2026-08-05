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
                            @if($user->isAdmin())
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
                            <form method="POST" action="{{ route('admin.user.toggle-role', $user->id) }}" style="display:inline-block; margin-right: 4px;" onsubmit="return confirm('Are you sure you want to change role for {{ $user->name }}?')">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $user->isAdmin() ? 'btn-warning' : 'btn-info' }}" {{ auth()->id() == $user->id ? 'disabled' : '' }}>
                                    <i class="fa {{ $user->isAdmin() ? 'fa-user' : 'fa-user-shield' }}"></i>
                                    {{ $user->isAdmin() ? 'Make User' : 'Make Admin' }}
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.user.toggle-block', $user->id) }}" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to {{ $user->is_blocked ? 'unblock' : 'block' }} this user?')">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $user->is_blocked ? 'btn-success' : 'btn-danger' }}">
                                    <i class="fa {{ $user->is_blocked ? 'fa-unlock' : 'fa-ban' }}"></i>
                                    {{ $user->is_blocked ? 'Unblock User' : 'Block User' }}
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