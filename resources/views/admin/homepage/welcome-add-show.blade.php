@extends('layouts.main')

@section('content')


<form action="{{route('add-to-homepage')}}" method="POST">
<div class="container">
    <form action="{{route('add-to-homepage')}}" method="POST">
        {{@csrf_field()}}
        <label for="name"><b><u>Select for HomePage:</u></b> </label>
    <div class="row">
        @foreach($show_media->all_image as $s)
                        <input type="hidden" value="{{$s->id}}" name="list[]">
            <div class="col-md-3">
                <input type="checkbox" name="image_id[]" value="{{$s->id}}"

                       @if(count($selected)>0)
                          @foreach ($selected as $select)
                             @if ($s->id==$select)
                                checked
                             @endif
                           @endforeach
                        @endif
                >
                    <div class="gallery-container">
                        <div id="myBtn_{{$s->id}}" onclick="showModal({{$s->id}})" class="gallery-single-container">
                            <img src="{{url($s->thumbnail_image->thumbnail_file)}}" class="gallery-single-image">
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
                                    <img src="{{url($s->image_file)}}" class="modal-image">
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
            <input type="submit" class="btn btn-primary" value="Add">
        </form>
    <div class="detail-container">
        <div class="row">
            <div class="col-10"><h1>{{$show_media->title}}</h1></div>
            <div class="col-2">
                @if($show_media->permission==1)
                    <p class="status-msg">Status: <span
                                style="color:#fff; background-color: #dcd41a; padding: 5px;">{{'Pending'}}</span>
                    </p>
                    <br>
                @elseif($show_media->permission==2)

                    <p class="status-msg">Status: <span
                                style="color:#fff; background-color: #51a126; padding: 5px;">{{'Approved'}}</span>
                    </p><br>
                @elseif($show_media->permission==3)
                    <p class="status-msg"><span
                                style="color:#fff; background-color: red; padding: 5px;">{{'Rejected'}}</span>
                    </p>
                    <br>
                @endif
            </div>
        </div>


        <div class="row">
            <div class="col-8">
                <p>{!!$show_media->info!!}</p>
                <i class="far fa-clock"></i>&nbsp;
                Uploaded at:
                </span>{{$show_media->created_at}}
                </br>
                <i class="fas fa-list"></i><span class="label"> <b>Category:</b></span>
                @foreach($show_media->category_media as $c)
                    <span class="badge badge-info">{{$c->category->name}}</span>
                @endforeach<br>
                <i class="fas fa-registered"></i><span class="label"> <b>License:</b></span>
                @foreach ($show_media->license as $l)
                    <span class="badge badge-pink">{{$l->license->name}}</span>
                @endforeach
            </div>
            <div class="col-4">
                <i class="fas fa-map"></i><span class="label"> <b>Location:</b></span>
                {{$show_media->location}}<br>
                <i class="fas fa-camera"></i><span class="label"> <b>Content Owner:</b></span>
                {{$show_media->author_name}}<br>


                <div class="tags">
                    @foreach($show_media->tag as $t)
                        <p><span class="badge badge-success">{{$t->name}}</span></p>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
    <input type="hidden" id="latitude" name="latitude" value="{{$show_media->latitude}}" class="form-control">
    <input type="hidden" id="longitude" name="longitude" value="{{$show_media->longitude}}" class="form-control">
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