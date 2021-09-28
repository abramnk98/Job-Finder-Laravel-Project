@extends('user.layouts.app')

@section('page-title', ' | Job Requests')

@section('content')
    <div class="site-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-5 mb-md-0 mt-5" data-aos="fade-up" data-aos-delay="100">
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
                                <div class="job-category align-self-center pr-2" style="flex:0 0 185px!important;">
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

            </div>
        </div>
    </div>
@endsection
