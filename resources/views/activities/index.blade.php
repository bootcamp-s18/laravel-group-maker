@extends('layouts.app')

@section('title')
	Manage Activities
@endsection

@section('content')

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
					<td><a href="/activities/{{ $activity->id }}/edit"><i class="fas fa-pencil-alt"></i></a> 
						<form method="post" action="/activities/{{ $activity->id }}">
							@csrf
							{{ method_field('DELETE') }}
							<button class="btn" type="submit"><i class="fas fa-backspace"></i></button>
						</form>
					</td>
				</tr>

			@endforeach

		</tbody>
	</table>

@endsection