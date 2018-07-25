@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit My Profile</div>

                <div class="card-body">
                    <form method="POST" action="/profile">
                        @csrf

						<location-selector format="horizontal" lat="{{ Auth::user()->default_lat }}" lon="{{ Auth::user()->default_lon }}"></location-selector>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
								<a href="/home" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
