<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/np_gov.png') }}">
    <title>
        {{ trans('app.Digital Notice Board') }}
        {{--{{ config('app.name', 'Laravel') }}--}}
    </title>

    <!-- Styles -->
	<link href="{{ mix('/css/app.css') }}" rel="stylesheet">

	@yield('css')

</head>

<body class="app">

    @include('admin.partials.spinner')

        <!-- #Left Sidebar ==================== -->
{{--        @include('admin.partials.sidebar')--}}

        <!-- #Main ============================ -->
            <!-- ### $Topbar ### -->
            @include('admin.partials.topbar')

            <!-- ### $App Screen Content ### -->
            <main class='main-content bgcH-grey-50'>
                <div id='mainContent'>
                    <div class="container-fluid">

                        <h4 class="c-grey-900 mT-10 mB-30">@yield('page-header')</h4>

						@include('admin.partials.messages') 
						@yield('content')

                    </div>
                </div>
            </main>

            <!-- ### $App Screen Footer ### -->
            <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600">
                <span>Copyright © 2018 Developed by
                    <a href="http://www.upasarga.com" target='_blank' title="Upasarga Technology">Upasarga Technology</a>. All rights reserved.</span>
            </footer>


    <script src="{{ mix('/js/app.js') }}"></script>

    @yield('js')

</body>

</html>
