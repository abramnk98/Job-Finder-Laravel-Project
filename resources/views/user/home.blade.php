@extends('user.layouts.app')


@section('content')


    <div style="height: 113px;"></div>

    <div class="site-blocks-cover overlay" style="background-image: url('{{asset('assets/images/hero_1.jpg')}}');" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12" data-aos="fade">
                    <h1>@if(Auth::check() && Auth::user()->type === 'employee') {{'Browse Candidate'}} @else {{'Find Job'}}@endif</h1>
                    <form action="@if(Auth::check() && Auth::user()->type === 'employee') {{route('employee.browse-candidates')}} @else {{route('jobs.index')}} @endif" method="get">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-9">
                                <div class="row">
                                    @if(Auth::check() && Auth::user()->type !== 'employee' || !Auth::check())
                                    <div class="col-md-4 mb-3 mb-md-0">
                                        <input type="text" name="title_or_company" class="mr-3 form-control border-0 px-4" placeholder="job title, keywords or company name ">
                                        @error('title_or_company')
                                        <small class="alert-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    @endif
                                    <div class="col-md-4 mb-3 mb-md-0 ">
                                        <select class="form-control categories-select" name="category">
                                            <option value="">--choose category--</option>
                                        </select>
                                        @error('category')
                                        <small class="alert-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3 mb-md-0">
                                        <div class="input-wrap">
                                            <span class="icon icon-room"></span>
                                            <input type="text" class="form-control cities-select" name="city_or_region" placeholder="city or region(optional)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <input type="submit" class="btn btn-search btn-primary btn-block" value="Search">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@if(!Auth::check() || auth()->user()->type == 'admin')
    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto text-center mb-5 section-heading">
                    <h2 class="mb-5">Popular Categories</h2>
                </div>
            </div>
            <div class="row categories-section">
{{--                @foreach ($careers as $career)--}}
{{--                    <div class="col-sm-6 col-md-4 col-lg-3 mb-3" data-aos="fade-up" data-aos-delay="100">--}}
{{--                        <a href="#" class="h-100 feature-item">--}}
{{--                            <span class="d-block icon {{$career->icon_class}} mb-3 text-primary"></span>--}}
{{--                            <h2>{{$career->name}}</h2>--}}
{{--                            <span class="counting">{{$career->jobs->count()}}</span>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                @endforeach--}}

            </div>

        </div>
    </div>


    <div class="site-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mb-5 mb-md-0" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="mb-5 h3">Recent Jobs</h2>
                    <div class="rounded border jobs-wrap recent-job-section">

                        @php
                            $job_type = [
                                "Freelance" => ['warning', 'freelance'],
                                "Full Time" => ['info', 'fulltime'],
                                "Part Time" => ['danger', 'partime'],
                            ];
                        @endphp
                        @foreach($recent_jobs as $job)
                            <a href="{{route('jobs.show', ["job" => $job->id])}}" class="job-item d-block d-md-flex align-items-center  border-bottom {{$job_type[$job->type][1]}}">
                                <div class="company-logo blank-logo text-center text-md-left pl-3">
                                    <img src="{{asset('assets/images/company_logo/'.$job->user->employeeProfile->logo)}}" alt="Image" class="img-fluid mx-auto">
                                </div>
                                <div class="job-details h-100">
                                    <div class="p-3 align-self-center">
                                        <h3>{{$job->title}}</h3>
                                        <div class="d-block d-lg-flex">
                                            <div class="mr-3"><span class="icon-suitcase mr-1"></span> {{$job->user->employeeProfile->company_name}}</div>
                                            <div class="mr-3"><span class="icon-room mr-1"></span> {{$job->location->country}}</div>

                                            @if($job->min_salary !== null && $job->max_salary !== null)
                                                <div><span class="icon-money mr-1"></span> {{$job->min_salary}} - {{$job->max_salary}}</div>
                                            @elseif ($job->min_salary !== null)
                                                <div><span class="icon-money mr-1"></span> {{$job->min_salary}}</div>
                                            @elseif ($job->max_salary !== null)
                                                <div><span class="icon-money mr-1"></span> {{$job->max_salary}}</div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="job-category align-self-center">
                                    <div class="p-3">
                                        <span class="text-{{$job_type[$job->type][0]}} p-2 rounded border border-{{$job_type[$job->type][0]}}">{{$job->type}}</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach

                    </div>

                    <div class="col-md-12 text-center mt-5">
                        <a href="{{route('jobs.index')}}" class="btn btn-primary rounded py-3 px-5"><span class="icon-plus-circle"></span> Show More Jobs</a>
                    </div>
                </div>
                <div class="col-md-4 block-16" data-aos="fade-up" data-aos-delay="200">
                    <div class="d-flex mb-0">
                        <h2 class="mb-5 h3 mb-0">Featured Jobs</h2>
                        <div class="ml-auto mt-1"><a href="#" class="owl-custom-prev">Prev</a> / <a href="#" class="owl-custom-next">Next</a></div>
                    </div>

                    <div class="nonloop-block-16 owl-carousel feature-job-section">

                    @foreach($recent_jobs as $job)

                        <div class="border rounded p-4 bg-white">
                            <h2 class="h5">{{$job->title}}</h2>
                            <p><span class="border border-{{$job_type[$job->type][0]}} rounded p-1 px-2 text-{{$job_type[$job->type][0]}}">{{$job->type}}</span></p>
                            <p>
                                <span class="d-block"><span class="icon-suitcase"></span> {{$job->user->employeeProfile->company_name}}</span>
                                <span class="d-block"><span class="icon-room"></span> {{$job->location->country}}</span>

                            @if($job->min_salary !== null && $job->max_salary !== null)
                                <div><span class="icon-money mr-1"></span> {{$job->min_salary}} - {{$job->max_salary}}</div>
                            @elseif ($job->min_salary !== null)
                                <div><span class="icon-money mr-1"></span> {{$job->min_salary}}</div>
                            @elseif ($job->max_salary !== null)
                                <div><span class="icon-money mr-1"></span> {{$job->max_salary}}</div>
                            @endif
                            <p class="mb-0">{{$job->description}}</p>
                        </div>
                    @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="site-section" data-aos="fade">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-5 mb-md-0">

                    <div class="img-border">
                  <span class="icon-wrap">
                    <span class="icon icon-play"></span>
                  </span>
                            <img src="{{asset('assets/images/hero_2.jpg')}}" alt="Image" class="img-fluid rounded">
                        </a>
                    </div>

                </div>
                <div class="col-md-5 ml-auto testimony">
                    <div class="text-left mb-5 section-heading">
                        <h2>Testimonies</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="site-blocks-cover overlay inner-page" style="background-image: url('{{asset('assets/images/hero_1.jpg')}}');" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-6 text-center" data-aos="fade">
                    <h1 class="h3 mb-0">Your Dream Job</h1>
                    <p class="h3 text-white mb-5">Is Waiting For You</p>
                    <p><a href="#" class="btn btn-outline-warning py-3 px-4">Find Jobs</a> <a href="{{route('jobs.index')}}" class="btn btn-warning py-3 px-4">Apply For A Job</a></p>

                </div>
            </div>
        </div>
    </div>



    <div class="site-section site-block-feature bg-light">
        <div class="container">

            <div class="text-center mb-5 section-heading">
                <h2>Why Choose Us</h2>
            </div>

            <div class="d-block d-md-flex border-bottom services-section-1">

            </div>
            <div class="d-block d-md-flex services-section-2">

            </div>
        </div>
    </div>
@endif

@if(Auth::check() && auth()->user()->type != 'admin')

    <div class="site-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-5 mb-md-0 mt-5" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="mb-5 h3">@if(Auth::user()->type === 'employee') {{'Recommended Candidates'}} @else {{'Recommended Jobs'}}@endif</h2>
                    <div class="rounded border jobs-wrap">
                        @php
                            $job_type = [
                                "Freelance" => ['warning', 'freelance'],
                                "Full Time" => ['info', 'fulltime'],
                                "Part Time" => ['danger', 'partime'],
                            ];
                        @endphp

                        @if(Auth::user()->type === 'candidate')
                            @foreach($recommended_jobs as $job)
                                <a href="{{route('jobs.show', ['job' => $job->id])}}" class="job-item d-block d-md-flex align-items-center  border-bottom {{$job_type[$job->type][1]}}">
                                    <div class="company-logo blank-logo text-center text-md-left pl-3">
                                        <img src="{{asset('assets/images/company_logo/'.$job->user->employeeProfile->logo)}}" alt="Image" class="img-fluid mx-auto">
                                    </div>
                                    <div class="job-details h-100">
                                        <div class="p-3 align-self-center">
                                            <h3>{{$job->title}}</h3>
                                            <div class="d-block d-lg-flex">
                                                <div class="mr-3"><span class="icon-suitcase mr-1"></span> {{$job->user->employeeProfile->company_name}}</div>
                                                <div class="mr-3"><span class="icon-room mr-1"></span> {{ucwords($job->location->city)}}</div>

                                                @if($job->min_salary !== null && $job->max_salary !== null)
                                                    <div><span class="icon-money mr-1"></span> {{$job->min_salary}} - {{$job->max_salary}}</div>
                                                @elseif ($job->min_salary !== null && $job->max_salary !== null)
                                                    <div><span class="icon-money mr-1"></span> {{$job->min_salary}} {{$job->max_salary}}</div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                    <div class="job-category align-self-center">
                                        <div class="p-3">
                                            <span class="text-{{$job_type[$job->type][0]}} p-2 rounded border border-{{$job_type[$job->type][0]}}">{{$job->type}}</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @endif

                        @if(Auth::user()->type === 'employee')
                            @foreach($recommended_candidates as $candidate)
                                <div class="job-item d-block d-md-flex align-items-center  border-bottom">
                                    <div class="company-logo blank-logo text-center text-md-left pl-3">
                                        <img src="{{asset('assets/images/candidate_photo/'.$candidate->photo)}}" alt="Image" class="img-fluid mx-auto">
                                    </div>
                                    <div class="job-details h-100">
                                        <div class="p-3 align-self-center">
                                            <h3>{{$candidate->user->name}}</h3>
                                            <div class="d-block d-lg-flex">
                                                @php $location = $candidate->location; @endphp
                                                <div class="mr-3"><span class="icon-room mr-1"></span> {{ucwords($location->building).' St.'.ucwords($location->street).' '.ucwords($location->region).',' .ucwords($location->city).',' .ucwords($location->country)}}</div>
                                                <div class="mr-3"><span class="icon-room mr-1"></span>0{{$candidate->phone}}</div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>

                </div>

            </div>
        </div>
    </div>
@endif

@endsection

@push('script')
<script>
    $(document).ready(function () {

        $.ajax({
            url: "{{route('home.careers')}}",
            method: "GET",
            success: function (data) {
                let categoriesSelect = '';

                $.each(data, function(key, category) {
                    categoriesSelect +=
                        '<option value="'+ category.id + '">'+
                            category.name.charAt(0).toUpperCase() + category.name.slice(1)+
                        '</option>';
                })

                $('.categories-select').append(categoriesSelect);
            }
        })

        @if(!Auth::check() || auth()->user()->type == 'admin')
        $.ajax({
            url: "{{route('home.services')}}",
            method: "GET",
            success: function (data) {

                let sectionNumber = 0;
                 $.each(data, function (key, services) {

                     ++sectionNumber;

                     let servicesHTMLContent = '';

                    $.each(services, function (key, service) {

                        servicesHTMLContent += '<div class="text-center p-4 item" data-aos="fade">'+
                            '<span class="' + service.icon_class  + ' display-3 mb-3 d-block text-primary"></span>'+
                            '<h2 class="h4">' + service.name + '</h2>'+
                            '<p>' + service.description + '</p>'+
                            '<p><a href="#">Read More <span class="icon-arrow-right small"></span></a></p>'+
                        '</div>';
                    })

                     $('.services-section-' + sectionNumber).html(servicesHTMLContent);
                 })
            }
        })


        $.ajax({
            url: "{{route('home.careers')}}",
            method: "GET",
            success: function(data) {

                let categoriesHTMLContent = '';

                $.each(data, function(key, category) {

                    categoriesHTMLContent += '<div class="col-sm-6 col-md-4 col-lg-3 mb-3" data-aos="fade-up" data-aos-delay="100">'+
                        '<a href="{{route('jobs.index')}}?category=' + category.id + '" class="h-100 feature-item">'+
                        '<span class="d-block icon ' + category.icon_class + ' mb-3 text-primary"></span>'+
                        '<h2>' + category.name + '</h2>'+
                        '<span class="counting">' +category.jobs_count + '</span>'+
                        '</a>'+
                        '</div>';
                })

                $('.categories-section').html(categoriesHTMLContent);
            }
        })

        $.ajax({
            url: "{{route('testimonies.index')}}",
            method: 'GET',
            success: function(data) {

                let testtimonyContentHTML = '<p class="mb-4 h5 font-italic lineheight1-5">' + data[0].content + '</p>'+
                '<p>&mdash; <strong class="text-black font-weight-bold">' + data[0].candidate_profile.first_name + ' ' + data[0].candidate_profile.first_name + '</p>';

                $('.testimony').append(testtimonyContentHTML);
            },
        })
        @endif
        {{--$.ajax({--}}
        {{--    url: "{{route('home.recent.job')}}",--}}
        {{--    method: "GET",--}}
        {{--    success: function(data) {--}}

        {{--        let job_type = {--}}
        {{--            "Freelance": ['warning', 'freelance'],--}}
        {{--            "Full Time": ['info', 'fulltime'],--}}
        {{--            "Part Time": ['danger', 'partime'],--}}
        {{--        };--}}

        {{--        let recentJobsHtmlContent = '';--}}

        {{--        let featureJobHtmlContent = '';--}}

        {{--        $.each(data, function(key, job) {--}}

        {{--            recentJobsHtmlContent += '<a href="{{url('jobs')}}/'+job.id+'" class="job-item d-block d-md-flex align-items-center  border-bottom '+job_type[job.type][1]+'">'+--}}
        {{--                '<div class="company-logo blank-logo text-center text-md-left pl-3">'+--}}
        {{--                '<img src="{{url('assets/images/company_logo')}}/'+job.employee_profile.logo+'" alt="Image" class="img-fluid mx-auto">'+--}}
        {{--                '</div>'+--}}
        {{--                '<div class="job-details h-100">'+--}}
        {{--                '<div class="p-3 align-self-center">'+--}}
        {{--                '<h3>'+job.title+'</h3>'+--}}
        {{--                '<div class="d-block d-lg-flex">'+--}}
        {{--                '<div class="mr-3"><span class="icon-suitcase mr-1"></span> '+job.employee_profile.company_name +'</div>'+--}}
        {{--                '<div class="mr-3"><span class="icon-room mr-1"></span>'+ job.location.city+'</div>';--}}

        {{--            if(job.min_salary !== null && job.max_salary !== null) {--}}
        {{--                recentJobsHtmlContent += '<div><span class="icon-money mr-1"></span>'+ job.min_salary + '- ' + job.max_salary+'</div>';--}}
        {{--            }--}}
        {{--            else if (job.min_salary !== null) {--}}
        {{--                recentJobsHtmlContent += '<div><span class="icon-money mr-1"></span> '+ job.min_salary + '</div>';--}}
        {{--            }--}}
        {{--            else if (job.max_salary !== null) {--}}
        {{--                recentJobsHtmlContent += '<div><span class="icon-money mr-1"></span> '+ job.max_salary + '</div>';--}}
        {{--            }--}}

        {{--            recentJobsHtmlContent += '</div>'+--}}
        {{--                '</div>'+--}}
        {{--                '</div>'+--}}
        {{--                '<div class="job-category align-self-center">'+--}}
        {{--                '<div class="p-3">'+--}}
        {{--                '<span class="text-' + job_type[job.type][0] + ' p-2 rounded border border-' + job_type[job.type][0] + '">' +job.type + '</span>'+--}}
        {{--                '</div>'+--}}
        {{--                '</div>'+--}}
        {{--                '</a>';--}}
        {{--        })--}}

        {{--        $.each(data, function (key, job) {--}}

        {{--            featureJobHtmlContent += '<div class="border rounded p-4 bg-white">' +--}}
        {{--                '<h2 class="h5">' + job.title + '</h2>' +--}}
        {{--                '<p><span class="border border-' + job_type[job.type][0] + ' rounded p-1 px-2 text-' + job_type[job.type][0] + '">' + job.type + '</span></p>' +--}}
        {{--                '<p>'+--}}
        {{--                '<span class="d-block"><span class="icon-suitcase"></span> ' + job.employee_profile.company_name + '</span>' +--}}
        {{--                '<span class="d-block"><span class="icon-room"></span> ' + job.location.country + '</span>'+--}}
        {{--                '</p>';--}}

        {{--            if (job.min_salary !== null && job.max_salary !== null) {--}}

        {{--                featureJobHtmlContent += '<span class="d-block"><span class="icon-money mr-1"></span> ' + job.min_salary + '-' + job.max_salary + '</span>';--}}

        {{--            } else if (job.min_salary !== null) {--}}

        {{--                featureJobHtmlContent += '<span class="d-block"><span class="icon-money mr-1"></span>' + job.min_salary + '</span>';--}}

        {{--            } else if (job.max_salary !== null) {--}}

        {{--                featureJobHtmlContent += '<span class="d-block"><span class="icon-money mr-1"></span> ' + job.max_salary + '</span>';--}}

        {{--            }--}}

        {{--            featureJobHtmlContent +=     '<p class="mb-0">' + job.description + '</p></div>';--}}
        {{--        })--}}

        {{--        $('.recent-job-section').html(recentJobsHtmlContent);--}}
        {{--        $('.feature-job-section').html(featureJobHtmlContent);--}}
        {{--    }--}}
        // })
    })
</script>
@endpush

