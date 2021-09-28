@extends('user.layouts.app')

@section('page-title', 'Employee Profile')

@section('content')
<div class="site-section bg-light">
    <div class="container pt-4">
        <div class="row">
            <div class="col-md-8 mb-5 mb-md-0" data-aos="fade-up" data-aos-delay="100">
                <h2 class="mb-5 h3">Job Posts</h2>
                <div class="rounded border jobs-wrap recent-job-section">

                @php
                    $job_type = [
                        "Freelance" => ['warning', 'freelance'],
                        "Full Time" => ['info', 'fulltime'],
                        "Part Time" => ['danger', 'partime'],
                    ];
                @endphp
                @foreach($job_posts as $job)
                    <a href="{{route('jobs.edit', ["job" => $job->id])}}" class="job-item d-block d-md-flex align-items-center  border-bottom {{$job_type[$job->type][1]}}">
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
                    <a href="{{route('employee.posts')}}" class="btn btn-primary rounded py-3 px-5"><span class="icon-plus-circle"></span> Show More </a>
                </div>
            </div>
            <div class="col-lg-4 mt-4">
                <div class="p-4 mb-3 bg-white">
                    <h3 class="h5 text-black mb-3">Personal Information</h3>
                    <p class="mb-0 font-weight-bold">Name</p>
                    <p class="mb-4">{{ucwords(Auth::user()->name)}}</p>

                    <p class="mb-0 font-weight-bold">Company Name</p>
                    <p class="mb-4"><a>{{ucwords(Auth::user()->employeeProfile->company_name)}}</a></p>

                    <p class="mb-0 font-weight-bold">Phone</p>
                    <p class="mb-4"><a href="#">0{{Auth::user()->employeeProfile->phone}}</a></p>

                    <p class="mb-0 font-weight-bold">Email Address</p>
                    <p class="mb-0"><a href="#">{{Auth::user()->email}}</a></p>

{{--                    <div class="mt-3">--}}
                        <a class="btn btn-primary  py-2 px-4 mt-3" href="{{route('employee.profile.edit', ['profile' => Auth::user()->employeeProfile->id])}}">Edit</a>
{{--                    </div>--}}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="bg-light mb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-5 mb-md-0" data-aos="fade-up" data-aos-delay="100">
                <h2 class="mb-5 h3">Job Requests</h2>
                <div class="rounded border jobs-wrap">

                    @foreach($job_requests as $job_request)

                            <div class="job-item d-block d-md-flex align-items-center  border-bottom">
                                <div class="company-logo blank-logo text-center text-md-left pl-3">
                                    <img src="{{asset('assets/images/candidate_photo/'.$job_request->candidate->photo)}}" alt="Image" class="img-fluid mx-auto">
                                </div>
                                <div class="job-details h-100">
                                    <div class="p-3 align-self-center">
{{--                                        <h2>{{'<strong>' . $candidate->first_name . ' ' . $candidate->last_name . '</strong>  <strong>' .. '</strong>Job.'}}</h2>--}}
                                        <h3><strong>{{$job_request->candidate->first_name . ' ' . $job_request->candidate->last_name}}</strong> Request for apply Job <strong>{{$job_request->job->title }}</strong></h3>
                                        <div class="d-block d-lg-flex">
                                            @php $location = $job_request->candidate->location; @endphp
                                            <div class="mr-3"><span class="icon-room mr-1"></span> {{ucwords($location->building).' St.'.ucwords($location->street).' '.ucwords($location->region).',' .ucwords($location->city).',' .ucwords($location->country)}}</div>
                                            <div class="mr-3"><span class="icon-room mr-1"></span>0{{$job_request->candidate->phone}}</div>


                                        </div>
                                    </div>
                                </div>
                                    <div class="job-category align-self-center pr-2" style="flex:0 0 215px!important;">
                                        @if ($job_request->status === 'pending')

                                                <a href="{{route('employee.request-action', ['job_id' => $job_request->job->id, 'status' => 'accepted'])}}?candidate_id={{$job_request->candidate->id}}"  class="btn btn-success m-2">Accept</a>
                                                <a href="{{route('employee.request-action', ['job_id' => $job_request->job->id, 'status' => 'refused'])}}?candidate_id={{$job_request->candidate->id}}"  class="btn btn-danger">Refuse</a>
                                        @elseif ($job_request->status === 'accepted')
                                            <button type="text" class="btn btn-outline-success" disabled>Accepted</button>
                                        @elseif ($job_request->status === 'refused')
                                            <button type="text" class="btn btn-outline-danger" disabled>Refused</button>
                                        @endif
                                    </div>
                            </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-12 text-center mt-5">
                <a href="{{route('employee.job-request.index')}}" class="btn btn-primary rounded py-3 px-5"><span class="icon-plus-circle"></span> Show More </a>
            </div>
        </div>
    </div>
</div>
@endsection
