<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/np_gov.png') }}">
    <title>
        {{ trans('app.Digital Notice Board') }}
        {{--{{ config('app.name', 'Laravel') }}--}}
    </title>

    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <script> </script>
    @yield('style')
</head>
<body class="app">
@yield('content')


@yield('script')

</body>
</html>
