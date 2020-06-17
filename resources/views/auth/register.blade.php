@extends('layouts.main')

@section('content')


<body class="authentication-bg authentication-bg-pattern">

<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-pattern">

                    <div class="card-body p-4">

                        <div class="text-center w-75 m-auto">
                            <a href="index.html">
                                <span><img src="assets/images/logo-dark.png" alt="" height="22"></span>
                            </a>
                            <p class="text-muted mb-4 mt-3">Create an account to become an Uploader</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="emailaddress">Email address</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password-confirm">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                            </div>

                            <input type="hidden" class="form-control" name="type" value="3">

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block" type="submit">{{ __('Register') }}   </button>
                            </div>
                            <div class="form-group mb-0 text-center">
                                <br>
                                <a href="{{url('login')}}" class="btn btn-warning btn-block">{{ __('Login') }}</a>
                                {{--<button  >  {{ __('Register') }} </button>--}}
                            </div>

                        </form>



                    </div> <!-- end card-body -->
                </div>

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
</body>

@endsection
