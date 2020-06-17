@extends('layouts.main')

@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/home') }}">Home</a></li>
            <li><a href="{{url('/approved-video') }}">Approved Video</a></li>
            <li>{{$video->title}}</li>
        </ul>
        <div class="row">
            @foreach($video->all_video as $s)
                <div class="col-md-3">
                    <div class="gallery-container">
                        <div id="myBtn_{{$s->id}}" onclick="showModal({{$s->id}})" class="gallery-single-container">
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
                <div class="col-10"><h1>{{$video->title}}</h1></div>
                <div class="col-2">
                    @if($video->permission==1)
                        <p class="status-msg">Status: <span
                                    style="color:#fff; background-color: #dcd41a; padding: 5px;">{{'Pending'}}</span>
                        </p>
                        <br>
                    @elseif($video->permission==2)

                        <p class="status-msg">Status: <span
                                    style="color:#fff; background-color: #51a126; padding: 5px;">{{'Approved'}}</span>
                        </p><br>
                    @elseif($video->permission==3)
                        <p class="status-msg"><span
                                    style="color:#fff; background-color: red; padding: 5px;">{{'Rejected'}}</span>
                        </p>
                        <br>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-8">
                    <p>{!!$video->info!!}</p>

                    <i class="far fa-clock"></i>&nbsp;
                    Uploaded at:
                    </span>{{$video->created_at}}
                    </br>
                    <i class="fas fa-list"></i><span class="label"> <b>Category:</b></span>
                    @foreach($video->category_media as $t)
                        <span class="badge badge-info">{{$t->category->name}}</span>
                    @endforeach<br>
                    <i class="fas fa-registered"></i><span class="label"> <b>License:</b></span>
                    @foreach ($video->license as $l)
                        <span class="badge badge-pink">{{$l->license->name}}</span>
                    @endforeach
                </div>
                <div class="col-4">

                    <i class="fas fa-map"></i><span class="label"> <b>Location:</b></span>
                    {{$video->location}}<br>
                    <i class="fas fa-camera"></i><span class="label"> <b>Content Owner:</b></span>
                    {{$video->author_name}}<br>


                    <div class="tags">
                        @foreach($video->tag_video as $t)
                            <p><span class="badge badge-success">{{$t->name}}</span></p>
                        @endforeach
                    </div>
                    <div class="btn-group">
                        <a href="{{url('edit-video/'.$video->id)}}" class="btn btn-primary">Edit</a>
                        <form id="delete-video_{{$video->id}}" action="{{URL::to('/approved-video/'.$video->id)}}" method="post">
                            {{csrf_field()}}
                            {{method_field('delete')}}
                            <button type="button" class="btn btn-danger" onclick="confirmDelete('{{$video->id}}')">Delete</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <input type="hidden" id="latitude" name="latitude" value="{{$video->latitude}}" class="form-control">
        <input type="hidden" id="longitude" name="longitude" value="{{$video->longitude}}" class="form-control">
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