@extends('user.layouts.app')

@section('page-title', '| Edit Personal Information')

@section('content')
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-6" style="margin-top: 6rem!important;">
                <h2 class="my-4 h3">Edit Personal Information</h2>
                <form action="{{route('candidate.profile.update', ['profile' => $candidate_profile])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{$candidate_profile->first_name}}">
                        @error('first_name')
                        <small class="alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{$candidate_profile->last_name}}">
                        @error('last_name')
                        <small class="alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="0{{$candidate_profile->phone}}">
                        @error('phone')
                        <small class="alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="street">Street</label>
                            <input type="text" class="form-control" id="street" name="street" value="{{$candidate_profile->location->street}}">
                            @error('street')
                            <small class="alert-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="building">Building</label>
                            <input type="text" class="form-control" id="building" name="building" value="{{$candidate_profile->location->building}}">
                            @error('building')
                            <small class="alert-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row form-group mb-4">
                        <div class="col-md-12"><h3>Country</h3></div>
                        <div class="col-md-12 mb-3 mb-md-0">
                            <input type="text" class="form-control" name="country" placeholder="Egypt" value="{{$candidate_profile->location->country}}">
                            @error('country')
                            <small class="alert-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row form-group mb-4">
                        <div class="col-md-12"><h3>City</h3></div>
                        <div class="col-md-12 mb-3 mb-md-0">
                            <input type="text" class="form-control" name="city" placeholder="Giza" value="{{$candidate_profile->location->city}}">
                            @error('city')
                            <small class="alert-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group mb-4">
                        <div class="col-md-12"><h3>Region</h3></div>
                        <div class="col-md-12 mb-3 mb-md-0">
                            <input type="text" class="form-control" name="region" placeholder="Haram" value="{{$candidate_profile->location->region}}">
                            @error('region')
                            <small class="alert-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3" id="careerCheckBox">
                        <label for="last_name" class="form-label">Career</label>
                        @foreach($careers as $career)

                            <input type="checkbox" class="form-check" name="career[{{$career->id}}]" autocomplete="off" @if(array_search($career->id, $candidate_careers)) {{'checked'}} @endif>
                            <label class="form-check-label" for="career">{{$career->name}}</label>
                        @endforeach

                        @error('career')
                        <small class="alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Profile Photo</label>
                        <input type="file" class="form-control" id="photo" name="photo">
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

{{--@push('script')--}}

{{--    <script>--}}
{{--        $(document).ready(function () {--}}

{{--            $.ajax({--}}
{{--                url:"{{route('home.careers')}}",--}}
{{--                method:"GET",--}}
{{--                success: function (data) {--}}

{{--                    let careerCheckBoxHTML = '<label for="last_name" class="form-label">Career</label>';--}}
{{--                    let i = 0;--}}
{{--                    $.each(data, function (key, career) {--}}

{{--                        careerCheckBoxHTML +=--}}
{{--                            '<input type="checkbox" class="form-check" name="career[' + career.id +']" id="career' + ++i +'" autocomplete="off" >'+--}}
{{--                            '<label class="form-check-label" for="career' + ++i +'' + ++i +'">' + career.name + '</label>';--}}
{{--                    })--}}

{{--                    $('#careerCheckBox').prepend(careerCheckBoxHTML);--}}
{{--                },--}}
{{--            })--}}

{{--        })--}}
{{--    </script>--}}
{{--@endpush--}}
