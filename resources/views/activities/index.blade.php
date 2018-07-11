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
					<td>
						<form method="post" action="/activities/{{ $activity->id }}">
							<button class="btn btn-sm"><a href="/activities/{{ $activity->id }}/edit"><i class="fas fa-pencil-alt text-info"></i></a></button>
							@csrf
							{{ method_field('DELETE') }}

							@if ($activity->groups()->count() > 0)
								<button class="btn btn-sm" type="button"><i class="far fa-trash-alt text-medium" disabled></i></button>
							@else
								<button class="btn btn-sm" type="submit"><i class="far fa-trash-alt text-danger"></i></button>
							@endif

						</form>
					</td>
				</tr>

			@endforeach

		</tbody>
	</table>

@endsection