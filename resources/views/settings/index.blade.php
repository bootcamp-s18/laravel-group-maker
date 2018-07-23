@extends('layouts.card')

@section('card-title')
	Site Settings
@endsection

@section('card-body')
	
	<form method="post" action="/settings{{ $settings->id ? '/' . $settings->id : ''}}">
		@csrf
		@if($settings->id)
			@method('PATCH')
		@endif		

		<div class="form-group">
			<label for="websiteName">Website Name</label>
			<input type="text" class="form-control" id="websiteName" name="websiteName" value="{{ $settings->website_name }}">
		</div>

		<div class="form-group">
			<label for="websiteDescription">Website Description</label>
			<textarea class="form-control" id="websiteDescription" name="websiteDescription">{{ $settings->website_description }}</textarea>
		</div>

		<div class="form-group form-check">
			<input type="checkbox" class="form-check-input" id="usersCanCreateGroups" name="usersCanCreateGroups" {{ $settings->users_can_create_groups ? 'checked' : '' }}>
			<label for="usersCanCreateGroups" class="form-check-label">Check this box if users can create groups</label>
		</div>

		<div class="form-group">
			<label for="maxMembers">Maximum Members per Group</label>
			<input type="number" min=0 class="form-control" id="maxMembers" name="maxMembers" value="{{ $settings->max_group_members }}">
		</div>

		<div class="form-group">
			<label for="minMembers">Minimum Members per Group</label>
			<input type="number" min=0 class="form-control" id="minMembers" name="minMembers" value="{{ $settings->min_group_members }}">
		</div>

		<button type="submit" class="btn btn-primary">Save</button>

	</form>

@endsection