@extends('layouts.app')
@section('content')
<div class="container">
    <a class="btn btn-success my-2"
       href="{{route('profiles.create')}}">
        <i class="fas fa-user-plus"></i>
        Add New Profile
    </a>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>image</th>
                <th>User Name</th>
                <th>Date</th>
                <td><i class="fas fa-user-cog fa-2x"></i></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($profiles as  $profile)
                <tr>
                    <td><img src="{{ url( 'storage/' . $profile->image) }}"  width="50" height="50"/></td>
                    <td>{{ $profile->user_name }}</td>
                    <td>{{$profile->date}}</td>
                    <td>
                        <a href="{{ route('profiles.show', $profile->id) }}"
                           class="btn btn-success btn-circle btn-sm"><i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('profiles.edit', $profile->id) }}"
                           class="btn btn-primary btn-circle btn-sm"><i class="fas fa-edit"></i>
                        </a>
                        <a onclick="deleteProfile('{{ 'delete-profile-' . $profile->id }}')"
                           href="javascript:;" class="btn btn-danger btn-circle btn-sm"
                           title="delete">
                            <i class="fas fa-trash"></i>
                        </a>
                        <!-- Form Delete profile -->
                        <form
                            action="{{ route('profiles.destroy', $profile->id) }}"
                            method="POST"
                            id="{{ 'delete-profile-' . $profile->id }}">
                            @csrf
                            @method('DELETE')
                        </form>
                        <!-- End Delete profile -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@push('js')
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable();
    });
    function deleteProfile(id) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure to delete this profile ?',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Delete'
        }).then(function(result){
            if (result.value) {
                $('#' + id).submit();
                swal('Profile successfully deleted', {
                    icon: 'success',
                });
            } else if (result.dismiss === 'cancel') {
                swal.fire(
                    'Cancel Delete',
                    'Do not worry',
                    'error',
                );
            }
        });
    }
</script>
@endpush
    
