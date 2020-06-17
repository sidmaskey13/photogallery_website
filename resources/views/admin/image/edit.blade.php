@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Media</h1>


        <form method="POST" action="{{url('add-image/'.$edit_media->id)}}" enctype="multipart/form-data">
            {{@csrf_field()}}
            {{method_field('PUT')}}

            <div class="row">
                <div class="col-md-12">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" placeholder="Enter Media Title" name="title" value="{{$edit_media->title}}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="tag">Tag:</label>
                    <select name="tag_test[]"  id="input-tags" class="demo-default" multiple>
                        @foreach($tags as $t)
                            <option value="{{$t->name}}" @foreach ($edit_media->tag as $m)
                            @if($m->id==$t->id) selected
                                    @endif
                                    @endforeach >{{$t->name}}</option>
                        @endforeach
                    </select>
                    <label for="place">Location: </label>
                    <div class="row">
                        <div class="col-md-10">
                            <input type="text" name="place" id="place" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <span onclick="search()" class="btn btn-success">Search</span>
                        </div>
                    </div>
                    <br>
                    <label for="map_canvas">Location:</label>
                    <div id='map' style="width: 100%; height: 350px;"></div>
                </div>
                <div class="col-md-6">
                    <label for="category">Categories:</label><br>
                    <div class="category-box">
                        <div class="row">
                            @foreach ($categories as $c)
                                <div class="col-md-4">
                                    <input type="checkbox" value="{{$c->id}}" name="category[]" @foreach ($edit_media->category_media as $u)

                                    @if($u->category->id==$c->id)
                                    checked
                                            @endif
                                            @endforeach>
                                    <label for="category">
                                        {{$c->name}}
                                    </label>
                                </div>

                            @endforeach
                        </div>
                    </div>
                    <label for="license">License:</label><br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="category-box"><label for="">Modification:</label>

                                @foreach($license_modify as $f)

                                    <div class="col-md-12">
                                        <input type="radio" name="license_modify" value="{{$f->id}}"
                                               @foreach ($edit_media->license as $l)
                                               @if($l->license->id==$f->id)
                                               checked
                                                @endif
                                                @endforeach>
                                        <label for="">{{$f->name}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="category-box"><label for="">Usage:</label>
                                @foreach($license_usage as $f)

                                    <div class="col-md-12">
                                        <input type="radio" name="license_usage" value="{{$f->id}}"
                                               @foreach ($edit_media->license as $l)
                                               @if($l->license->id==$f->id)
                                               checked
                                                @endif
                                                @endforeach>
                                        <label for="">{{$f->name}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <label for="author_name">Author:</label>
                    <input type="text" class="form-control" id="author_name" placeholder="Enter Author Name"
                           name="author_name" value="{{$edit_media->author_name}}" required>
                </div>
            </div>


            <input type="hidden" id="latitude" name="latitude" value="{{$edit_media->latitude}}" class="form-control">
            <input type="hidden" id="longitude" name="longitude" value="{{$edit_media->longitude}}" class="form-control">
            <div class="row">
                <div class="col-md-8">
                    <label for="info">Info:</label>
                    <textarea class="info" name="info" id="info" rows="5">{{$edit_media->info}}</textarea>
                </div>
            </div>

            <br>
            <div class="form-group">
                <label for="image">Old Media:</label>
                <div class="row">
                    @foreach($edit_media->all_image as $s)
                        <div class="col-md-3" id="old-img-{{$s->id}}">
                            <div class="gallery-container">
                                <div id="myBtn_{{$s->id}}" onclick="showModal({{$s->id}})" class="gallery-single-container">
                                    <img src="{{url($s->image_file)}}" class="gallery-single-image">
                                </div>
                                <a onclick="delete_old_image({{$s->id}})" class="btn btn-danger" >Delete</a>

                            </div>
                        </div>

                    @endforeach
                </div>
                <label for="image">New Media:</label>
                <input type="file" name="file" class="form-control" id="image" >
                <input type="hidden" name="oldimage" value="{{$edit_media->media}}">
            </div>
            <br>
            <div>
                {{--<button type="submit" class="btn btn-primary">Update</button>--}}
                <input type="submit" class="btn btn-primary" value="Update">
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        var lat = document.getElementById('latitude').value;
        var long = document.getElementById('longitude').value;


        function search() {
            var place = document.getElementById("place").value;


            var mapboxClient = mapboxSdk({ accessToken: mapboxgl.accessToken });
            mapboxClient.geocoding.forwardGeocode({
                query: place,
                autocomplete: false,
                limit: 1
            })
                .send()
                .then(function (response) {
                    if (response && response.body && response.body.features && response.body.features.length) {
                        var feature = response.body.features[0];

                        var map = new mapboxgl.Map({
                            container: 'map',
                            style: 'mapbox://styles/mapbox/streets-v11',
                            center: feature.center,
                            zoom: 10
                        });
                        document.getElementById("latitude").value =  feature.center[1];
                        document.getElementById("longitude").value =  feature.center[0];
                        var marker = new mapboxgl.Marker({
                            draggable: true
                        }).setLngLat(feature.center)
                            .addTo(map);
                        function onDragEnd() {
                            var lngLat = marker.getLngLat();
                            console.log('Longitude: ' + lngLat.lng + '<br />Latitude: ' + lngLat.lat);
                            document.getElementById("latitude").value =  lngLat.lat;
                            document.getElementById("longitude").value = lngLat.lng;
                        }
                        marker.on('dragend', onDragEnd);
                    }
                });
        }

        mapboxgl.accessToken = 'pk.eyJ1IjoibnRiMjAxOSIsImEiOiJjanVjZnlvbmwwNXVrNDRwOHo5N2RsdGw5In0.Dpepc7BGD-6hd2B4uCDbzA';
        // eslint-disable-next-line no-undef


        var map = new mapboxgl.Map({
            container: 'map', // container id
            style: 'mapbox://styles/mapbox/streets-v11', // stylesheet location
            center: [long,lat], // starting position [lng, lat]
            zoom: 10 // starting zoom
        });

        var marker = new mapboxgl.Marker({
            draggable: true
        }).setLngLat([long,lat])
            .addTo(map);

        function onDragEnd() {
            var lngLat = marker.getLngLat();
            console.log('Longitude: ' + lngLat.lng + '<br />Latitude: ' + lngLat.lat);
            document.getElementById("latitude").value =  lngLat.lat;
            document.getElementById("longitude").value = lngLat.lng;
        }
        marker.on('dragend', onDragEnd);

    </script>
    <script>
        CKEDITOR.replace( 'info' );
    </script>
    <script>
        $('#input-tags').selectize({
            delimiter: ',',
            persist: false,
            create: function(input) {
                return {
                    value: input,
                    text: input
                }
            }
        });
    </script>
    <script>
        function delete_old_image(id) {
            $.ajax({
                type: 'get',
                url: "{{URL::to('/edit-delete/')}}/"+id,
                success: function (data) {
                    $('#old-img-'+data['id']).remove();
                }
            });
        }
    </script>
@stop

