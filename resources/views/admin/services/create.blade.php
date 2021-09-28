@extends('admin.layout.app')

@section('sidebar')
    @include('admin.layout.sidebar')
@endsection

@section('page-title', '| Create Service')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Create Service</h1>
        <form method="post" action="{{route('admin.services.store')}}">
            @csrf
            <div class="form-group col-6 mt-1 mb-1">
                <label for="name">Name</label>
                <input type="text" class="form-control mt-2" id="name" name="name" placeholder="Service Name">

                @error('name')
                <small class="alert-danger">{{$message}}</small>
                @enderror

            </div>
            <div class="form-group col-6 mt-1 mb-1">
                <label for="description">Description</label>
                <textarea class="form-control mt-2" id="description" name="description" rows="3"></textarea>

                @error('description')
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
