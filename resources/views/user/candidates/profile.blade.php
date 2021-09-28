@extends('user.layouts.app')

@section('page-title', 'Candidate Profile')

@section('content')
<div class="site-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mb-5 mb-md-0" data-aos="fade-up" data-aos-delay="100">
                <h2 class="mb-5 h3">Job Requests</h2>
                <div class="rounded border jobs-wrap recent-job-section">

                @foreach($job_requests as $job)
                    <a href="{{route('jobs.show', ["job" => $job->id])}}" class="job-item d-block d-md-flex align-items-center  border-bottom">
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

                <div class="col-md-12 text-center mt-5">
                    <a href="{{route('candidate.job-request.index')}}" class="btn btn-primary rounded py-3 px-5"><span class="icon-plus-circle"></span> Show More </a>
                </div>
            </div>
            <div class="col-lg-4 mt-4">
                <div class="p-4 mb-3 bg-white">
                    <h3 class="h5 text-black mb-3">Personal Information</h3>
                    <p class="mb-0 font-weight-bold">Name</p>
                    <p class="mb-4">{{ucwords(Auth::user()->name)}}</p>

                    @php $location = Auth::user()->candidateProfile->location; @endphp

                    <p class="mb-0 font-weight-bold">Address</p>
                    <p class="mb-4"><a>{{ucwords($location->building).' St.'.ucwords($location->street).' '.ucwords($location->region).',' .ucwords($location->city).',' .ucwords($location->country)}}</a></p>

                    <p class="mb-0 font-weight-bold">Phone</p>
                    <p class="mb-4"><a href="#">0{{Auth::user()->candidateProfile->phone}}</a></p>

                    <p class="mb-0 font-weight-bold">Email Address</p>
                    <p class="mb-0"><a href="#">{{Auth::user()->email}}</a></p>

{{--                    <div class="mt-3">--}}
                        <a class="btn btn-primary  py-2 px-4 mt-3" href="{{route('candidate.profile.edit', ['profile' => Auth::user()->candidateProfile->id])}}">Edit</a>
{{--                    </div>--}}
                    </div>
                </div>

            </div>
        </div>

        <div class="row justify-content-around">
            <div class="col-md-8">
                <div class="p-4 mb-3 bg-white">
                    <h2 class="h3">Testimony</h2>
                    @php $testimony = Auth::user()->candidateProfile->testimony; @endphp
                    <form action="@if($testimony === null) {{route('testimonies.store')}} @else {{route('testimonies.update', ['testimony' => $testimony->id])}} @endif" method="post">

                        @csrf
                        @if($testimony !== null)
                            @method('PUT')
                        @endif
                        <label for="testimony" class="form-label">Content</label>
                        <textarea type="text" class="form-control col-6" name="testimony_content">@if($testimony !== null) {{$testimony->content}} @endif</textarea>
                        <button type="submit" class="btn btn-primary py-2 px-4 mt-3">@if($testimony === null) {{'Add'}} @else {{'Update'}} @endif</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
