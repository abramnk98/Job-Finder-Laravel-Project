@extends('user.layouts.app')

@section('page-title', ' | Job Posts')

@section('content')
    <div style="height: 113px;"></div>

    <div class="unit-5 overlay" style="background-image: url('{{asset('assets/images/hero_1.jpg')}}');" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12" data-aos="fade">
                    <h1>Find Job</h1>
                    <form action="{{route('jobs.index')}}" method="get" id="findJobForm">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4 mb-3 mb-md-0">
                                        <input type="text" name="title_or_company" class="mr-3 form-control border-0 px-4" placeholder="job title, keywords or company name ">
                                        <small class="alert-danger validate title_or_company"></small>
                                    </div>
                                    <div class="col-md-4 mb-3 mb-md-0 ">
                                        <select class="form-control categories-select" name="category">
                                            <option value="">--choose category--</option>
                                        </select>
                                        <small class="alert-danger validate category"></small>
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

    <div class="site-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-5 mb-md-0" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="my-4 h3">Find Your Job</h2>
                    <div class="rounded border jobs-wrap">
                    @php
                        $job_type = [
                            "Freelance" => ['warning', 'freelance'],
                            "Full Time" => ['info', 'fulltime'],
                            "Part Time" => ['danger', 'partime'],
                        ];
                    @endphp

                    @foreach($jobs as $job)
{{--                        {{dd($job->user->employeeProfile->logo)}}--}}
                        <a href="{{route('jobs.show', ["job" => $job->id])}}" class="job-item d-block d-md-flex align-items-center  border-bottom {{$job_type[$job->type][1]}}">
                            <div class="company-logo blank-logo text-center text-md-left pl-3">
                                <img src="{{asset('assets/images/company_logo/'.$job->user->employeeProfile->logo)}}" alt="Image" class="img-fluid mx-auto">
                            </div>
                            <div class="job-details h-100">
                                <div class="p-3 align-self-center">
                                    <h3>{{$job->title}}</h3>
                                    <div class="d-block d-lg-flex">
                                        <div class="mr-3"><span class="icon-suitcase mr-1"></span> {{$job->user->employeeProfile->company_name}}</div>
                                        <div class="mr-3"><span class="icon-room mr-1"></span> {{$job->location->city}}</div>

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

                </div>

            </div>
        </div>
    </div>
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
    })

    $('#findJobForm').submit(function (e) {
        e.preventDefault();
        $('.validate').html('');
        let formData = $('form').serialize();
        formData += '&jobs_page=';

        $.ajax({
            url: "{{route('jobs.index')}}",
            method: "GET",
            data: formData,
            success: function (data) {
                let job_type = {
                    "Freelance": ['warning', 'freelance'],
                    "Full Time": ['info', 'fulltime'],
                    "Part Time": ['danger', 'partime'],
                };
                let jobsTableHtml = '';

                $.each(data, function (key, job) {

                    jobsTableHtml += '<a href="{{url('jobs')}}/'+job.id+'" class="job-item d-block d-md-flex align-items-center  border-bottom '+job_type[job.type][1]+'">'+
                    '<div class="company-logo blank-logo text-center text-md-left pl-3">'+
                    '<img src="{{url('assets/images/company_logo')}}/'+job.user.employee_profile.logo+'" alt="Image" class="img-fluid mx-auto">'+
                    '</div>'+
                    '<div class="job-details h-100">'+
                    '<div class="p-3 align-self-center">'+
                    '<h3>'+job.title+'</h3>'+
                    '<div class="d-block d-lg-flex">'+
                    '<div class="mr-3"><span class="icon-suitcase mr-1"></span> '+job.user.employee_profile.company_name +'</div>'+
                    '<div class="mr-3"><span class="icon-room mr-1"></span>'+ job.location.city+'</div>';

                    if(job.min_salary !== null && job.max_salary !== null) {
                        jobsTableHtml += '<div><span class="icon-money mr-1"></span>'+ job.min_salary + '- ' + job.max_salary+'</div>';
                    }
                    else if (job.min_salary !== null) {
                        jobsTableHtml += '<div><span class="icon-money mr-1"></span> '+ job.min_salary + '</div>';
                    }
                    else if (job.max_salary !== null) {
                        jobsTableHtml += '<div><span class="icon-money mr-1"></span> '+ job.max_salary + '</div>';
                    }

                    jobsTableHtml += '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="job-category align-self-center">'+
                    '<div class="p-3">'+
                    '<span class="text-' + job_type[job.type][0] + ' p-2 rounded border border-' + job_type[job.type][0] + '">' +job.type + '</span>'+
                    '</div>'+
                    '</div>'+
                    '</a>';
                })


                $('.jobs-wrap').html(jobsTableHtml);
            },
            error: function (data) {

                $.each(data.responseJSON.errors, function (key, error) {

                    let jobsTableHtml = '';

                    $('.validate.' + key).html(error);

                    $('.jobs-wrap').html(jobsTableHtml);
                })

            }
        })
    })
</script>
@endpush
