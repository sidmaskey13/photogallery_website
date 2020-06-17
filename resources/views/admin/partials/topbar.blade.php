@php
    $r = \Route::current()->getAction();
    $route = (isset($r['as'])) ? $r['as'] : '';
@endphp
<link rel="stylesheet" href="{{ asset('css/pagelayoutcss.css') }}">

<style>

    .nav-text{
        color:white!important;
    }

</style>

<div style="width:100%;background-color:#002363;" class="header navbar">
    <div class="header-container">
        <ul class="nav-left">
            <li class="nav-item">
                <img style="height:50px; width:50px;" src="{{ asset('images/nepal_flag.gif') }}" alt="">
            </li>
            <li class="nav-item">
                <a style="color:white!important;font-weight: bold;" class="sidebar-link" href="{{ url('admin/') }}">
                    <span style="font-weight: bold" class="title">{!! trans('app.Digital Notice Board') !!}</span>
                </a>
            </li>
            {{--<li>--}}
                {{--<a id='sidebar-toggle' class="sidebar-toggle" href="javascript:void(0);">--}}
                    {{--<i class="ti-menu"></i>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li class="search-box">--}}
                {{--<a class="search-toggle no-pdd-right" href="javascript:void(0);">--}}
                    {{--<i class="search-icon ti-search pdd-right-10"></i>--}}
                    {{--<i class="search-icon-close ti-close pdd-right-10"></i>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li class="search-input">--}}
                {{--<input class="form-control" type="text" placeholder="Search...">--}}
            {{--</li>--}}
        </ul>
        <ul class="nav-right">

            {{--added--}}
            <li class="nav-item">
                <a class="sidebar-link" href="{{ url('admin/') }}">
                    <span class="icon-holder">
                        <i class="c-white-500 ti-home"></i>
                    </span>
                    <span class="title nav-text">{!! trans('app.HomePage') !!}</span>
                </a>
            </li>

           {{--<li class="nav-item">--}}
                {{--<a class="sidebar-link {{ starts_with($route, ADMIN . '.homesetting') ? 'active' : '' }}" href="{{ route(ADMIN . '.homesetting.index') }}">--}}
                    {{--<span class="icon-holder">--}}
                        {{--<i class="c-white-500 ti-settings"></i>--}}
                    {{--</span>--}}
                    {{--<span class="title nav-text">{!! trans('app.HomePage Setting') !!}</span>--}}
                {{--</a>--}}
            {{--</li>--}}

            <li class="nav-item">
                <a class="sidebar-link {{ starts_with($route, ADMIN . '.news') ? 'active' : '' }}" href="{{ route(ADMIN . '.news.index') }}">
                <span class="icon-holder">
                    <i class="c-white-500 ti-layout-media-overlay-alt-2"></i>
                </span>
                    <span class="title nav-text">{!! trans('app.News')!!}</span>
                </a>
            </li>

            {{--<li class="nav-item">--}}
                {{--<a class="sidebar-link {{ starts_with($route, ADMIN . '.users') ? 'active' : '' }}" href="{{ route(ADMIN . '.users.index') }}">--}}
                    {{--<span class="icon-holder">--}}
                        {{--<i class="c-white-500 ti-user"></i>--}}
                    {{--</span>--}}
                    {{--<span class="title nav-text">{!! trans('app.Users') !!}</span>--}}
                {{--</a>--}}
            {{--</li>--}}


            <li class="dropdown">
                <a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" data-toggle="dropdown">
                    <div class="peer mR-10">
                        <img class="w-2r bdrs-50p" src="{{ auth()->user()->avatar }}" alt="">
                    </div>
                    <div class="peer">
                        <span class="nav-text fsz-sm c-grey-900">{{ auth()->user()->name }}</span>
                    </div>
                </a>
                <ul class="dropdown-menu fsz-sm">
                    <li>
                        <a href="{{ route(ADMIN . '.users.edit', Auth::user()->id) }}" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                            <i class="ti-settings mR-10"></i>
                            <span>Setting</span>
                        </a>
                    </li>
                    {{--<li>--}}
                        {{--<a href="" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">--}}
                            {{--<i class="ti-user mR-10"></i>--}}
                            {{--<span>Profile</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">--}}
                            {{--<i class="ti-email mR-10"></i>--}}
                            {{--<span>Messages</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    <li role="separator" class="divider"></li>
                    <li>
                        <a href="/logout" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                            <i class="ti-power-off mR-10"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
