@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Change Detail</h1>
        <form method="POST" action="{{url('profile/'.$user->id)}}" enctype="multipart/form-data">
            {{@csrf_field()}}

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$user->name}}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$user->email}}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Leave empty if dont wanna change old password">

                    <input type="hidden" name="old_password" value="{{$user->password}}">

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Leave empty if dont wanna change old password">
                </div>
            </div>

            <div class="form-group row">
                <label for="old_img" class="col-md-4 col-form-label text-md-right">{{ __('Old Profile Picture') }}</label>
{{--                {{dd($old_img)}}--}}
                @if($user->profile_picture!=null)
                    <img src="{{url($user->profile_picture->image_file)}}" alt="" height="200px" width="175px">
                    @else
                    <h5>Default:</h5>
                    <img src="{{asset('images/default-pic.jpg')}}" alt="Default Img" height="200px" width="175px">
                    @endif
            </div>

            <div class="form-group row">
                <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('New Profile Picture') }}</label>

                <div class="col-md-6">
                    <input id="file" type="file" class="form-control" name="file">

                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Edit') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
