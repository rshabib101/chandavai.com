@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>👥 Users List</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body p-0">

        <table class="table table-striped">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Joined</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>

</div>

@stop