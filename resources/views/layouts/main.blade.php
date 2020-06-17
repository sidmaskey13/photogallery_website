@include('ubold.header')

@if(Auth::check())
    @include('ubold.sidebar')
@endif

<div class="content-page">


            @include('layouts.message')
            @yield('content')


</div>

@if(Auth::check())
    @include('ubold.footer')
@endif