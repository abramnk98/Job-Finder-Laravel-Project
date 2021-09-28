@extends('user.layouts.app')

@section('page-tile', $job->title)

@section('content')

@php
    $job_type = [
        "Freelance" => ['warning', 'freelance'],
        "Full Time" => ['info', 'fulltime'],
        "Part Time" => ['danger', 'partime'],
    ];
@endphp

<div style="height: 113px;"></div>

<div class="unit-5 overlay" style="background-image: url('{{asset("assets/images/hero_2.jpg")}}');">
    <div class="container text-center">
        <h2 class="mb-0">{{ucwords($job->title)}}</h2>
        <p class="mb-0 unit-6"><a href="{{route('home')}}">Home</a> <span class="sep">></span> <span>Job Item</span></p>
    </div>
</div>




<div class="site-section bg-light">
    <div class="container">
        <div class="row">

            <div class="col-md-12 col-lg-8 mb-5">



                <div class="p-5 bg-white">

                    <div class="mb-4 mb-md-5 mr-5">
                        <div class="job-post-item-header d-flex align-items-center">
                            <h2 class="mr-3 text-black h4">{{ucwords($job->title)}}</h2>
                            <div class="badge-wrap">
                                <span class="border border-{{$job_type[$job->type][0]}} text-{{$job_type[$job->type][0]}} py-2 px-4 rounded">{{$job->type}}</span>
                            </div>
                        </div>
                        <div class="job-post-item-body d-block d-md-flex">
                            <div class="mr-3"><span class="fl-bigmug-line-portfolio23"></span> <a href="#">{{ucwords($job->location->region)}}</a></div>
                            <div><span class="fl-bigmug-line-big104"></span> <span>{{ucwords($job->location->city)}}, {{$job->location->country}}</span></div>
                        </div>
                    </div>


                @if($job->image !== null)
                    <div class="img-border mb-5">
                            <img src="{{asset('assets/images/job/'.$job->image)}}" alt="Image" class="img-fluid rounded">
                    </div>
                @endif



                    <p>{{$job->description}}</p>

                    <p class="mt-5">
                    @guest
                        <form action="{{route('job.request')}}" method="post">

                            @csrf
                            <input type="text" value="{{$job->id}}" name="id" hidden>
                            <button href="#" class="btn btn-primary  py-2 px-4">Apply Job</button>
                        </form>
                    @endguest

                    @if(Auth::check() && auth()->user()->type == 'candidate')
                        @if ($current_candidate_request === null)

                            <form action="{{route('job.request')}}" method="post">

                                @csrf
                                <input type="text" value="{{$job->id}}" name="id" hidden>
                                <button href="#" class="btn btn-primary  py-2 px-4">Apply Job</button>
                            </form>
                        @elseif ($current_candidate_request->pivot->status === 'pending')

                            <form action="{{route('job.cancel-request')}}" method="post">
                                @csrf
                                <input type="text" name="id" value="{{$job->id}}"hidden>
                                <button type="text" class="btn btn-warning" disabled>{{$current_candidate_request->pivot->status}}</button>
                                <button type="submit" class="btn btn-danger">Cancel</button>
                            </form>

                        @elseif ($current_candidate_request->pivot->status === 'accepted')

                            <button type="text" class="btn btn-success" disabled>Accepted</button>
                        @elseif ($current_candidate_request->pivot->status === 'refused')

                            <button type="text" class="btn btn-danger" disabled>Refused</button>
                            {{--                            <div class="job-category align-self-center">--}}
{{--                                <div class="p-3">--}}
{{--                                    <span class="text-warning p-2 rounded border border-warning">{{$current_candidate_request->pivot->status}}</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        @endif
                    @endif

                    </p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="p-4 mb-3 bg-white">
                    <h3 class="h5 text-black mb-3">Contact Info</h3>
                    <p class="mb-0 font-weight-bold">Name</p>
                    <p class="mb-4">{{ucwords($job->user->name)}}</p>

                    @php $location = $job->location; @endphp

                    <p class="mb-0 font-weight-bold">Address</p>
                    <p class="mb-4"><a>{{ucwords($location->building).' St.'.ucwords($location->street).' '.ucwords($location->region).',' .ucwords($location->city).',' .ucwords($location->country)}}</a></p>

                    <p class="mb-0 font-weight-bold">Phone</p>
                    <p class="mb-4"><a href="#">0{{$job->user->employeeProfile->phone}}</a></p>

                </div>
            </div>
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

@push('script')
    <script>
        $(document).ready(function () {

            $.ajax({
                url: "{{route('frequently-questions.index.ajax')}}",
                method: "GET",
                success: function (data) {

                    let frequentlyQuestions = '';

                    $.each(data, function(key, row) {

                        frequentlyQuestions += '<div class="accordion-item">'+
                            '<h3 class="mb-0 heading">'+
                            '<a class="btn-block" data-toggle="collapse" href="#collapse'+key+'" role="button" aria-expanded="false" aria-controls="collapse'+key+'">' + row.question + '<span class="icon"></span></a>'+
                            '</h3>'+
                            '<div id="collapse'+key+'" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">'+
                            '<div class="body-text">'+
                            '<p>' + row.answer + '</p>'+
                            '</div>'+
                            '</div>'+
                            '</div> <!-- .accordion-item -->';
                    })

                    $('#accordion').html(frequentlyQuestions);
                    $("#collapse0").attr("class","show");
                }
            })
        })
    </script>
@endpush
