@extends('adminlte::page')

@section('title', 'Payment & Withdrawal Management')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>💸 Payment & Withdrawal Management</h1>
    </div>
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
        <strong>❌ Error!</strong> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- STATS SUMMARY CARDS -->
<div class="row">
    <div class="col-md-4">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>৳ {{ number_format($pendingBdt, 2) }}</h3>
                <p>পেন্ডিং পেমেন্ট রিকোয়েস্ট ({{ $pendingCount }} টি)</p>
            </div>
            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>
            <a href="{{ route('admin.withdrawals.index', ['status' => 'pending']) }}" class="small-box-footer">
                পেন্ডিং দেখুন <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-md-4">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>৳ {{ number_format($approvedBdt, 2) }}</h3>
                <p>মোট পরিশোধিত পেমেন্ট ({{ $approvedCount }} টি)</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <a href="{{ route('admin.withdrawals.index', ['status' => 'approved']) }}" class="small-box-footer">
                অনুমোদিত দেখুন <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-md-4">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $rejectedCount }}</h3>
                <p>বাতিলকৃত রিকোয়েস্ট</p>
            </div>
            <div class="icon">
                <i class="fas fa-times-circle"></i>
            </div>
            <a href="{{ route('admin.withdrawals.index', ['status' => 'rejected']) }}" class="small-box-footer">
                বাতিলকৃত দেখুন <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<!-- MAIN TABLE CARD -->
<div class="card card-outline card-primary">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">💳 উইথড্রল পেমেন্ট রিকোয়েস্ট তালিকা</h3>

        <!-- STATUS TAB FILTERS -->
        <div class="card-tools">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <a href="{{ route('admin.withdrawals.index', ['status' => 'pending']) }}" class="btn btn-sm {{ $statusFilter === 'pending' ? 'btn-warning active' : 'btn-outline-warning' }}">
                    ⏳ পেন্ডিং ({{ $pendingCount }})
                </a>
                <a href="{{ route('admin.withdrawals.index', ['status' => 'approved']) }}" class="btn btn-sm {{ $statusFilter === 'approved' ? 'btn-success active' : 'btn-outline-success' }}">
                    ✅ অনুমোদিত ({{ $approvedCount }})
                </a>
                <a href="{{ route('admin.withdrawals.index', ['status' => 'rejected']) }}" class="btn btn-sm {{ $statusFilter === 'rejected' ? 'btn-danger active' : 'btn-outline-danger' }}">
                    ❌ বাতিল ({{ $rejectedCount }})
                </a>
                <a href="{{ route('admin.withdrawals.index', ['status' => 'all']) }}" class="btn btn-sm {{ $statusFilter === 'all' ? 'btn-secondary active' : 'btn-outline-secondary' }}">
                    🌐 সব দেখুন
                </a>
            </div>
        </div>
    </div>

    <div class="card-body p-0 table-responsive">
        <table class="table table-hover table-striped mb-0 text-center">
            <thead class="thead-dark">
                <tr>
                    <th>#ID</th>
                    <th>ইউজার তথ্য</th>
                    <th>পেমেন্ট মেথড</th>
                    <th>অ্যাকাউন্ট নম্বর</th>
                    <th>কয়েন ও সমমান টাকা (BDT)</th>
                    <th>তারিখ ও সময়</th>
                    <th>স্ট্যাটাস</th>
                    <th>অ্যাকশন / নোট</th>
                </tr>
            </thead>
            <tbody>
                @forelse($withdrawals as $w)
                    <tr>
                        <td><strong>#{{ $w->id }}</strong></td>
                        <td class="text-left">
                            @if($w->user)
                                <div><strong>{{ $w->user->name }}</strong></div>
                                <div class="text-muted small">{{ $w->user->email }}</div>
                                <div class="text-muted small">📞 {{ $w->user->phone ?? 'N/A' }}</div>
                            @else
                                <span class="text-muted">Unknown User</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-pill badge-info px-3 py-2 font-weight-bold" style="font-size: 13px;">
                                {{ strtoupper($w->payment_method) }}
                            </span>
                        </td>
                        <td>
                            <code class="h6 font-weight-bold text-dark bg-light px-2 py-1 rounded" style="user-select: all;">
                                {{ $w->account_number }}
                            </code>
                        </td>
                        <td>
                            <div class="text-success font-weight-bold" style="font-size: 16px;">
                                ৳ {{ number_format($w->amount_bdt, 2) }}
                            </div>
                            <div class="text-muted small">🪙 {{ number_format($w->coins, 1) }} coins</div>
                        </td>
                        <td>
                            <div class="small">{{ $w->created_at->format('d M Y') }}</div>
                            <div class="text-muted small">{{ $w->created_at->format('h:i A') }}</div>
                        </td>
                        <td>
                            @if($w->status === 'pending')
                                <span class="badge badge-warning px-3 py-2" style="font-size: 12px;">⏳ পেন্ডিং</span>
                            @elseif($w->status === 'approved')
                                <span class="badge badge-success px-3 py-2" style="font-size: 12px;">✅ পরিশোধিত</span>
                            @else
                                <span class="badge badge-danger px-3 py-2" style="font-size: 12px;">❌ বাতিল</span>
                            @endif
                        </td>
                        <td>
                            @if($w->status === 'pending')
                                <button type="button" class="btn btn-sm btn-success font-weight-bold mr-1" onclick="openApproveModal({{ $w->id }}, '{{ $w->user ? addslashes($w->user->name) : 'User' }}', '{{ $w->payment_method }}', '{{ $w->account_number }}', '{{ number_format($w->amount_bdt, 2) }}')">
                                    <i class="fas fa-check"></i> ম্যানুয়ালি পে করুন & অ্যাপ্রুভ
                                </button>
                                <button type="button" class="btn btn-sm btn-danger font-weight-bold" onclick="openRejectModal({{ $w->id }}, '{{ $w->user ? addslashes($w->user->name) : 'User' }}', '{{ number_format($w->coins, 1) }}')">
                                    <i class="fas fa-times"></i> রিফান্ড সহ রিজেক্ট
                                </button>
                            @else
                                <small class="text-muted font-italic">{{ $w->admin_note ?? 'No notes' }}</small>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="py-5 text-muted">
                            <i class="fas fa-inbox fa-3x mb-3 text-secondary"></i>
                            <div>কোনো উইথড্রল রিকোয়েস্ট পাওয়া যায়নি।</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($withdrawals->hasPages())
        <div class="card-footer">
            {{ $withdrawals->appends(['status' => $statusFilter])->links() }}
        </div>
    @endif
</div>

<!-- APPROVE MODAL -->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="fas fa-check-circle"></i> পেমেন্ট অ্যাপ্রুভ করুন</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="approveForm" method="POST" action="">
                @csrf
                <div class="modal-body">
                    <p class="mb-2">আপনি <strong id="approveUserName"></strong>-এর ৳<span id="approveAmount"></span> টাকা উইথড্রল রিকোয়েস্ট অনুমোদন করছেন।</p>

                    <div class="alert alert-info py-2">
                        <strong>মেথড:</strong> <span id="approveMethod"></span> | 
                        <strong>নম্বর:</strong> <code id="approveAccount" class="text-dark font-weight-bold"></code>
                    </div>

                    <div class="form-group">
                        <label for="admin_note">ট্রানজেকশন আইডি / পেমেন্ট রেফারেন্স নোট (ঐচ্ছিক):</label>
                        <input type="text" name="admin_note" id="admin_note" class="form-control" placeholder="যেমন: bKash TrxID: 9X7A2B..." value="Paid via manual bKash transfer">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">বাতিল</button>
                    <button type="submit" class="btn btn-success font-weight-bold">
                        ✅ নিশ্চিত অ্যাপ্রুভ করুন
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- REJECT MODAL -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="fas fa-times-circle"></i> রিকোয়েস্ট বাতিল ও রিফান্ড করুন</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="rejectForm" method="POST" action="">
                @csrf
                <div class="modal-body">
                    <p class="mb-2">আপনি <strong id="rejectUserName"></strong>-এর রিকোয়েস্টটি বাতিল করছেন।</p>
                    <div class="alert alert-warning py-2">
                        💡 বাতিল করার সাথে সাথে ইউজারের কাটা যাওয়া <strong><span id="rejectCoins"></span> কয়েন</strong> অ্যাকাউন্টে রিফান্ড হয়ে যাবে।
                    </div>

                    <div class="form-group">
                        <label for="rejection_reason">বাতিলের কারণ (ইউজারকে দেখানো হবে):</label>
                        <textarea name="rejection_reason" id="rejection_reason" class="form-control" rows="3" placeholder="যেমন: ভুল বিকাশ নম্বর দেওয়া হয়েছে।" required>ভুল অ্যাকাউন্ট নম্বর দেওয়া হয়েছে। দয়া করে সঠিক নম্বর দিয়ে পুনরায় রিকোয়েস্ট দিন।</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ফিরে যান</button>
                    <button type="submit" class="btn btn-danger font-weight-bold">
                        ❌ রিকোয়েস্ট বাতিল & কয়েন রিফান্ড
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

@section('js')
<script>
    function openApproveModal(id, name, method, account, amount) {
        document.getElementById('approveUserName').innerText = name;
        document.getElementById('approveMethod').innerText = method;
        document.getElementById('approveAccount').innerText = account;
        document.getElementById('approveAmount').innerText = amount;
        document.getElementById('approveForm').action = '/admin/withdrawals/' + id + '/approve';
        $('#approveModal').modal('show');
    }

    function openRejectModal(id, name, coins) {
        document.getElementById('rejectUserName').innerText = name;
        document.getElementById('rejectCoins').innerText = coins;
        document.getElementById('rejectForm').action = '/admin/withdrawals/' + id + '/reject';
        $('#rejectModal').modal('show');
    }
</script>
@stop
