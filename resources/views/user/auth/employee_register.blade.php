@extends('user.layouts.app')

@section('page-title', '| Employee Register')

@section('content')
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-6" style="margin-top: 6rem!important;">
                <h2 class="my-4 h3">Employee Register</h2>
                <form action="{{route('employee.register')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="type" value="employee" hidden>
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name">
                        @error('first_name')
                            <small class="alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name">
                        @error('last_name')
                            <small class="alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="company_name" class="form-label">Company Name</label>
                        <input type="text" class="form-control" id="company_name" name="company_name">
                        @error('company_name')
                            <small class="alert-danger">{{$message}}</small>
                        @enderror
                    </div>
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
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Password Confirmation</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
{{--                        @error('password_confirmation')--}}
{{--                        <small class="alert-danger">{{$message}}</small>--}}
{{--                        @enderror--}}
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                        @error('phone')
                           <small class="alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo</label>
                        <input type="file" class="form-control" id="logo" name="logo">
                    </div>
                    @error('logo')
                        <small class="alert-danger">{{$message}}</small>
                    @enderror
                    <button type="submit" class="btn btn-primary mb-2">Register</button>
                </form>
            </div>
        </div>

    </div>
@endsection

