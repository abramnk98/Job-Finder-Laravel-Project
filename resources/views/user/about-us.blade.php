@extends('user.layouts.app')

@section('page-title', '| About Us')

@section('content')
        <div style="height: 113px;"></div>

        <div class="unit-5 overlay" style="background-image: url('{{asset("assets/images/hero_1.jpg")}}');">
            <div class="container text-center">
                <h2 class="mb-0">About Us</h2>
                <p class="mb-0 unit-6"><a href="index.html">Home</a> <span class="sep">></span> <span>About Us</span></p>
            </div>
        </div>


        <div class="site-section" data-aos="fade">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-5 mb-md-0">

                        <div class="img-border">
                                <img src="{{asset('assets/images/hero_1.jpg')}}" alt="Image" class="img-fluid rounded">
                            </a>
                        </div>

                    </div>
                    <div class="col-md-5 ml-auto">
                        <div class="text-left mb-5 section-heading">
                            <h2>About Us</h2>
                        </div>

                        <p class="mb-4 h5 font-italic lineheight1-5">&ldquo;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque, nisi Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit nobis magni eaque velit eum, id rem eveniet dolor possimus voluptas..&rdquo;</p>
                        <p>&mdash; <strong class="text-black font-weight-bold">John Holmes</strong>, Marketing Strategist</p>
                        <p><a href="https://vimeo.com/28959265" class="popup-vimeo text-uppercase">Watch Video <span class="icon-arrow-right small"></span></a></p>
                    </div>
                </div>
            </div>
        </div>


        <div class="site-section bg-light">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <!-- <div class="col-md-7 text-center"> -->
                    <div class="col-md-6 mx-auto text-center mb-5 section-heading">
                        <h2 class="mb-5">The Team</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum magnam illum maiores adipisci pariatur, eveniet.</p>
                    </div>

                    <!-- </div> -->
                </div>
                <div class="row team">
                    @foreach($team as $member)
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12" data-aos="fade" data-aos-delay="100">
                            <a href="#" class="person">
                                <img src="{{asset('assets/images/team') . '/' . $member->photo}}" alt="Image placeholder">
                                <h2>{{$member->name}}</h2>
                                <p>{{$member->job}}</p>
                            </a>
                        </div>
                    @endforeach
{{--                    <div class="col-lg-2 col-md-4 col-sm-6 col-12" data-aos="fade" data-aos-delay="200">--}}
{{--                        <a href="#" class="person">--}}
{{--                            <img src="images/person_2.jpg" alt="Image placeholder">--}}
{{--                            <h2>Mike Stellar</h2>--}}
{{--                            <p>CTO Co-founder</p>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-2 col-md-4 col-sm-6 col-12" data-aos="fade" data-aos-delay="300">--}}
{{--                        <a href="#" class="person">--}}
{{--                            <img src="images/person_3.jpg" alt="Image placeholder">--}}
{{--                            <h2>Gregg White</h2>--}}
{{--                            <p>VP Producer</p>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-2 col-md-4 col-sm-6 col-12" data-aos="fade" data-aos-delay="400">--}}
{{--                        <a href="#" class="person">--}}
{{--                            <img src="images/person_4.jpg" alt="Image placeholder">--}}
{{--                            <h2>Rogie Knitt</h2>--}}
{{--                            <p>Project Manager</p>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-2 col-md-4 col-sm-6 col-12" data-aos="fade" data-aos-delay="500">--}}
{{--                        <a href="#" class="person">--}}
{{--                            <img src="images/person_1.jpg" alt="Image placeholder">--}}
{{--                            <h2>Ben Koh</h2>--}}
{{--                            <p>Project Manager</p>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-2 col-md-4 col-sm-6 col-12" data-aos="fade" data-aos-delay="600">--}}
{{--                        <a href="#" class="person">--}}
{{--                            <img src="images/person_2.jpg" alt="Image placeholder">--}}
{{--                            <h2>Chris Stanworth</h2>--}}
{{--                            <p>Product Designer</p>--}}
{{--                        </a>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
        <!-- END section -->




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
                            @foreach($frequently_questions as $question)
                                <div class="accordion-item">
                                    <h3 class="mb-0 heading">
                                        <a class="btn-block" data-toggle="collapse" href="#collapseOne" role="button" aria-expanded="true" aria-controls="collapseOne">{{$question->question}}<span class="icon"></span></a>
                                    </h3>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="body-text">
                                            <p>{{$question->answer}}</p>
                                        </div>
                                    </div>
                                </div> <!-- .accordion-item -->
                            @endforeach
{{--                            <div class="accordion-item">--}}
{{--                                <h3 class="mb-0 heading">--}}
{{--                                    <a class="btn-block" data-toggle="collapse" href="#collapseTwo" role="button" aria-expanded="false" aria-controls="collapseTwo">How much pay for 3  months?<span class="icon"></span></a>--}}
{{--                                </h3>--}}
{{--                                <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">--}}
{{--                                    <div class="body-text">--}}
{{--                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel ad laborum expedita. Nostrum iure atque enim quisquam minima distinctio omnis, consequatur aliquam suscipit, quidem, esse aspernatur! Libero, excepturi animi repellendus porro impedit nihil in doloremque a quaerat enim voluptatum, perspiciatis, quas dignissimos maxime ut cum reiciendis eius dolorum voluptatem aliquam!</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div> <!-- .accordion-item -->--}}

{{--                            <div class="accordion-item">--}}
{{--                                <h3 class="mb-0 heading">--}}
{{--                                    <a class="btn-block" data-toggle="collapse" href="#collapseThree" role="button" aria-expanded="false" aria-controls="collapseThree">Do I need to register?  <span class="icon"></span></a>--}}
{{--                                </h3>--}}
{{--                                <div id="collapseThree" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">--}}
{{--                                    <div class="body-text">--}}
{{--                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel ad laborum expedita. Nostrum iure atque enim quisquam minima distinctio omnis, consequatur aliquam suscipit, quidem, esse aspernatur! Libero, excepturi animi repellendus porro impedit nihil in doloremque a quaerat enim voluptatum, perspiciatis, quas dignissimos maxime ut cum reiciendis eius dolorum voluptatem aliquam!</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div> <!-- .accordion-item -->--}}

{{--                            <div class="accordion-item">--}}
{{--                                <h3 class="mb-0 heading">--}}
{{--                                    <a class="btn-block" data-toggle="collapse" href="#collapseFour" role="button" aria-expanded="false" aria-controls="collapseFour">Who should I contact in case of support.<span class="icon"></span></a>--}}
{{--                                </h3>--}}
{{--                                <div id="collapseFour" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">--}}
{{--                                    <div class="body-text">--}}
{{--                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel ad laborum expedita. Nostrum iure atque enim quisquam minima distinctio omnis, consequatur aliquam suscipit, quidem, esse aspernatur! Libero, excepturi animi repellendus porro impedit nihil in doloremque a quaerat enim voluptatum, perspiciatis, quas dignissimos maxime ut cum reiciendis eius dolorum voluptatem aliquam!</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div> <!-- .accordion-item -->--}}

                        </div>
                    </div>
                </div>

            </div>
        </div>





        <footer class="site-footer">
            <div class="container">


                <div class="row">
                    <div class="col-md-4">
                        <h3 class="footer-heading mb-4 text-white">About</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat quos rem ullam, placeat amet.</p>
                        <p><a href="#" class="btn btn-primary pill text-white px-4">Read More</a></p>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="footer-heading mb-4 text-white">Quick Menu</h3>
                                <ul class="list-unstyled">
                                    <li><a href="#">About</a></li>
                                    <li><a href="#">Services</a></li>
                                    <li><a href="#">Approach</a></li>
                                    <li><a href="#">Sustainability</a></li>
                                    <li><a href="#">News</a></li>
                                    <li><a href="#">Careers</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h3 class="footer-heading mb-4 text-white">Categories</h3>
                                <ul class="list-unstyled">
                                    <li><a href="#">Full Time</a></li>
                                    <li><a href="#">Freelance</a></li>
                                    <li><a href="#">Temporary</a></li>
                                    <li><a href="#">Internship</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-2">
                        <div class="col-md-12"><h3 class="footer-heading mb-4 text-white">Social Icons</h3></div>
                        <div class="col-md-12">
                            <p>
                                <a href="#" class="pb-2 pr-2 pl-0"><span class="icon-facebook"></span></a>
                                <a href="#" class="p-2"><span class="icon-twitter"></span></a>
                                <a href="#" class="p-2"><span class="icon-instagram"></span></a>
                                <a href="#" class="p-2"><span class="icon-vimeo"></span></a>

                            </p>
                        </div>
                    </div>
                </div>
                <div class="row pt-5 mt-5 text-center">
                    <div class="col-md-12">
                        <p>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy; <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>document.write(new Date().getFullYear());</script> All Rights Reserved | This template is made with <i class="icon-heart text-warning" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>

                </div>
            </div>
        </footer>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>
    <script src="js/aos.js"></script>


    <script src="js/mediaelement-and-player.min.js"></script>

    <script src="js/main.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var mediaElements = document.querySelectorAll('video, audio'), total = mediaElements.length;

            for (var i = 0; i < total; i++) {
                new MediaElementPlayer(mediaElements[i], {
                    pluginPath: 'https://cdn.jsdelivr.net/npm/mediaelement@4.2.7/build/',
                    shimScriptAccess: 'always',
                    success: function () {
                        var target = document.body.querySelectorAll('.player'), targetTotal = target.length;
                        for (var j = 0; j < targetTotal; j++) {
                            target[j].style.visibility = 'visible';
                        }
                    }
                });
            }
        });
    </script>


    <script>
        // This example displays an address form, using the autocomplete feature
        // of the Google Places API to help users fill in the information.

        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

        var placeSearch, autocomplete;
        var componentForm = {
            street_number: 'short_name',
            route: 'long_name',
            locality: 'long_name',
            administrative_area_level_1: 'short_name',
            country: 'long_name',
            postal_code: 'short_name'
        };

        function initAutocomplete() {
            // Create the autocomplete object, restricting the search to geographical
            // location types.
            autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                {types: ['geocode']});

            // When the user selects an address from the dropdown, populate the address
            // fields in the form.
            autocomplete.addListener('place_changed', fillInAddress);
        }

        function fillInAddress() {
            // Get the place details from the autocomplete object.
            var place = autocomplete.getPlace();

            for (var component in componentForm) {
                document.getElementById(component).value = '';
                document.getElementById(component).disabled = false;
            }

            // Get each component of the address from the place details
            // and fill the corresponding field on the form.
            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
                if (componentForm[addressType]) {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                }
            }
        }

        // Bias the autocomplete object to the user's geographical location,
        // as supplied by the browser's 'navigator.geolocation' object.
        function geolocate() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var geolocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    var circle = new google.maps.Circle({
                        center: geolocation,
                        radius: position.coords.accuracy
                    });
                    autocomplete.setBounds(circle.getBounds());
                });
            }
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&libraries=places&callback=initAutocomplete"
            async defer></script>
@endsection
