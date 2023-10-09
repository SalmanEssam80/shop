@extends('layouts.app')
@section('content')

    <section class="user-dashboard page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    @include('user_menu')
                </div>
                @livewire('user-dashboard.index')
            </div>
        </div>
    </section>
@endsection
