@extends('adminlte::page')

@section('title', 'Work Tasks Management')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-briefcase text-primary mr-2"></i> Work Tasks & Submissions</h1>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addWorkModal">
            <i class="fas fa-plus-circle mr-1"></i> Add New Task
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

@if(session('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <i class="fas fa-info-circle mr-1"></i> {{ session('info') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- SUMMARY CARDS -->
<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-info">
            <span class="info-box-icon"><i class="fas fa-tasks"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Work Tasks</span>
                <span class="info-box-number">{{ $works->count() }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-warning">
            <span class="info-box-icon"><i class="fas fa-clock"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Pending Submissions</span>
                <span class="info-box-number">{{ $pendingCount }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-success">
            <span class="info-box-icon"><i class="fas fa-check-circle"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Approved Submissions</span>
                <span class="info-box-number">{{ $approvedCount }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-danger">
            <span class="info-box-icon"><i class="fas fa-times-circle"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Rejected Submissions</span>
                <span class="info-box-number">{{ $rejectedCount }}</span>
            </div>
        </div>
    </div>
</div>

<!-- SECTION 1: WORK TASKS LIST -->
<div class="card card-primary card-outline mb-4">
    <div class="card-header">
        <h3 class="card-title font-weight-bold"><i class="fas fa-list mr-1"></i> Active & Managed Tasks List</h3>
    </div>
    <div class="card-body p-0 table-responsive">
        <table class="table table-hover table-striped mb-0">
            <thead class="thead-light">
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th>Demo Image</th>
                    <th>Task Title</th>
                    <th>Category</th>
                    <th>Reward</th>
                    <th>Slots (Approved / Total)</th>
                    <th>Status</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($works as $work)
                <tr>
                    <td>{{ $work->id }}</td>
                    <td>
                        @if($work->demo_screenshot_url)
                            <img src="{{ $work->demo_screenshot_url }}" alt="Demo" class="img-thumbnail" style="height: 45px; width: 45px; object-fit: cover; cursor: pointer;" onclick="showImageModal('{{ $work->demo_screenshot_url }}')">
                        @else
                            <span class="badge badge-secondary">No Demo</span>
                        @endif
                    </td>
                    <td>
                        <strong class="text-dark">{{ $work->title }}</strong>
                        @if($work->task_link)
                            <div><a href="{{ $work->task_link }}" target="_blank" class="small text-primary"><i class="fas fa-external-link-alt"></i> {{ Str::limit($work->task_link, 30) }}</a></div>
                        @endif
                    </td>
                    <td><span class="badge badge-info">{{ $work->category }}</span></td>
                    <td><span class="badge badge-success font-weight-bold" style="font-size: 13px;">+{{ $work->reward_coins }} Pts</span></td>
                    <td>
                        <span class="badge badge-light border">
                            {{ $work->approved_submissions_count }} / {{ $work->total_slots }}
                        </span>
                        <div class="progress progress-xs mt-1" style="height: 6px;">
                            @php
                                $percent = min(100, $work->total_slots > 0 ? round(($work->approved_submissions_count / $work->total_slots) * 100) : 0);
                            @endphp
                            <div class="progress-bar bg-primary" style="width: {{ $percent }}%"></div>
                        </div>
                    </td>
                    <td>
                        <form action="{{ route('admin.tasks.work.toggle', $work->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-xs {{ $work->is_active ? 'btn-success' : 'btn-secondary' }}" title="Click to Toggle Status">
                                {{ $work->is_active ? 'Active' : 'Inactive' }}
                            </button>
                        </form>
                    </td>
                    <td class="text-right">
                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editWorkModal{{ $work->id }}">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <form action="{{ route('admin.tasks.work.destroy', $work->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this task?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- EDIT WORK MODAL -->
                <div class="modal fade" id="editWorkModal{{ $work->id }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form action="{{ route('admin.tasks.work.update', $work->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-header bg-info text-white">
                                    <h5 class="modal-title font-weight-bold"><i class="fas fa-edit"></i> Edit Work Task #{{ $work->id }}</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label>Task Title *</label>
                                            <input type="text" name="title" class="form-control" value="{{ $work->title }}" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Category *</label>
                                            <input type="text" name="category" class="form-control" value="{{ $work->category }}" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label>Reward Coins *</label>
                                            <input type="number" name="reward_coins" class="form-control" value="{{ $work->reward_coins }}" required min="1">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label>Total Slots / Limit *</label>
                                            <input type="number" name="total_slots" class="form-control" value="{{ $work->total_slots }}" required min="1">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label>Required Screenshots Count</label>
                                            <input type="number" name="required_proofs_count" class="form-control" value="{{ $work->required_proofs_count }}" required min="1" max="5">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Task Link (URL)</label>
                                        <input type="url" name="task_link" class="form-control" value="{{ $work->task_link }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Detailed Instructions (Bengali Step-by-Step)</label>
                                        <textarea name="instruction" class="form-control" rows="4">{{ $work->instruction }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Demo Screenshot Image</label>
                                        @if($work->demo_screenshot_url)
                                            <div class="mb-2">
                                                <img src="{{ $work->demo_screenshot_url }}" class="img-thumbnail" style="max-height: 100px;">
                                            </div>
                                        @endif
                                        <input type="file" name="demo_screenshot" class="form-control-file">
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="is_active" class="form-check-input" id="isActiveEdit{{ $work->id }}" {{ $work->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label font-weight-bold" for="isActiveEdit{{ $work->id }}">Task Is Active (Visible to users)</label>
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
                    <td colspan="8" class="text-center py-4 text-muted">No Work tasks created yet. Click "Add New Task" to create one.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- SECTION 2: USER SUBMISSIONS APPROVAL LIST -->
<div class="card card-warning card-outline">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title font-weight-bold m-0"><i class="fas fa-user-check mr-1"></i> User Submissions & Proof Approvals</h3>
        <div class="card-tools">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <a href="{{ route('admin.tasks.work') }}" class="btn btn-sm btn-outline-secondary {{ empty($statusFilter) ? 'active' : '' }}">All</a>
                <a href="{{ route('admin.tasks.work', ['status' => 'pending']) }}" class="btn btn-sm btn-outline-warning {{ $statusFilter==='pending' ? 'active' : '' }}">Pending ({{ $pendingCount }})</a>
                <a href="{{ route('admin.tasks.work', ['status' => 'approved']) }}" class="btn btn-sm btn-outline-success {{ $statusFilter==='approved' ? 'active' : '' }}">Approved ({{ $approvedCount }})</a>
                <a href="{{ route('admin.tasks.work', ['status' => 'rejected']) }}" class="btn btn-sm btn-outline-danger {{ $statusFilter==='rejected' ? 'active' : '' }}">Rejected ({{ $rejectedCount }})</a>
            </div>
        </div>
    </div>
    <div class="card-body p-0 table-responsive">
        <table class="table table-hover table-striped mb-0">
            <thead class="thead-light">
                <tr>
                    <th>Sub #</th>
                    <th>User Details</th>
                    <th>Work Title</th>
                    <th>Reward</th>
                    <th>Proof Screenshot</th>
                    <th>Submitted At</th>
                    <th>Status</th>
                    <th class="text-right">Approval Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($submissions as $sub)
                <tr>
                    <td>#{{ $sub->id }}</td>
                    <td>
                        <strong class="text-dark">{{ $sub->user ? $sub->user->name : 'Unknown User' }}</strong>
                        <div class="small text-muted">{{ $sub->user ? $sub->user->email : '' }}</div>
                    </td>
                    <td>
                        <strong>{{ $sub->microWork ? $sub->microWork->title : 'Deleted Work' }}</strong>
                    </td>
                    <td>
                        <span class="badge badge-success">+{{ $sub->microWork ? $sub->microWork->reward_coins : 0 }} Pts</span>
                    </td>
                    <td>
                        @if($sub->proof_screenshot_url)
                            <button type="button" class="btn btn-xs btn-outline-primary" onclick="showImageModal('{{ $sub->proof_screenshot_url }}')">
                                <i class="fas fa-image"></i> View Proof
                            </button>
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>
                        <span class="small text-muted">{{ $sub->created_at->format('M d, Y h:i A') }}</span>
                    </td>
                    <td>
                        @if($sub->status === 'pending')
                            <span class="badge badge-warning"><i class="fas fa-hourglass-half"></i> Pending</span>
                        @elseif($sub->status === 'approved')
                            <span class="badge badge-success"><i class="fas fa-check-circle"></i> Approved</span>
                        @else
                            <span class="badge badge-danger"><i class="fas fa-times-circle"></i> Rejected</span>
                            @if($sub->rejection_reason)
                                <div class="small text-danger">{{ $sub->rejection_reason }}</div>
                            @endif
                        @endif
                    </td>
                    <td class="text-right">
                        @if($sub->status === 'pending')
                            <form action="{{ route('admin.tasks.submission.approve', $sub->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success font-weight-bold" onclick="return confirm('Approve this submission and credit {{ $sub->microWork ? $sub->microWork->reward_coins : 0 }} coins to user?');">
                                    <i class="fas fa-check"></i> Approve
                                </button>
                            </form>

                            <button type="button" class="btn btn-sm btn-danger font-weight-bold" data-toggle="modal" data-target="#rejectModal{{ $sub->id }}">
                                <i class="fas fa-times"></i> Reject
                            </button>

                            <!-- REJECT REASON MODAL -->
                            <div class="modal fade text-left" id="rejectModal{{ $sub->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.tasks.submission.reject', $sub->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title"><i class="fas fa-times-circle"></i> Reject Submission #{{ $sub->id }}</h5>
                                                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Rejection Reason for User *</label>
                                                    <textarea name="rejection_reason" class="form-control" rows="3" required placeholder="উদাহরণ: প্রুফ স্ক্রিনশট পরিষ্কার নয় অথবা সিক্রেট কোড ভুল দেওয়া হয়েছে।"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger font-weight-bold">Confirm Reject</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <span class="small text-muted">Completed</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-4 text-muted">No user submissions found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ADD WORK MODAL -->
<div class="modal fade" id="addWorkModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.tasks.work.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold"><i class="fas fa-plus-circle"></i> Create New Work Task</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Task Title *</label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. MUKTO MONEY BD" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Category *</label>
                            <input type="text" name="category" class="form-control" placeholder="e.g. WEBSITE, TELEGRAM, FACEBOOK" value="WEBSITE" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Reward Coins *</label>
                            <input type="number" name="reward_coins" class="form-control" value="150" required min="1">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Total Slots / Limit *</label>
                            <input type="number" name="total_slots" class="form-control" value="20" required min="1">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Required Proof Screenshots</label>
                            <input type="number" name="required_proofs_count" class="form-control" value="1" required min="1" max="5">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Task Link (URL)</label>
                        <input type="url" name="task_link" class="form-control" placeholder="https://muktomoney.blogspot.com">
                    </div>
                    <div class="form-group">
                        <label>Detailed Instructions (Bengali Step-by-Step)</label>
                        <textarea name="instruction" class="form-control" rows="4" placeholder="প্রমাণ চাই: নির্দেশনা: ১. লিংকে যান..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>Demo Screenshot Image (Sample for user)</label>
                        <input type="file" name="demo_screenshot" class="form-control-file">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" id="isActiveAdd" checked>
                        <label class="form-check-label font-weight-bold" for="isActiveAdd">Active Immediately</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary font-weight-bold">Create Task</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- IMAGE LIGHTBOX MODAL -->
<div class="modal fade" id="imageLightboxModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-transparent border-0 shadow-none text-center">
            <div class="modal-body p-0">
                <img id="lightboxImage" src="" class="img-fluid rounded" style="max-height: 85vh; border: 3px solid #fff;">
            </div>
            <div class="mt-2">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close Preview</button>
            </div>
        </div>
    </div>
</div>

@stop

@section('js')
<script>
    function showImageModal(url) {
        $('#lightboxImage').attr('src', url);
        $('#imageLightboxModal').modal('show');
    }
</script>
@stop
