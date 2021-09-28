@extends('admin.layout.app')

@section('title', 'Sign In')

@section('content')
    <div class="container">
        <form action="{{route('admin.login')}}" method="post">

            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
            </div>

            @error('email')
            <small class="alert-danger">{{$message}}</small>
            @enderror
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>

            @error('password')
            <small class="alert-danger">{{$message}}</small>
            @enderror
            <button type="submit" class="btn btn-primary">Sign In</button>
        </form>
    </div>
@endsection
