@extends('admin.layout.app')

@section('sidebar')
    @include('admin.layout.sidebar')
@endsection

@section('page-title', '| Edit Member')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Edit Member</h1>
        <form method="post" action="{{route('admin.team.update', ['team' => $member->id])}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="text" name="id" value="{{$member->id}}" hidden>
            <div class="form-group col-6 mt-1 mb-1">
                <label for="name">Name</label>
                <input type="text" class="form-control mt-2" id="name" name="name" value="{{$member->name}}" placeholder="Service Name">
            </div>

            @error('name')
                <small class="alert-danger">{{$message}}</small>
            @enderror

            <div class="form-group col-6 mt-1 mb-1">
                <label for="job">Job</label>
                <input type="text" class="form-control mt-2" id="job" name="job" rows="3" value="{{$member->job}}">
            </div>

            @error('job')
            <small class="alert-danger">{{$message}}</small>
            @enderror

            <div class="form-group col-6 mt-1 mb-1">
                <label for="photo">Photo</label>
                <input type="file" class="form-control mt-2" id="photo" name="photo" rows="3">
            </div>

            @error('photo')
            <small class="alert-danger">{{$message}}</small>
            @enderror
            <div class="form-group col-6 mt-1 mb-1">
                <label for="status">Status</label>
                <select class="form-select" name="status">
                    <option value="on" @if ($member->status == 'on') {{'selected'}} @endif>on</option>
                    <option value="off" @if ($member->status == 'off') {{'selected'}} @endif>off</option>
                </select>
            </div>

            @error('status')
            <small class="alert-danger">{{$message}}</small>
            @enderror

            <button class="btn btn-primary" type="submit">Update</button>
        </form>
    </div>
@endsection
