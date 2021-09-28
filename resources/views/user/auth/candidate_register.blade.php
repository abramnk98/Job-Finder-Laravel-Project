@extends('user.layouts.app')

@section('page-title', '| Candidate Register')

@section('content')
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-6" style="margin-top: 6rem!important;">
                <h2 class="my-4 h3">Candidate Register</h2>
                <form action="{{route('register')}}" method="post" enctype="multipart/form-data">
                    @csrf
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
                        @error('password_confirmation')
                        <small class="alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                        @error('phone')
                           <small class="alert-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="street">Street</label>
                            <input type="text" class="form-control" id="street" name="street">
                            @error('street')
                            <small class="alert-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="building">Building</label>
                            <input type="text" class="form-control" id="building" name="building">
                            @error('building')
                            <small class="alert-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row form-group mb-4">
                        <div class="col-md-12"><h3>Country</h3></div>
                        <div class="col-md-12 mb-3 mb-md-0">
                            <input type="text" class="form-control" name="country" placeholder="Egypt">
                            @error('country')
                            <small class="alert-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row form-group mb-4">
                        <div class="col-md-12"><h3>City</h3></div>
                        <div class="col-md-12 mb-3 mb-md-0">
                            <input type="text" class="form-control" name="city" placeholder="Giza">
                            @error('city')
                            <small class="alert-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group mb-4">
                        <div class="col-md-12"><h3>Region</h3></div>
                        <div class="col-md-12 mb-3 mb-md-0">
                            <input type="text" class="form-control" name="region" placeholder="Haram">
                            @error('region')
                            <small class="alert-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3" id="careerCheckBox">
{{--                        <label for="last_name" class="form-label">Career</label>--}}
{{--                        <input type="checkbox" class="form-check" name="career1" id="career1" autocomplete="off">--}}
{{--                        <label class="form-check-label" for="career1">Checkbox 1</label>--}}

{{--                        <input type="checkbox" class="form-check" name="caree" id="caree" autocomplete="off">--}}
{{--                        <label class="form-check-label" for="caree">Checkbox 2</label>--}}

{{--                        <input type="checkbox" class="form-check" name="btncheck3" id="btncheck3" autocomplete="off">--}}
{{--                        <label class="form-check-label" for="btncheck3">Checkbox 3</label>--}}
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
                    <button type="submit" class="btn btn-primary mb-2">Register</button>
                </form>
            </div>
        </div>

    </div>
@endsection

@push('script')

    <script>
        $(document).ready(function () {

            $.ajax({
                url:"{{route('home.careers')}}",
                method:"GET",
                success: function (data) {

                    let careerCheckBoxHTML = '<label for="last_name" class="form-label">Career</label>';
                    let i = 0;
                    $.each(data, function (key, career) {

                        careerCheckBoxHTML +=
                            '<input type="checkbox" class="form-check" name="career[' + career.id +']" id="career' + ++i +'" autocomplete="off">'+
                            '<label class="form-check-label" for="career' + ++i +'' + ++i +'">' + career.name + '</label>';
                    })

                    $('#careerCheckBox').prepend(careerCheckBoxHTML);
                },
            })

        })
    </script>
@endpush

