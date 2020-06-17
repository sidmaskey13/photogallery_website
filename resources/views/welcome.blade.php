@extends('layouts.custom')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/welcomeStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lightslider.css') }}">

    <style>

        {{--new section--}}
        #resizable {
            float: left;
            @if($getSec[0]['size']<0)
                display:none;
                width:0px;
            @elseif($getSec[0]['size']>90)
                width:100%;
            @else
                width: {{ $getSec[0]['size'] }}%;
            @endif
            background: #f6f6f6;
            height: 100%;
        }
        #content {
            @if($getSec[0]['size']>90)
                display:none;
            @else
                background: #eee;
                overflow: hidden;
                height: 100%;
                max-height: 100%;
            @endif
        }

        #sec2 {
            @if($getSec[1]['size']<0)
                display:none;
                height:0px;
            @else
                height: {{ $getSec[1]['size'] }}%;
            @endif
            max-height:100%;
        }

        #sec3 {
            @if($getSec[1]['size']>100)
                display:none;
                height:0px;
            @else
                height: {{ $getSec[1]['size'] }}%;
            @endif
            height:{{ $sec3 }}%;
            max-height:100%;
        }

        .lSPager{
            display: none;
        }
        .headerText{
            font-size: 4vh;
        }
        .h3, h3{
           font-size: 3vh;
        }
        .titleHeader{
            font-size: 2vh;
        }
        #textContent3{
            font-size: 1.5vh;
        }
    </style>
@stop

@section('content')
    <div class="row header1">
        {{--header--}}
        <div class="col-sm-3 logo-container">
            <img  class="logo" src="{{ asset('images/np_gov.png') }}" alt="">
        </div>
        <div class="col-sm-6 logo-container">
            <div class="header11 text-center">
                <h2 class="headerText">{{ $sendTitle }}</h2>

                <div class="headerApp">
                    <h3 class="headerText2">{{ trans('app.Digital Notice Board') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-sm-3 logo-container">
            <img class="logo" src="{{ asset('images/nepal_flag.gif') }}" alt="">
        </div>
        {{--header--}}
    </div>

    {{--sections--}}
    <div id="page" class="row">
        <div id="wrapper">
            {{--sec1--}}
            <div id="resizable" >
                <h1 id="testsection1" style="display: none">{{ $section1 }}</h1>
                <h1 id="testsectionImg" style="display: none"></h1>
                    
                    <div id="sec1File">
                        <div class="headerTextContent container">
                            <h1 class="titleHeader"></h1>
                        </div>
                        <div id="fileContent">
                            <iframe name="first-iframe" id="FileSec1" class="resp-iframe" src="{{ asset('js/pdfjs/web/viewer.html?file=') }}" frameborder="0"></iframe>
                        </div>
                    </div>

                    <div id="sec1Url">
                        <div class="headerTextContent container">
                            <h1 class="titleHeader"></h1>
                        </div>
                        <div id="fileContent">
                            <iframe id="vdo1" class="resp-iframe" src=""  frameborder="0" mute allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                    
                    <div id="sec1Content">
                        <div class="headerTextContent container">
                            <h1 class="titleHeader"></h1>
                        </div>
                        <div id="textContent" disabled>
                        </div>
                    </div>

                    <div id="sec1ImageFile">
                        <div class="headerTextContent container">
                            <h1 class="titleHeader"></h1>
                        </div>
                    </div>
            </div>

            {{--column 2--}}
            <div id="content">

                {{--sec2--}}
                <div id="sec2" class="bdwn">
                    <h1 id="testsection2" style="display: none;">{{ $section2 }}</h1>
                    <div id="sec2File">
                        <div class="headerTextContent container">
                            <h1 class="titleHeader"></h1>
                        </div>
                        <div id="fileContent2">
                            <iframe name="second-iframe" id="FileSec2" class="resp-iframe" src="{{ asset('js/pdfjs/web/viewer.html?file=')}}" frameborder="0"></iframe>
                        </div>
                    </div>

                    <div id="sec2Url">
                        <div class="headerTextContent container">
                            <h1 class="titleHeader"></h1>
                        </div>
                        <div id="fileContent2">
                            <iframe id="vdo2" class="resp-iframe" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                        </div>
                    </div>

                    <div id="sec2Content">
                        <div class="headerTextContent container">
                            <h1 class="titleHeader"></h1>
                        </div>
                        <div id="textContent2" disabled>
                        </div>
                    </div>

                    <div id="sec2ImageFile">
                        <div class="headerTextContent container">
                            <h1 class="titleHeader"></h1>
                        </div>
                    </div>

                </div>


                {{--sec3--}}
                <div id="sec3">
                    <h1 id="testsection3" style="display: none;">{{ $section3 }}</h1>

                    <div id="sec3File">
                        <div class="headerTextContent container">
                            <h1 class="titleHeader"></h1>
                        </div>
                        <div id="fileContent3">
                            <iframe name="third-iframe" id="FileSec3" class="resp-iframe" src="{{ asset('js/pdfjs/web/viewer.html?file=') }}" frameborder="0"></iframe>
                        </div>
                    </div>

                    <div id="sec3Url">
                        <div class="headerTextContent container">
                            <h1 class="titleHeader"></h1>
                        </div>
                        <div id="fileContent3">
                            <iframe id="vdo3" class="resp-iframe" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                    </div>

                    <div id="sec3Content">
                        <div class="headerTextContent container">
                            <h1 class="titleHeader"></h1>
                        </div>
                        <div id="textContent3">
                        </div>
                    </div>

                    <div id="sec3ImageFile">
                        <div class="headerTextContent container">
                            <h1 class="titleHeader"></h1>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <div class="row newsdiv">
        <div class="col-sm-2 newsTitle newsfooter">
            {{ trans('app.Notice') }}/{{ trans('app.News') }}
        </div>
        <div class="col-sm-10">
            <div id="marquee">
                @foreach($views as $view)
                    <span class="icon-holder">
                        <i class="c-white-500 ti-rss"></i>
                    </span>&nbsp;<b>{{ $view->content }}</b>
                    &nbsp;
                @endforeach
            </div>
        </div>
    </div>
     
@endsection

@section('script')
    <script src="{{ asset('js/jquery-1.8.2.min.js') }}"></script>
    <script src="{{ asset('js/jquery.marquee.js') }}"></script>
    <script src="{{ asset('js/lightslider.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
@stop


{{----}}
