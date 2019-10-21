@extends('layouts.app')
@section('content')
    <div class="container">
        <a class="btn btn-success my-2"
           href="{{ url('/') }}">
            <i class="fas fa-long-arrow-alt-left"></i>
            Back
        </a>
        <div class="card profilecard-bg mt-3 borderr-none">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <img src="{{ url( 'storage/' . $profile->image) }}" width="300" height="150">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="font-weight-bold f-19">
                            {{ $profile->name }}
                        </h3>
                        <p>{{ $profile->user_name }}</p>
                        <p class="profile-title">{{ $profile->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
