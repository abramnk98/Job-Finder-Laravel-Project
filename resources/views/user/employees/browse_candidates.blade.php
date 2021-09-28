@extends('user.layouts.app')

@section('page-title', '| Browse Candidates')

@section('content')
<div style="height: 113px;"></div>

<div class="site-blocks-cover overlay" style="background-image: url('{{asset('assets/images/hero_1.jpg')}}');" data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12" data-aos="fade">
                <h1>Browse Candidate</h1>
                <form id="findJobForm">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-9">
                            <div class="row">
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
            <div class="col-md-12 mb-5 mb-md-0 mt-5" data-aos="fade-up" data-aos-delay="100">
                <h2 class="mb-5 h3">Candidates</h2>
                <div class="rounded border jobs-wrap">
                    @php
                        $job_type = [
                            "Freelance" => ['warning', 'freelance'],
                            "Full Time" => ['info', 'fulltime'],
                            "Part Time" => ['danger', 'partime'],
                        ];
                    @endphp

                    @foreach($candidates as $candidate)
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
            formData += '&ajax=';

            $.ajax({
                url: "{{route('employee.browse-candidates')}}",
                method: "GET",
                data: formData,
                success: function (data) {

                    let candidateTableHTML = '';

                    $.each(data, function (key, candidate) {

                        let location = candidate.location;
                        candidateTableHTML += '<div class="job-item d-block d-md-flex align-items-center  border-bottom">' +
                            '<div class="company-logo blank-logo text-center text-md-left pl-3">' +
                            '<img src="{{url('assets/images/candidate_photo')}}/' + candidate.photo + '" alt="Image" class="img-fluid mx-auto">' +
                            '</div>' +
                            '<div class="job-details h-100">' +
                            '<div class="p-3 align-self-center">' +
                            '<h3>' + candidate.user.name + '</h3>' +
                            '<div class="d-block d-lg-flex">' +
                            '<div class="mr-3"><span class="icon-room mr-1"></span>' + location.building + ' St.' + location.street + ' ' + location.region + ',' + location.city + ',' + location.country + '</div>' +
                            '<div class="mr-3"><span class="icon-room mr-1"></span>' + candidate.phone + '</div>' +
                            '</div>' +
                            '</div>'+
                            '</div>'+
                            '</div>';
                    })


                    $('.jobs-wrap').html(candidateTableHTML);
                },
                error: function (data) {

                    $.each(data.responseJSON.errors, function (key, error) {

                        let candidateTableHTML = '';

                        $('.validate.' + key).html(error);

                        $('.jobs-wrap').html(candidateTableHTML);
                    })

                }
            })
        })
    </script>
@endpush
