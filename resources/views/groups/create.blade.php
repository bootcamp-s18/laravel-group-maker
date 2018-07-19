@extends('layouts.card')

@section('card-title')
	Create a New Group
@endsection

@section('card-body')

	<form method="post" action="/groups">
		@csrf

		<div class="form-group">
			<label for="name">Group Name</label>
			<input type="text" class="form-control" name="groupName" id="name" value="{{ old('groupName') }}">
		</div>

		<div class="form-group">
			<label for="description">Group Description</label>
			<textarea class="form-control" id="description" name="groupDescription" rows="3">{{ old('groupDescription') }}</textarea>
		</div>

		<div class="form-group">
			<label for="maxMembers">Maximum Number of Members</label>
			<input type="number" max="100" min="1" class="form-control" name="maxMembers" id="maxMembers" value="{{ old('maxMembers') }}">
		</div>

		<div class="form-group">
			<label for="activitySelect">Activity</label>
			<select class="form-control" id="activitySelect" name="activityId">

				@foreach ($activities as $activity)

					<option value="{{ $activity->id }}" {{ (old('activityId') == $activity->id) ? 'selected' : '' }}>{{ $activity->name }}</option>

				@endforeach

			</select>
		</div>

		<div class="form-group form-check">
			<input type="checkbox" class="form-check-input" id="isPrivateFlag" name="isPrivate" {{ old('isPrivate') ? 'checked' : '' }}>
			<label class="form-check-label" for="isPrivateFlag">This is a private group</label>
		</div>

		<div class="form-group form-check">
			<input type="checkbox" class="form-check-input" id="isAcceptingFlag" name="isAcceptingMembers" {{ old('isAcceptingMembers') ? 'checked' : '' }}>
			<label class="form-check-label" for="isAcceptingFlag">This group is accepting members</label>
		</div>

		<div class="form-group form-check">
			<input type="checkbox" class="form-check-input" id="isVirtualFlag" name="isVirtual" {{ old('isVirtual') ? 'checked' : '' }}>
			<label class="form-check-label" for="isVirtualFlag">This is a virtual group</label>
		</div>


		<a href="/activities" class="btn btn-secondary">Cancel</a>
		<button class="btn btn-primary" type="submit">Save</button>

	</form>

@endsection