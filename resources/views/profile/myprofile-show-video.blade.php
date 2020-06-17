@extends('layouts.main')

@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/home') }}">Home</a></li>
            <li><a href="{{url('/profile-media') }}">My Profile</a></li>
            <li>{{$show_video->title}}</li>
        </ul>
        <div class="row">
            @foreach($show_video->all_video as $s)
                {{--            {{dd($s)}}--}}
                <div class="col-md-3">
                    <div class="gallery-container">
                        <div id="myBtn_{{$s->id}}" onclick="showModal({{$s->id}})" class="gallery-single-container">
                            {{--<img src="{{url($s->video_file)}}" class="gallery-single-image">--}}
                            <video alt="User Pic" src="{{url($s->video_file)}}" style="margin: 2px" class="gallery-video" height="100%" width="100%"/>
                        </div>
                    </div>
                    <!-- The Modal -->
                    <div id="myModal_{{$s->id}}" class="modal">

                        <!-- Modal content -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="close" onclick="closeModal({{$s->id}})">&times;</span>
                            </div>
                            <div class="modal-body">
                                <div class="modal-image-container">
                                    <video alt="User Pic" src="{{url($s->video_file)}}" style="margin: 2px" class="gallery-video" height="100%" width="100%" type="video/mp4" controls/>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <h3>Modal Footer</h3>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
        <div class="detail-container">
            <div class="row">
                <div class="col-10"><h1>{{$show_video->title}}</h1></div>
            </div>

            <div class="row">
                <div class="col-8">
                    <p>{!!$show_video->info!!}</p>

                    <i class="far fa-clock"></i>&nbsp;
                    Uploaded at:
                    </span>{{$show_video->created_at}}
                    </br>
                    <i class="fas fa-list"></i><span class="label"> <b>Category:</b></span>
                    @foreach($show_video->category_media as $t)
                        <span class="badge badge-info">{{$t->category->name}}</span>
                    @endforeach<br>
                    <i class="fas fa-registered"></i><span class="label"> <b>License:</b></span>
                    @foreach ($show_video->license as $l)
                        <span class="badge badge-pink">{{$l->license->name}}</span>
                    @endforeach
                </div>
                <div class="col-4">
                    <i class="fas fa-map"></i><span class="label"> <b>Location:</b></span>
                    {{$show_video->location}}<br>
                    <i class="fas fa-camera"></i><span class="label"> <b>Content Owner:</b></span>
                    {{$show_video->author_name}}<br>


                    <div class="tags">
                        @foreach($show_video->tag_video as $t)
                            <p><span class="badge badge-success">{{$t->name}}</span></p>
                        @endforeach
                    </div>
                    @if($show_video->permission==1)
                        <div class="btn-group">
                            <a href="{{route('video.edit',$show_video->id)}}" class="btn btn-success">Edit</a><br>
                            <form id="delete-video_{{$show_video->id}}" action="{{route('video.edit',$show_video->id)}}" method="post">
                                {{csrf_field()}}
                                {{method_field('delete')}}
                                <button type="button" class="btn btn-danger" onclick="confirmDelete('{{$show_video->id}}')">Delete</button>
                            </form>
                        </div>
                    @endif
                </div>

            </div>
        </div>
        <input type="hidden" id="latitude" name="latitude" value="{{$show_video->latitude}}" class="form-control">
        <input type="hidden" id="longitude" name="longitude" value="{{$show_video->longitude}}" class="form-control">
        <label for="map_canvas">Location:</label>
        <div id='map' style="width: 50%; height: 500px;"></div>

    </div>
@endsection
@section('script')
    <script>
        var lat = document.getElementById('latitude').value;
        var long = document.getElementById('longitude').value;
        mapboxgl.accessToken = 'pk.eyJ1IjoibnRiMjAxOSIsImEiOiJjanVjZnlvbmwwNXVrNDRwOHo5N2RsdGw5In0.Dpepc7BGD-6hd2B4uCDbzA';
        var coordinates = document.getElementById('coordinates');
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [long, lat],
            zoom: 10
        });

        var marker = new mapboxgl.Marker({
            draggable: false
        })
            .setLngLat([long, lat])
            .addTo(map);

    </script>
    <script>
        function confirmDelete(item_id) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover it!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#delete-video_'+item_id).submit();
                    } else {
                        swal("Cancelled Successfully");
                    }
                });
        }

    </script>
    <script>
        function showModal(id) {
            var modal = document.getElementById('myModal_' + id);
            modal.style.display = "block";
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }

        function closeModal(id) {
            var modal = document.getElementById('myModal_' + id);
            var span = document.getElementsByClassName("close")[0];
            modal.style.display = "none";
        }
    </script>
@stop
