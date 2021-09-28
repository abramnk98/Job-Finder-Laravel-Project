@extends('admin.layout.app')

@section('page-title', '| Edit Settings')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Settings</h1>
        <form method="post" action="{{route('admin.settings.update', ['setting' => 1])}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="email" class="form-label">email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{$settings->email}}">
                @error('email')
                <small class="alert-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone" name="phone" value="0{{$settings->phone}}">
                @error('phone')
                <small class="alert-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="row form-group">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label for="street">Street</label>
                    <input type="text" class="form-control" id="street" name="street" value="{{$settings->street}}">
                    @error('street')
                    <small class="alert-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="col-md-6 mb-3 mb-md-0">
                    <label for="building">Building</label>
                    <input type="text" class="form-control" id="building" name="building" value="{{$settings->building}}">
                    @error('building')
                    <small class="alert-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>

            <div class="row form-group mb-4">
                <div class="col-md-12"><h3>Country</h3></div>
                <div class="col-md-12 mb-3 mb-md-0">
                    <input type="text" class="form-control" name="country" placeholder="Egypt" value="{{$settings->country}}">
                    @error('country')
                    <small class="alert-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>

            <div class="row form-group mb-4">
                <div class="col-md-12"><h3>City</h3></div>
                <div class="col-md-12 mb-3 mb-md-0">
                    <input type="text" class="form-control" name="city" placeholder="Giza" value="{{$settings->city}}">
                    @error('city')
                    <small class="alert-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="row form-group mb-4">
                <div class="col-md-12"><h3>Region</h3></div>
                <div class="col-md-12 mb-3 mb-md-0">
                    <input type="text" class="form-control" name="region" placeholder="Haram" value="{{$settings->region}}">
                    @error('region')
                    <small class="alert-danger">{{$message}}</small>
                    @enderror
                </div>
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
@endsection
