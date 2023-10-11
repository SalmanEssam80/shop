@extends('layouts.app')
@section('content')

    <section class="user-dashboard page-wrapper">
        <div class="container">
            <div class="row">
                @include('user_menu')
                <div class="col-md-12">
                    <div class="dashboard-wrapper dashboard-user-profile">
                        <div class="media">
                            <div class="pull-left text-center" href="#!">
                                <img class="media-object user-img" src="image/avater.jpg" alt="Image">
                                <a href="#" class="btn btn-transparent mt-20">Change Image</a>
                            </div>
                            <div class="media-body">
                                <ul class="user-profile-list">
                                    <li><span>Full Name:</span>Johanna Doe</li>
                                    <li><span>Country:</span>USA</li>
                                    <li><span>Email:</span>mail@gmail.com</li>
                                    <li><span>Phone:</span>+880123123</li>
                                    <li><span>Date of Birth:</span>Dec , 22 ,1991</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
