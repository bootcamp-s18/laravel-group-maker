@extends('layouts.card')

@section('card-title')
	List of Open Games
@endsection

@section('card-body')

<groups-table purpose="join" :current-users-groups='{{ json_encode($my_joined_groups) }}' :groups-data='{{ $groups->toJson() }}' :current-user-id="{{ Auth::user()->id }}"></groups-table>

@endsection