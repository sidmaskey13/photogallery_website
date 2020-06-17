@php
    $r = \Route::current()->getAction();
    $route = (isset($r['as'])) ? $r['as'] : '';
@endphp

<li class="nav-item mT-30">
    <a class="sidebar-link {{ starts_with($route, ADMIN . '.dash') ? 'active' : '' }}" href="{{ route(ADMIN . '.dash') }}">
        <span class="icon-holder">
            <i class="c-blue-500 ti-home"></i>
        </span>
        <span class="title">{!! trans('app.Dashboard') !!}</span>
    </a>
</li>
{{--<li class="nav-item">--}}
    {{--<a class="sidebar-link {{ starts_with($route, ADMIN . '.users') ? 'active' : '' }}" href="{{ route(ADMIN . '.users.index') }}">--}}
        {{--<span class="icon-holder">--}}
            {{--<i class="c-brown-500 ti-user"></i>--}}
        {{--</span>--}}
        {{--<span class="title">{!! trans('app.Users') !!}</span>--}}
    {{--</a>--}}
{{--</li>--}}

<li class="nav-item">
    <a class="sidebar-link {{ starts_with($route, ADMIN . '.homesetting') ? 'active' : '' }}" href="{{ route(ADMIN . '.homesetting.index') }}">
        <span class="icon-holder">
            <i class="c-brown-500 ti-settings"></i>
        </span>
        <span class="title">{!! trans('app.HomePage Setting') !!}</span>
    </a>
</li>

<li class="nav-item">
    <a class="sidebar-link {{ starts_with($route, ADMIN . '.news') ? 'active' : '' }}" href="{{ route(ADMIN . '.news.index') }}">
        <span class="icon-holder">
            <i class="c-brown-500 ti-layout-media-overlay-alt-2"></i>
        </span>
        <span class="title">{!! trans('app.News')!!}</span>
    </a>
</li>

<li class="nav-item">
    <a class="sidebar-link {{ starts_with($route, ADMIN . '.sections') ? 'active' : '' }}" href="{{ route(ADMIN . '.sections.index') }}">
        <span class="icon-holder">
            <i class="c-brown-500 ti-layout-grid2"></i>
        </span>
        <span class="title">{!! trans('app.Setting') !!}</span>
    </a>
</li>