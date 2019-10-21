@extends('layouts.app')
@section('content')
<div class="container">
    <a class="btn btn-success my-2"
       href="{{ url('/') }}">
        <i class="fas fa-long-arrow-alt-left"></i>
        Back
    </a>
    <div class="row">
        <div class="col-12">
            <form action="{{ route('profiles.update' , $profile->id) }}" method="POST" enctype="multipart/form-data" id="edit-profile">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $profile->name }}">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image">
                </div>
                <div class="form-group">
                    <label for="screen_name">Screen Name</label>
                    <input type="text" class="form-control" name="screen_name" id="screen_name" value="{{ $profile->screen_name }}">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input type="text" class="form-control" name="content" id="content" value="{{ $profile->content }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="10">{{ $profile->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="user_name">User Name</label>
                    <input type="text" class="form-control" name="user_name" id="user_name" value="{{ $profile->user_name }}">
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="text" class="form-control datepicker" name="date" value="{{ $profile->date }}">
                </div>
                <button class="btn btn-outline-primary float-right mt-5" type="submit">
                    Update
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $(document).ready(() => {
        $('.datepicker').datepicker();

        $('#edit-profile').validate({
            rules: {
                'name': 'required',
                'screen_name': 'required',
                'content': 'required',
                'description': 'required',
                'user_name': 'required',
                'date': 'required',
            },
        });
    });
</script>
@endpush
