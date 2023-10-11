@extends('layouts.app')
@section('content')
    <section class="page-wrapper">
        <div class="contact-section">
            <div class="container">
                <div class="row">
                @livewire('contact-us')
                    <!-- Contact Details -->
                    <div class="contact-details col-md-6 " >
                        <div class="google-map">
                            <div id="map"></div>
                        </div>
                        <ul class="contact-short-info" >
                            <li>
                                <i class="tf-ion-ios-home"></i>
                                <span>cairo ,egypt</span>
                            </li>
                            <li>
                                <i class="tf-ion-android-phone-portrait"></i>
                                <span>Phone: +201231231234</span>
                            </li>
                            <li>
                                <i class="tf-ion-android-mail"></i>
                                <span>Email: hello@example.com</span>
                            </li>
                        </ul>
                        <!-- Footer Social Links -->
                        <div class="social-icon">
                            <ul>
                                <li><a class="fb-icon" href="https://www.facebook.com"><i class="tf-ion-social-facebook"></i></a></li>
                                <li><a href="https://www.twitter.com"><i class="tf-ion-social-twitter"></i></a></li>
                                <li><a href="https://www.youtube.com/"><i class="tf-ion-social-youtube"></i></a></li>
                                <li><a href="https://www.google.com/"><i class="tf-ion-social-google"></i></a></li>
                                <li><a href="https://www.github.com/"><i class="tf-ion-social-github"></i></a></li>
                            </ul>
                        </div>
                        <!--/. End Footer Social Links -->
                    </div>
                    <!-- / End Contact Details -->



                </div> <!-- end row -->
            </div> <!-- end container -->
        </div>
    </section>


@endsection
