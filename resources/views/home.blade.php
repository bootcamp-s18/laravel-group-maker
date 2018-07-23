@extends('layouts.card')

@section('card-title')
    Home
@endsection

@section('card-body')

    @if (Auth::user()->is_admin)

        <h2>Admin Functions</h2>

        <ul>
            <li><a href="/settings">Manage Site Settings</a></li>
            <li><a href="/activities">Manage Activities</a></li>
        </ul>

    @endif

    <h2>My Groups</h2>
    <ul>
        @if (\Auth::user()->is_admin  || $settings->users_can_create_groups)
        <li><a href="/groups/create">Create a Group</a></li>
        @endif
        <li><a href="/groups">Manage Groups</a></li>
    </ul>


    <h2>My Memberships</h2>
    <ul>
        <li><a href="#">Find a Group</a></li>
        <li><a href="#">Join a Private Group</a></li>
        <li><a href="#">Leave a Group</a></li>
    </ul>

@endsection
