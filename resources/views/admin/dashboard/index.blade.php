@extends('admin.default')

@section('content')


        {{--<div class="masonry-item  w-100 text-center">--}}
            {{--<div class="row gap-20">--}}

                {{--News--}}
                {{--<div class='col-md-3'>--}}
                    {{--<div class="layers bd bgc-white p-20">--}}
                        {{--<div class="layer w-100 mB-10">--}}
                            {{--<h6 class="lh-1">{{ trans('app.News') }}</h6>--}}
                        {{--</div>--}}

                        {{--<div class="layer w-100">--}}
                            {{--<div class="peers ai-sb fxw-nw">--}}
                                {{--<div class="peer peer-greed">--}}
                                    {{--<span id="sparklinedash3"></span>--}}
                                {{--</div>--}}
                                {{--<div class="peer">--}}
                                    {{--<span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-purple-50 c-purple-500">{{--}}
                                        {{--$countNews }}</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--Section Content--}}
                {{--<div class='col-md-3'>--}}
                    {{--<div class="layers bd bgc-white p-20">--}}
                        {{--<div class="layer w-100 mB-10">--}}
                            {{--<h6 class="lh-1">{!! trans('app.Setting') !!}</h6>--}}
                        {{--</div>--}}
                        {{--<div class="layer w-100">--}}
                            {{--<div class="peers ai-sb fxw-nw">--}}
                                {{--<div class="peer peer-greed">--}}
                                    {{--<span id="sparklinedash4"></span>--}}
                                {{--</div>--}}
                                {{--<div class="peer">--}}
                                    {{--<span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-blue-50 c-blue-500">{{--}}
                                        {{--$countSection }}</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        <hr>

        {{--layout--}}
        <div>
            @include('admin.dashboard.pagelayout')
        </div>
@endsection
