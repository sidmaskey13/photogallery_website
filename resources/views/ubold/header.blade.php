<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Nepal Tourism Board</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="_token" content="{{csrf_token()}}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>--}}
    <!-- App favicon -->
{{--    <link rel="shortcut icon" href="{{asset('ubold/assets/images/favicon.ico')}}">--}}

    <!-- plugin css -->
{{--    <link href="{{asset('ubold/assets/libs/jquery-vectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />--}}
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/css/bootstrap-select.min.css">

    <!-- App css -->
    <link href="{{asset('ubold/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('ubold/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('ubold/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('css/selectize.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/gallery.css')}}" rel="stylesheet" type="text/css" />
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.css' rel='stylesheet' />

</head>

<body>

<!-- Begin page -->
<div id="wrapper">

    <!-- Topbar Start -->
    <div class="navbar-custom">
        <ul class="list-unstyled topnav-menu float-right mb-0">


            @if(Auth::check())
                @role('admin')
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle  waves-effect waves-light" href="{{url('/notifications')}}">
                        <i class="fa fa-bell"></i>
                    </a>


                </li>
                @endrole

                <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="{{url('/')}}" role="button" aria-haspopup="false" aria-expanded="false">
                    @if(Auth()->user()->profile_picture!=null)
                        <img src="{{url(Auth()->user()->profile_picture->image_file)}}" alt="user-image" class="rounded-circle">
                    @else
                        <img src="{{asset('images/default-pic.jpg')}}" alt="user-image" class="rounded-circle">
                    @endif

                    <span class="pro-user-name ml-1">
                                {{''}} <i class="mdi mdi-chevron-down"></i>
                            </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    <a href="{{url('/profile')}}" class="dropdown-item notify-item">
                        <i class="fe-file"></i>
                        <span>Edit Profile</span>
                    </a>
                    <a href="{{url('/profile-media')}}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>My Profile</span>
                    </a>

                    {{--<div class="dropdown-divider"></div>--}}

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">

                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fe-log-out"></i> {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </a>

                </div>
            </li>


            @endif
        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="{{url('/')}}" class="logo text-center">
                        <span class="logo-lg">
                            <img src="{{url('ntb.png')}}" alt="" height="50">
                            <!-- <span class="logo-lg-text-light">UBold</span> -->
                        </span>
                <span class="logo-sm">
                            <!-- <span class="logo-sm-text-dark">U</span> -->
                            <img src="{{url('ntb.png')}}" alt="" height="50">
                        </span>
            </a>
        </div>


    </div>
</div>