@extends('user.layouts.app')

@section('page-title', 'Edit Personal Information')

@section('content')
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-6" style="margin-top: 6rem!important;">
                <h2 class="my-4 h3">Edit Personal Information</h2>
                <form action="{{route('employee.profile.update', ['profile' => $employeeProfile->id])}}" method="post" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{$employeeProfile->first_name}}">
                        @error('first_name')
                        <small class="alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{$employeeProfile->last_name}}">
                        @error('last_name')
                        <small class="alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="company_name" class="form-label">Company Name</label>
                        <input type="text" class="form-control" id="company_name" name="company_name" value="{{$employeeProfile->company_name}}">
                        @error('company_name')
                        <small class="alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="0{{$employeeProfile->phone}}">
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
                    <button type="submit" class="btn btn-primary mb-2">Update</button>
                </form>
            </div>
        </div>

    </div>
@endsection

