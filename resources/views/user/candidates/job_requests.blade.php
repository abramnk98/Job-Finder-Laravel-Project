@extends('user.layouts.app')

@section('page-title', ' | Job Requests')

@section('content')
    <div class="site-section bg-light">
        <div class="container pt-4">
            <div class="row">
                <div class="col-md-12 mb-5 mb-md-0 mt-5" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="mb-5 h3">Job Requests</h2>
                    <div class="rounded border jobs-wrap">

                        @foreach($job_requests as $job)
                            <a href="{{route('jobs.show', ['job' => $job->id])}}" class="job-item d-block d-md-flex align-items-center  border-bottom">
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
                                    @if ($job->pivot->status === 'pending')
                                        <button type="text" class="btn btn-warning" disabled>Pending</button>
                                    @elseif ($job->pivot->status === 'accepted')
                                        <button type="text" class="btn btn-success" disabled>Accepted</button>
                                    @elseif ($job->pivot->status === 'refused')
                                        <button type="text" class="btn btn-danger" disabled>Refused</button>
                                    @endif
                                </div>
                            </a>
                        @endforeach

                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
