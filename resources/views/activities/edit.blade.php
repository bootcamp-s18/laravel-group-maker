@extends('layouts.card')

@section('title')
	Edit Activity
@endsection

@section('content')

	<form method="post" action="/activities/{{ $activity->id }}">
		@csrf
		{{ method_field('PATCH') }}

		<div class="form-group">
			<label for="name">Activity Name</label>
			<input type="text" class="form-control" name="activityName" id="name" value="{{ $activity->name }}">
		</div>

		<div class="form-group">
			<label for="description">Description</label>
			<textarea class="form-control" id="description" name="activityDescription" rows="3">{{ $activity->description }}</textarea>
		</div>

		<button class="btn btn-primary" type="submit">Save</button>

	</form>

@endsection