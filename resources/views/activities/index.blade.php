@extends('layouts.card')

@section('card-title')
	Manage Activities
@endsection

@section('card-body')

	<div id="newActivityForm">
		<form class="pb-4" method="post" action="/activities">
			@csrf
			<div class="form-group">
				<label for="name">Activity Name</label>
				<input type="text" class="form-control" name="activityName" id="name">
			</div>
			<div class="form-group">
				<label for="description">Activity Description</label>
				<textarea class="form-control" id="description" name="activityDescription" rows="3"></textarea>
			</div>
			<button class="btn btn-secondary" type="reset">Clear Form</button>
			<button class="btn btn-primary" type="submit">Create a New Activity</button>
		</form>
	</div>

	<activities-table :activities-data='{{ $activities->toJson() }}'></activities-table>

@endsection