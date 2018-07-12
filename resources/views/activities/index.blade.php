@extends('layouts.card')

@section('title')
	Manage Activities
@endsection

@section('content')

	<script>
		function toggleNewActivityForm() {
		    var x = document.getElementById("newActivityForm");
		    var t = document.getElementById("toggleText");
		    if (x.style.display === "none") {
		        x.style.display = "block";
		        t.innerHTML = "Hide New Activity Form";
		    } else {
		        x.style.display = "none";
		        t.innerHTML = "Show New Activity Form";
		    }
		}
	</script>

	<p><a id="toggleText" href="#" onclick="toggleNewActivityForm()">Show New Activity Form</a></p>

	<div id="newActivityForm" style="display: {{ $showForm ? 'block' : 'none' }};" class="p-3 m-3">
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
			<button class="btn btn-primary" type="submit">Create</button>
		</form>
	</div>

	<example-component :activities-data='{{ $activities->toJson() }}'></example-component>

@endsection