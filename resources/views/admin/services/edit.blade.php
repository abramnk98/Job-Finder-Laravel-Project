@extends('admin.layout.app')

@section('sidebar')
    @include('admin.layout.sidebar')
@endsection

@section('page-title', '| Edit Service')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Create Service</h1>
        <form method="post" action="{{route('admin.services.update', ['service' => $service->id])}}">
            @csrf
            @method('PUT')
            <input type="text" name="id" value="{{$service->id}}" hidden>
            <div class="form-group col-6 mt-1 mb-1">
                <label for="name">Name</label>
                <input type="text" class="form-control mt-2" id="name" name="name" value="{{$service->name}}" placeholder="Service Name">
            </div>

            @error('name')
                <small class="alert-danger">{{$message}}</small>
            @enderror

            <div class="form-group col-6 mt-1 mb-1">
                <label for="description">Description</label>
                <textarea class="form-control mt-2" id="description" name="description" rows="3">{{$service->description}}</textarea>
            </div>

            @error('description')
            <small class="alert-danger">{{$message}}</small>
            @enderror

            <div class="form-group col-6 mt-1 mb-1">
                <label for="status">Status</label>
                <select class="form-select" name="status">
                    <option value="on" @if ($service->status == 'on') {{'selected'}} @endif>on</option>
                    <option value="off" @if ($service->status == 'off') {{'selected'}} @endif>off</option>
                </select>
            </div>

            @error('status')
            <small class="alert-danger">{{$message}}</small>
            @enderror

            <button class="btn btn-primary" type="submit">Update</button>
        </form>
    </div>
@endsection
