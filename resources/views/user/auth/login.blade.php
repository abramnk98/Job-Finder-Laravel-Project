@extends('user.layouts.app')

@section('page-title', '| Sign in')

@section('content')
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-6" style="margin-top: 6rem!important;">
                <h2 class="my-4 h3">Sign in</h2>
                <form action="{{route('login')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        @error('email')
                            <small class="alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                        @error('password')
                            <small class="alert-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mb-2">Sign in</button>
                </form>
            </div>
        </div>

    </div>
@endsection

