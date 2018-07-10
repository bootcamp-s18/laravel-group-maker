@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')

    @if (Auth::user()->is_admin)

        <h2>Admin Functions</h2>

        <ul>
            <li><a href="/activities">Manage Activities</a></li>
            <li><a href="/groups">Manage Groups</a></li>
        </ul>

    @endif

    <h2>Manage My Groups and Memberships</h2>

    <ul>
        <li><a href="#">Find a Group</a></li>
        <li><a href="/groups/create">Create a Group</a></li>
        <li><a href="#">Join a Private Group</a></li>
        <li><a href="#">Leave a Group</a></li>
    </ul>

@endsection
