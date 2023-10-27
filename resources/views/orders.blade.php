@extends('layouts.app')
@section('content')

    <section class="user-dashboard page-wrapper">
        <div class="container">
            <div class="row">
                @include('user_menu')
                @livewire('user-dashboard.orders')
            </div>
        </div>
    </section>

@endsection
