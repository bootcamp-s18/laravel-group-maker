@extends('layouts.card')

@section('card-title')
	Manage Groups
@endsection

@section('card-body')

<groups-table :groups-data='{{ $groups->toJson() }}'></groups-table>

@endsection