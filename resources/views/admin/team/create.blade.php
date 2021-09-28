@extends('admin.layout.app')

@section('sidebar')
    @include('admin.layout.sidebar')
@endsection

@section('page-title', '| Create team')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Create Member</h1>
        <form method="post" action="{{route('admin.team.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group col-6 mt-1 mb-1">
                <label for="name">Name</label>
                <input type="text" class="form-control mt-2" id="name" name="name" placeholder="Member Name">

                @error('name')
                <small class="alert-danger">{{$message}}</small>
                @enderror

            </div>
            <div class="form-group col-6 mt-1 mb-1">
                <label for="job">Job</label>
                <textarea class="form-control mt-2" id="job" name="job" rows="3"></textarea>

                @error('job')
                <small class="alert-danger">{{$message}}</small>
                @enderror

            </div>
            <div class="form-group col-6 mt-1 mb-1">
                <label for="photo">Photo</label>
                <input type="file" class="form-control mt-2" id="photo" name="photo" rows="3">

                @error('photo')
                <small class="alert-danger">{{$message}}</small>
                @enderror

            </div>

            <div class="form-group col-6 mt-1 mb-1">
                <label for="status">Status</label>
                <select class="form-select" name="status">
                    <option value="on">on</option>
                    <option value="off">off</option>
                </select>

                @error('status')
                <small class="alert-danger">{{$message}}</small>
                @enderror

            </div>
            <button class="btn btn-primary" type="submit">Create</button>
        </form>
    </div>
@endsection
