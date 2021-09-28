@extends('user.layouts.app')

@section('page-title', ' | Edit Job')

@section('content')

    <div style="height: 113px;"></div>

    <div class="unit-5 overlay" style="background-image: url('{{asset('assets/images/hero_1.jpg')}}');">
        <div class="container text-center">
            <h2 class="mb-0">Edit Job</h2>
            <p class="mb-0 unit-6"><a href="{{route('home')}}">Home</a> <span class="sep">></span> <span>Edit Job</span></p>
        </div>
    </div>




    <div class="site-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8 mb-5">

                    <form action="{{route('jobs.update', ['job' => $job->id])}}" method="post" class="p-5 bg-white" enctype="multipart/form-data">

                        @csrf
                        @method("PUT")
                        <div class="row form-group">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-bold" for="job_title">Job Title</label>
                                <input type="text" id="job_title" class="form-control" name="job_title" value="{{$job->title}}" placeholder="eg. Full Stack Frontend">
                                @error('job_title')
                                <small class="alert-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-bold" for="company_name">Company</label>
                                <input type="text" id="company_name" class="form-control" name="company_name" placeholder="{{$job->user->employeeProfile->company_name}}" disabled>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-bold" for="image">Image</label>
                                <input type="file" id="image" class="form-control" name="image" multiple>
                            </div>
                        </div>

                        <div class="row form-group mb-5">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label class="font-weight-bold" for="career">Career</label>
                                <select id="career" class="custom-select" name="career">
                                    <option value="">--Choose Career--</option>

                                    @foreach ($careers as $career)
                                        <option value="{{$career->id}}" @if($job->career_id === $career->id) {{'selected'}} @endif>{{$career->name}}</option>
                                    @endforeach

                                </select>
                                @error('career')
                                <small class="alert-danger">{{$message}}</small>
                                @enderror

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12"><h3>Job Type</h3></div>


                            <div class="col-md-12 mb-3 mb-md-0">
                                <label for="option-job-type-1">
                                    <input type="radio" id="option-job-type-1" name="job_type" value="Freelance" @if($job->type === 'Freelance') {{'checked'}} @endif>
                                    Freelance
                                </label>
                            </div>
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label for="option-job-type-1">
                                    <input type="radio" id="option-job-type-1" name="job_type" value="Full Time" @if($job->type === 'Full Time') {{'checked'}} @endif>
                                    Full Time
                                </label>
                            </div>
                            <div class="col-md-12 mb-3 mb-md-0">
                                <label for="option-job-type-1">
                                    <input type="radio" id="option-job-type-1" name="job_type" value="Part Time" @if($job->type === 'Part Time') {{'checked'}} @endif>
                                    Part Time
                                </label>
                            </div>
                            @error('job_type')
                            <small class="alert-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="min_salary">Min Salary(optional)</label>
                                <input type="number" class="form-control" id="min_salary" name="min_salary" value="@if($job->min_salary != null){{$job->min_salary}}@endif">
                            </div>
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="max_salary">Max Salary(optional)</label>
                                <input type="number" class="form-control" id="max_salary" name="max_salary" value="@if($job->max_salary != null){{$job->max_salary}}@endif">
                            </div>
                        </div>


                        <div class="row form-group">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="street">Street</label>
                                <input type="text" class="form-control" id="street" name="street" value="{{$job->location->street}}">
                                @error('street')
                                <small class="alert-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="building">Building</label>
                                <input type="text" class="form-control" id="building" name="building" value="{{$job->location->building}}">
                                @error('building')
                                <small class="alert-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group mb-4">
                            <div class="col-md-12"><h3>Country</h3></div>
                            <div class="col-md-12 mb-3 mb-md-0">
                                <input type="text" class="form-control" name="country" nameplaceholder="Egypt" value="{{$job->location->country}}">
                                @error('country')
                                <small class="alert-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group mb-4">
                            <div class="col-md-12"><h3>City</h3></div>
                            <div class="col-md-12 mb-3 mb-md-0">
                                <input type="text" class="form-control" name="city" nameplaceholder="Giza" value="{{$job->location->city}}">
                                @error('city')
                                <small class="alert-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group mb-4">
                            <div class="col-md-12"><h3>Region</h3></div>
                            <div class="col-md-12 mb-3 mb-md-0">
                                <input type="text" class="form-control" name="region" nameplaceholder="Haram" value="{{$job->location->region}}">
                                @error('region')
                                <small class="alert-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12"><h3>Job Description</h3></div>
                            <div class="col-md-12 mb-3 mb-md-0">
                                <textarea name="description" class="form-control" id="" cols="30" rows="5">{{$job->description}}</textarea>
                                @error('description')
                                <small class="alert-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="submit" value="Update" class="btn btn-primary  py-2 px-5">
                            </div>
                        </div>


                    </form>
                </div>

                {{--            <div class="col-lg-4">--}}
                {{--                <div class="p-4 mb-3 bg-white">--}}
                {{--                    <h3 class="h5 text-black mb-3">Contact Info</h3>--}}
                {{--                    <p class="mb-0 font-weight-bold">Address</p>--}}
                {{--                    <p class="mb-4">203 Fake St. Mountain View, San Francisco, California, USA</p>--}}

                {{--                    <p class="mb-0 font-weight-bold">Phone</p>--}}
                {{--                    <p class="mb-4"><a href="#">+1 232 3235 324</a></p>--}}

                {{--                    <p class="mb-0 font-weight-bold">Email Address</p>--}}
                {{--                    <p class="mb-0"><a href="#">youremail@domain.com</a></p>--}}

                {{--                </div>--}}

                {{--                <div class="p-4 mb-3 bg-white">--}}
                {{--                    <h3 class="h5 text-black mb-3">More Info</h3>--}}
                {{--                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa ad iure porro mollitia architecto hic consequuntur. Distinctio nisi perferendis dolore, ipsa consectetur</p>--}}
                {{--                    <p><a href="#" class="btn btn-primary  py-2 px-4">Learn More</a></p>--}}
                {{--                </div>--}}
                {{--            </div>--}}
            </div>
        </div>
    </div>




    <div class="site-section">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-md-6" data-aos="fade" >
                    <h2>Frequently Ask Questions</h2>
                </div>
            </div>


            <div class="row justify-content-center" data-aos="fade" data-aos-delay="100">
                <div class="col-md-8">
                    <div class="accordion unit-8" id="accordion">
                        {{--                    <div class="accordion-item">--}}
                        {{--                        <h3 class="mb-0 heading">--}}
                        {{--                            <a class="btn-block" data-toggle="collapse" href="#collapseOne" role="button" aria-expanded="true" aria-controls="collapseOne">What is the name of your company<span class="icon"></span></a>--}}
                        {{--                        </h3>--}}
                        {{--                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">--}}
                        {{--                            <div class="body-text">--}}
                        {{--                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur quae cumque perspiciatis aperiam accusantium facilis provident aspernatur nisi optio debitis dolorum, est eum eligendi vero aut ad necessitatibus nulla sit labore doloremque magnam! Ex molestiae, dolor tempora, ad fuga minima enim mollitia consequuntur, necessitatibus praesentium eligendi officia recusandae culpa tempore eaque quasi ullam magnam modi quidem in amet. Quod debitis error placeat, tempore quasi aliquid eaque vel facilis culpa voluptate.</p>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                    </div> <!-- .accordion-item -->--}}

                        {{--                    <div class="accordion-item">--}}
                        {{--                        <h3 class="mb-0 heading">--}}
                        {{--                            <a class="btn-block" data-toggle="collapse" href="#collapseTwo" role="button" aria-expanded="false" aria-controls="collapseTwo">How much pay for 3  months?<span class="icon"></span></a>--}}
                        {{--                        </h3>--}}
                        {{--                        <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">--}}
                        {{--                            <div class="body-text">--}}
                        {{--                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel ad laborum expedita. Nostrum iure atque enim quisquam minima distinctio omnis, consequatur aliquam suscipit, quidem, esse aspernatur! Libero, excepturi animi repellendus porro impedit nihil in doloremque a quaerat enim voluptatum, perspiciatis, quas dignissimos maxime ut cum reiciendis eius dolorum voluptatem aliquam!</p>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                    </div> <!-- .accordion-item -->--}}

                        {{--                    <div class="accordion-item">--}}
                        {{--                        <h3 class="mb-0 heading">--}}
                        {{--                            <a class="btn-block" data-toggle="collapse" href="#collapseThree" role="button" aria-expanded="false" aria-controls="collapseThree">Do I need to register?  <span class="icon"></span></a>--}}
                        {{--                        </h3>--}}
                        {{--                        <div id="collapseThree" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">--}}
                        {{--                            <div class="body-text">--}}
                        {{--                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel ad laborum expedita. Nostrum iure atque enim quisquam minima distinctio omnis, consequatur aliquam suscipit, quidem, esse aspernatur! Libero, excepturi animi repellendus porro impedit nihil in doloremque a quaerat enim voluptatum, perspiciatis, quas dignissimos maxime ut cum reiciendis eius dolorum voluptatem aliquam!</p>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                    </div> <!-- .accordion-item -->--}}

                        {{--                    <div class="accordion-item">--}}
                        {{--                        <h3 class="mb-0 heading">--}}
                        {{--                            <a class="btn-block" data-toggle="collapse" href="#collapseFour" role="button" aria-expanded="false" aria-controls="collapseFour">Who should I contact in case of support.<span class="icon"></span></a>--}}
                        {{--                        </h3>--}}
                        {{--                        <div id="collapseFour" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">--}}
                        {{--                            <div class="body-text">--}}
                        {{--                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel ad laborum expedita. Nostrum iure atque enim quisquam minima distinctio omnis, consequatur aliquam suscipit, quidem, esse aspernatur! Libero, excepturi animi repellendus porro impedit nihil in doloremque a quaerat enim voluptatum, perspiciatis, quas dignissimos maxime ut cum reiciendis eius dolorum voluptatem aliquam!</p>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                    </div> <!-- .accordion-item -->--}}

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
