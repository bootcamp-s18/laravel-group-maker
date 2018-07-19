@extends('layouts.card')

@section('card-title')
	Manage Groups
@endsection

@section('card-body')

<groups-table :groups-data='{{ $groups->toJson() }}' :current-user-id="{{ Auth::user()->id }}"></groups-table>

@endsection