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

	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th># Groups</th>
				<th># Participants</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>

			@foreach ($activities as $activity)

				<tr>
					<td>{{ $activity->name }}</td>
					<td>{{ $activity->groups()->count() }}</td>
					<td>{{ $activity->participants() }}</td>
					<td>
						<div class="row">
							<div class="col-xs-auto">
								<button class="btn btn-sm"><a href="/activities/{{ $activity->id }}/edit"><i class="fas fa-pencil-alt text-info"></i></a></button>
							</div>
							<div class="col-xs-auto">
								<form method="post" action="/activities/{{ $activity->id }}">
									@csrf
									{{ method_field('DELETE') }}
									@if ($activity->groups()->count() > 0)
										<button class="btn btn-sm" type="button"><i class="far fa-trash-alt text-medium" disabled></i></button>
									@else
										<button class="btn btn-sm" type="submit"><i class="far fa-trash-alt text-danger"></i></button>
									@endif
								</form>
							</div>
						</div>
					</td>
				</tr>

			@endforeach

		</tbody>
	</table>

@endsection