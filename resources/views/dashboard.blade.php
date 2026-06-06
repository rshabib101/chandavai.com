@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Admin Dashboard</h1>
@stop

@section('content')

<div class="row">

    <!-- Pending -->
    <div class="col-md-4">
        <a href="/admin/reports?status=pending" style="text-decoration:none; color:inherit;">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $pending }}</h3>
                    <p>Pending Reports</p>
                </div>
                <div class="icon">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- Approved -->
    <div class="col-md-4">
        <a href="/admin/reports?status=approved" style="text-decoration:none; color:inherit;">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $approved }}</h3>
                    <p>Approved Reports</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- Rejected -->
    <div class="col-md-4">
        <a href="/admin/reports?status=rejected" style="text-decoration:none; color:inherit;">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $rejected }}</h3>
                    <p>Rejected Reports</p>
                </div>
                <div class="icon">
                    <i class="fas fa-times"></i>
                </div>
            </div>
        </a>
    </div>
    <!-- Applications -->
    <div class="col-md-4">
        <a href="/admin/surveys" style="text-decoration:none; color:inherit;">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $applications }}</h3>
                    <p>Applications Submitted</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-alt"></i>
                </div>
            </div>
        </a>
    </div>

</div>

@stop