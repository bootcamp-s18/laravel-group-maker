@extends('layouts.card')

@section('card-title')
	Manage Groups
@endsection

@section('card-body')

@if (\Auth::user()->is_admin  || $settings->users_can_create_groups)
	<p><a href="/groups/create">Create a Group</a></p>
@endif

<groups-table purpose="manage" :groups-data='{{ $groups->toJson() }}' :current-user-id="{{ Auth::user()->id }}"></groups-table>

@endsection