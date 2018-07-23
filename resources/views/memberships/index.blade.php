@extends('layouts.card')

@section('card-title')
	List of Open Games
@endsection

@section('card-body')

<groups-table purpose="join" :groups-data='{{ $groups->toJson() }}' :current-user-id="{{ Auth::user()->id }}"></groups-table>

@endsection