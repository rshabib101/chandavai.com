@extends('adminlte::page')

@section('title', 'Admin Reports')

@section('content_header')
    <h1>📋 Admin Reports</h1>
@stop

@section('content')

<div class="row">

@foreach($reports as $report)

    <div class="col-md-6">

        <div class="card card-outline 
            @if($report->status == 'approved') card-success
            @elseif($report->status == 'rejected') card-danger
            @else card-warning @endif
        ">

            <div class="card-header">
                <h3 class="card-title">
                    {{ $report->title }}
                </h3>

                <div class="card-tools">
                    <span class="badge 
                        @if($report->status == 'approved') bg-success
                        @elseif($report->status == 'rejected') bg-danger
                        @else bg-warning @endif
                    ">
                        {{ strtoupper($report->status) }}
                    </span>
                </div>
            </div>

            <div class="card-body">

                <p>{{ $report->description }}</p>


                            <!-- Image -->
            @if($report->image)
                <img src="{{ asset('storage/'.$report->image) }}"
                     style="width:250px; height:200px; border-radius:10px; margin-bottom:10px;">
            @endif

                <p>
                    <i class="fas fa-map-marker-alt"></i>
                    {{ $report->location }}
                </p>

                <p>
                    <i class="fas fa-tags"></i>
                    {{ $report->category }}
                </p>

            </div>

            <div class="card-footer">

                <a href="/admin/report/approve/{{ $report->id }}"
                   class="btn btn-success btn-sm">
                    ✔ Approve
                </a>

                <a href="/admin/report/reject/{{ $report->id }}"
                   class="btn btn-danger btn-sm">
                    ✖ Reject
                </a>

            </div>

        </div>

    </div>

@endforeach

</div>

@stop