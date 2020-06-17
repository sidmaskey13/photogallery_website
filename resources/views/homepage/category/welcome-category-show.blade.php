@extends('layouts.welcome-category')

@section('welcome-content')
    {{--    <h1>Category: {{$media->category->name}}</h1>--}}
    <div class="container">


        <h1><b>Category: {{$c->name}}</b></h1>
        <h3><u>All Images</u></h3>

        @if (count($media)>0)
            <div class="row">
                @foreach($media as $s)
                    @foreach ($s->all_image as $i)
                        <div class="col-md-3">
                            <div class="gallery-container">
                                <div id="myBtn_{{$s->id}}" onclick="showModal({{$s->id}})"
                                     class="gallery-single-container">
                                    <img src="{{url($i->thumbnail_image->thumbnail_file)}}" class="gallery-single-image">
                                </div>
                            </div>
                            <!-- The Modal -->
                            <div id="myModal_{{$s->id}}" class="modal">

                                <!-- Modal content -->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5>{{$s->title}}</h5>
                                        <p class="modal-header-author">By: {{$s->author_name}}</p>
                                        <span class="close" onclick="closeModal({{$s->id}})">&times;</span>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-10"><p>{!!$s->description!!}</p></div>
                                            <div class="col-md-2">  @if(Auth::check())
                                                    <a id="download" class="btn btn-primary" onclick="confirmDownload('{{url($i->watermark_image->watermark_file)}}')">
                                                        Download
                                                    </a>
                                                @endif</div>
                                        </div>
                                        <div class="modal-image-container">
                                            <img src="{{url($i->watermark_image->watermark_file)}}" class="modal-image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        @else
            <h5>No Images</h5>
        @endif

        <hr>
        <h3><u>All Videos</u></h3>
        @if (count($video)>0)
            <div class="row">
                @foreach($video as $s)
                    @foreach ($s->all_video as $i)
                        <div class="col-md-3">
                            <div class="gallery-container">
                                <div id="myBtn_{{$s->id}}" onclick="showModal({{$s->id}})"
                                     class="gallery-single-container">
                                    <video alt="User Pic" src="{{url($i->video_file)}}" style="margin: 2px"
                                           class="gallery-single-image" />
                                </div>
                            </div>
                            <!-- The Modal -->
                            <div id="myModal_{{$s->id}}" class="modal">

                                <!-- Modal content -->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5>{{$s->title}}</h5>
                                        <p class="modal-header-author">By: {{$s->author_name}}</p>
                                        <span class="close" onclick="closeModal({{$s->id}})">&times;</span>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{$s->description}}</p>
                                        <div class="modal-image-container">
                                            <video alt="User Pic" src="{{url($i->video_file)}}" style="margin: 2px"
                                                   class="gallery-video" height="100%" width="100%" type="video/mp4"
                                                   controls/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        @else
            <h5>No Videos</h5>
        @endif
    </div>

@endsection


@section('script')

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