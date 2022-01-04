@extends('auth.layout')

@section('content')

<div class="page-header-image"></div>

<div class="content-center">
    <div class="container">

        <div class="col-md-4 content-center">
            <div class="card card-login card-plain mb-0">
                <form class="form" method="POST" action="{{ route('frontend.auth.register.post') }}">
                    {{ csrf_field() }}

                    <div class="header header-primary text-center">
                        <div class="logo-container">
                            <img src="{{asset('img/logo.png')}}" alt="">
                        </div>
                        <h5>
                            Create an Account
                        </h5>

                        @include('flash::message')
                        <!-- Errors block -->
                        @include('frontend.includes.errors')
                        <!-- / Errors block -->

                    </div>
                    <div class="content">
                        <div class="input-group mb-3 input-lg {{ $errors->has('first_name') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="input-first_name"><i class="fas fa-user"></i></span>
                            </div>
                            <input id="name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" aria-label="First Name" aria-describedby="input-first_name" required>
                        </div>

                        <div class="input-group mb-3 input-lg {{ $errors->has('last_name') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="input-last_name"><i class="fas fa-user"></i></span>
                            </div>
                            <input id="name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" aria-label="Last Name" aria-describedby="input-last_name" required>
                        </div>

                        <div class="input-group mb-3 input-lg {{ $errors->has('email') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="input-email"><i class="fas fa-at"></i></span>
                            </div>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email address" aria-label="Email" aria-describedby="input-email" required>
                        </div>

                        <div class="input-group mb-3 input-lg {{ $errors->has('password') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="input-password"><i class="fas fa-key"></i></span>
                            </div>
                            <input id="password" type="password" class="form-control" name="password" placeholder="Password" aria-label="Password" aria-describedby="input-password" required>
                        </div>

                        <div class="input-group mb-3 input-lg {{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="input-password_confirmation"><i class="fas fa-key"></i></span>
                            </div>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Password" aria-label="Password" aria-describedby="input-password_confirmation" required>
                        </div>
                    </div>
                    <div class="footer text-center py-0">
                        <button type="submit" class="btn btn-primary btn-round btn-block">Create Account</button>
                    </div>
                    <div class="pull-left">
                        <h6>
                            <a href="{{ route('frontend.auth.login') }}" class="link">Login to Account</a>
                        </h6>
                    </div>
                    <div class="float-right">
                        <h6>
                            <a href="{{route('frontend.auth.password.email')}}" class="link">Need Help?</a>
                        </h6>
                    </div>
                </form>
            </div>

            @include('auth.social_login_buttons')
        </div>
    </div>
</div>

@endsection
