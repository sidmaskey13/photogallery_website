@extends('layouts.welcome-main')

@section('welcome-content')
    <div class="parallax">
        <div class="caption">
            <span class="border">Nepal Tourism Board</span>
        </div>
    </div>


    <div class="content">
        <div style="height: 1px"> </div>
        <div class="container">
            <div class="wrap">
                <label class="sr-only" for="inlineFormInputGroupUsername">Search</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-search fa-1x" aria-hidden="true"></i></div>
                    </div>
                    <input type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="Search Image or Video" onchange="search(this)">
                </div>

            </div>


            <div class="row">
                <div class="panel panel-default">
                    <div style="height: 20px"></div>
                    <div id="LoadingImage" style="display: none">
                        <h1>Loading...</h1>
                    </div>
                    <div id="result">
                    </div>

                </div>
            </div>
        <div id="homepage_img">

                @if($selected)
                    <div class="row">
                    @foreach($selected as $s)
                            <div class="col-md-3">
                                <div class="gallery-container">
                                    <div id="myBtn_{{$s->id}}" onclick="showModal({{$s->id}})" class="gallery-single-container">
                                        <img src="{{url($s->all_image_home->thumbnail_image->thumbnail_file)}}" class="gallery-single-image">
                                    </div>
                                </div>
                                <!-- The Modal -->
                                <div id="myModal_{{$s->id}}" class="modal">

                                    <!-- Modal content -->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5>{{$s->all_image_home->image_album->title}}</h5>
                                            <p class="modal-header-author">By: {{$s->all_image_home->image_album->author_name}}</p>
                                            <span class="close" onclick="closeModal({{$s->id}})">&times;</span>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-10"> <p>{!!$s->all_image_home->image_album->info!!}</p></div>
                                                <div class="col-md-2">  @if(Auth::check())
{{--                                                        <a href="{{url($s->all_image_home->watermark_image->watermark_file)}}" class="btn btn-primary" download>--}}
                                                            <a id="download" class="btn btn-primary" onclick="confirmDownload('{{url($s->all_image_home->watermark_image->watermark_file)}}')">

                                                            Download
                                                        </a>
                                                    @endif</div>
                                            </div>


                                            <div class="modal-image-container">
                                                <img src="{{url($s->all_image_home->watermark_image->watermark_file)}}" class="modal-image">
                                                {{--<img src="{{url($s->all_image_home->image_file)}}" class="modal-image">--}}
                                            </div>
                                        </div>
                                        <div class="modal-footer">

                                        </div>
                                    </div>
                                </div>
                            </div>


                        @endforeach
                    </div>
                @endif
        </div>
        </div>
    </div>


    @endsection
@section('script')
    <script>
        function search(btn) {
            if($(btn).val()!=''){
            $.ajax({
                type: 'get',
                url: '{{URL::to('result')}}',
                data: {'search': $(btn).val()},
                beforeSend: function() {
                    $("#LoadingImage").show();
                },
                success: function (data) {
                    $('#homepage_img').hide();
                    $('#result').html(data);
                    $('#result').show();
                    $("#LoadingImage").hide();

                }
            });}
            else{
                $('#homepage_img').show();
                $('#result').hide();
            }
        }
    </script>
    <script>

        function confirmDownload(id) {
            swal({
                title: "Please confirm",
                text: "Terms and Conditions for downloading photo",
                icon: "success",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    // window.open(id, '_blank');
                    window.open(id, '_blank');
                } else {
                    swal("Cancelled Successfully");
                }
            });

        }


    </script>
@stop


