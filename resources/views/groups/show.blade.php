@extends('layouts.card')

@section('card-title')
	{{ $group->name }}
@endsection

@section('card-body')

<form>
  <div class="form-group row">
    <label for="description" class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-10">
      <textarea readonly class="form-control" id="description">{{ $group->description }}</textarea>
    </div>
  </div>
  <div class="form-group row">
    <label for="members" class="col-sm-2 col-form-label">Members</label>
    <div class="col-sm-10">
      <div class="form-control" id="members" readonly>
      	<ul>
			@foreach ($group->members as $member)
				<li>{{ $member->name }}</li>
			@endforeach
      	</ul>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="location" class="col-sm-2 col-form-label">Location</label>
    <div class="col-sm-10">
    	<iframe
		  width=" 600"
		  height="450"
		  frameborder="0" style="border:0"
		  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAVYNeyAbei1-bQXjju-T8kJqiZ_vEXJTc&q={{ $group->default_lat }},{{ $group->default_lon }}" allowfullscreen>
		</iframe>
    </div>
  </div>
</form>



@endsection 