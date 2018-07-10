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
					<td>Edit | Delete</td>
				</tr>

			@endforeach

		</tbody>
	</table>

@endsection