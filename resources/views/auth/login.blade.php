@extends('layouts.main')

@section('content')
    <body class="authentication-bg authentication-bg-pattern">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-pattern">

                        <div class="card-body p-4">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if (session('warning'))
                                <div class="alert alert-warning">
                                    {{ session('warning') }}
                                </div>
                            @endif
                            <div class="text-center w-75 m-auto">
                                <a href="index.html">
                                    <span><img src="assets/images/logo-dark.png" alt="" height="22"></span>
                                </a>
                                <p class="text-muted mb-4 mt-3">Enter your email address and password to access dashboard panel.</p>
                            </div>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="emailaddress">Email address</label>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                {{--<div class="form-group mb-3">--}}
                                    {{--<div class="custom-control custom-checkbox">--}}
                                        {{--<input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>--}}
                                        {{--<label class="custom-control-label" for="checkbox-signin">Remember me</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif

                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-primary btn-block" type="submit">  {{ __('Login') }} </button>
                                </div>
                                <div class="form-group mb-0 text-center">
                                    <br>
                                    <a href="{{url('register')}}" class="btn btn-warning btn-block">{{ __('Register') }}</a>
                                    {{--<button  >  {{ __('Register') }} </button>--}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </body>
@endsection
