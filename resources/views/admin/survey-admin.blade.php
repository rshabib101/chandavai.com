@extends('adminlte::page')

@section('title', 'Reseller Surveys')

@section('content_header')
<h1>📝 Reseller Applications</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body table-responsive">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>District</th>
                    <th>Platform</th>
                    <th>Product</th>
                    <th>Package</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($surveys as $s)
                <tr>
                    <td>{{ $s->full_name }}</td>
                    <td>{{ $s->mobile }}</td>
                    <td>{{ $s->district }}</td>
                    <td>{{ $s->platform }}</td>
                    <td>{{ $s->product }}</td>
                    <td>{{ $s->package }}</td>

                    <td>
                        <a href="{{ route('survey.show', $s->id) }}" class="btn btn-info btn-sm">
                            View
                        </a>

                        <form action="{{ route('survey.delete', $s->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this?')">
                                Delete
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