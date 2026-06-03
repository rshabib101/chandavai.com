@extends('adminlte::page')

@section('title', 'Survey Details')

@section('content_header')
<h1>📄 Application Details</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th>Name</th>
                <td>{{ $survey->full_name }}</td>
            </tr>
            <tr>
                <th>Mobile</th>
                <td>{{ $survey->mobile }}</td>
            </tr>
            <tr>
                <th>Facebook</th>
                <td>{{ $survey->facebook }}</td>
            </tr>
            <tr>
                <th>District</th>
                <td>{{ $survey->district }}</td>
            </tr>
            <tr>
                <th>Profession</th>
                <td>{{ $survey->profession }}</td>
            </tr>
            <tr>
                <th>Business Before</th>
                <td>{{ $survey->business_before }}</td>
            </tr>
            <tr>
                <th>Platform</th>
                <td>{{ $survey->platform }}</td>
            </tr>
            <tr>
                <th>Product</th>
                <td>{{ $survey->product }}</td>
            </tr>
            <tr>
                <th>Monthly Target</th>
                <td>{{ $survey->monthly_target }}</td>
            </tr>
            <tr>
                <th>Stock Type</th>
                <td>{{ $survey->stock_type }}</td>
            </tr>
            <tr>
                <th>Package</th>
                <td>{{ $survey->package }}</td>
            </tr>
            <tr>
                <th>Reason</th>
                <td>{{ $survey->reason }}</td>
            </tr>
            <tr>
                <th>Agreement</th>
                <td>{{ $survey->agreement ? 'Yes' : 'No' }}</td>
            </tr>

        </table>

        <a href="{{ url()->previous() }}" class="btn btn-secondary">
            ← Back
        </a>

    </div>
</div>

@stop