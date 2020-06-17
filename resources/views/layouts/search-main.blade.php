@include('ubold.header')


<div class="content-page">
    <div class="content">
        <div class="container">
            @include('layouts.message')
            @yield('content')
        </div>
    </div>
</div>

@include('ubold.footer')
