@extends('layouts.card')

@section('card-title')
	Edit a Group
@endsection

@section('card-body')

	<form method="post" action="/groups/{{ $group->id }}">
		@csrf
		@method('PUT')

		<div class="form-group">
			<label for="name">Group Name</label>
			<input type="text" class="form-control" name="groupName" id="name" value="{{ $group->name }}">
		</div>

		<div class="form-group">
			<label for="description">Group Description</label>
			<textarea class="form-control" id="description" name="groupDescription" rows="3">{{ $group->description }}</textarea>
		</div>

		<div class="form-group">
			<label for="maxMembers">Maximum Number of Members</label>
			<input type="number" max="{{ $settings->max_group_members }}" min="{{ $settings->min_group_members }}" class="form-control" name="maxMembers" id="maxMembers" value="{{ $group->max_members }}">
		</div>

		<div class="form-group">
			<label for="activitySelect">Activity</label>
			<select class="form-control" id="activitySelect" name="activityId">

				@foreach ($activities as $activity)

					<option value="{{ $activity->id }}" {{ ($group->activity_id == $activity->id) ? 'selected' : '' }}>{{ $activity->name }}</option>

				@endforeach

			</select>
		</div>

		<div class="form-group form-check">
			<input type="checkbox" class="form-check-input" id="isPrivateFlag" name="isPrivate" {{ $group->is_private ? 'checked' : '' }}>
			<label class="form-check-label" for="isPrivateFlag">This is a private group</label>
		</div>

		<div class="form-group form-check">
			<input type="checkbox" class="form-check-input" id="isAcceptingFlag" name="isAcceptingMembers" {{ $group->is_accepting_members ? 'checked' : '' }}>
			<label class="form-check-label" for="isAcceptingFlag">This group is accepting members</label>
		</div>

		<div class="form-group form-check">
			<input type="checkbox" class="form-check-input" id="isVirtualFlag" name="isVirtual" {{ $group->is_virtual ? 'checked' : '' }}>
			<label class="form-check-label" for="isVirtualFlag">This is a virtual group</label>
		</div>

		<location-selector format="vertical" lat="{{ $group->default_lat }}" lon="{{ $group->default_lon }}"></location-selector>

		<a href="/groups" class="btn btn-secondary">Cancel</a>
		<button class="btn btn-primary" type="submit">Save</button>

	</form>

@endsection