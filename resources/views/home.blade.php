@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Home</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    @if (Auth::user()->is_admin)

                        You are an admin!

                    @else

                        You are not an admin!

                    @endif


                    <p><a href="/groups/create">Create a group</a></p>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
