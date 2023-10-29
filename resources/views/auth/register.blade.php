@extends('layouts.app')
@section('content')
    <section class="signin-page account">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="block text-center">
                        <a class="logo" href="{{ url('/') }}">
                            <h1 class="text-center">{{ config('app.name') }}</h1>
                        </a>
                        <h2 class="text-center">Create Your Account</h2>
                        <form class="text-left clearfix" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="name"
                                    class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                                    required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email"
                                    classs="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                                    required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password"
                                    class="@error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-main text-center">Sign In</button>
                            </div>
                        </form>
                        <p class="mt-20">Already have an account ?<a href="{{ route('login') }}"> Login</a></p>
                        @if (Route::has('password.request'))
                            <p><a href="{{ route('password.request') }}"> Forgot your password?</a></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
