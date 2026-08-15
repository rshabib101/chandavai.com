@extends('adminlte::page')

@section('title', 'Link Hits Management')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-link text-warning mr-2"></i> Link Hits Management</h1>
        <button type="button" class="btn btn-warning text-dark font-weight-bold" data-toggle="modal" data-target="#addLinkModal">
            <i class="fas fa-plus-circle mr-1"></i> Add New Link Hit
        </button>
    </div>
@stop

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card card-warning card-outline mb-4">
    <div class="card-header">
        <h3 class="card-title font-weight-bold"><i class="fas fa-globe mr-1"></i> Active Link Hits</h3>
    </div>
    <div class="card-body p-0 table-responsive">
        <table class="table table-hover table-striped mb-0">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Target URL</th>
                    <th>Reward Points</th>
                    <th>Timer (Seconds)</th>
                    <th>Status</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($linkHits as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td><strong>{{ $item->title }}</strong></td>
                    <td><a href="{{ $item->url }}" target="_blank" class="text-primary"><i class="fas fa-external-link-alt"></i> {{ $item->url }}</a></td>
                    <td><span class="badge badge-success">+{{ $item->reward_points }} Pts</span></td>
                    <td><span class="badge badge-info">{{ $item->timer_seconds }}s</span></td>
                    <td>
                        <form action="{{ route('admin.tasks.link-hits.toggle', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-xs {{ $item->is_active ? 'btn-success' : 'btn-secondary' }}">
                                {{ $item->is_active ? 'Active' : 'Inactive' }}
                            </button>
                        </form>
                    </td>
                    <td class="text-right">
                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editLinkModal{{ $item->id }}">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <form action="{{ route('admin.tasks.link-hits.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this link hit?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- EDIT LINK MODAL -->
                <div class="modal fade" id="editLinkModal{{ $item->id }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="{{ route('admin.tasks.link-hits.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header bg-info text-white">
                                    <h5 class="modal-title font-weight-bold">Edit Link Hit #{{ $item->id }}</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Link Title *</label>
                                        <input type="text" name="title" class="form-control" value="{{ $item->title }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Target URL *</label>
                                        <input type="url" name="url" class="form-control" value="{{ $item->url }}" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 form-group">
                                            <label>Reward Points *</label>
                                            <input type="number" name="reward_points" class="form-control" value="{{ $item->reward_points }}" required min="1">
                                        </div>
                                        <div class="col-6 form-group">
                                            <label>Timer Seconds *</label>
                                            <input type="number" name="timer_seconds" class="form-control" value="{{ $item->timer_seconds }}" required min="1" max="120">
                                        </div>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="is_active" class="form-check-input" id="isLinkActive{{ $item->id }}" {{ $item->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label font-weight-bold" for="isLinkActive{{ $item->id }}">Active</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-info font-weight-bold">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">No Link Hits created yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ADD LINK MODAL -->
<div class="modal fade" id="addLinkModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.tasks.link-hits.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title font-weight-bold"><i class="fas fa-plus-circle"></i> Create New Link Hit</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Link Title *</label>
                        <input type="text" name="title" class="form-control" placeholder="e.g. Chanda Vai Store Offer" required>
                    </div>
                    <div class="form-group">
                        <label>Target URL *</label>
                        <input type="url" name="url" class="form-control" placeholder="https://chandavai.com/shop" required>
                    </div>
                    <div class="row">
                        <div class="col-6 form-group">
                            <label>Reward Points *</label>
                            <input type="number" name="reward_points" class="form-control" value="20" required min="1">
                        </div>
                        <div class="col-6 form-group">
                            <label>Timer Seconds *</label>
                            <input type="number" name="timer_seconds" class="form-control" value="10" required min="1" max="120">
                        </div>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" id="isLinkActiveAdd" checked>
                        <label class="form-check-label font-weight-bold" for="isLinkActiveAdd">Active</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning text-dark font-weight-bold">Create Link Hit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
