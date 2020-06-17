@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Add Video</h1>
        <form method="post" action="{{url('video-upload/store')}}" enctype="multipart/form-data"
              class="dropzone" id="dropzone">
            @csrf
        </form>

        <form method="POST" action="{{route('add-video')}}" enctype="multipart/form-data">
            {{@csrf_field()}}
            <div class="row">
                <div class="col-sm-12">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" placeholder="Enter Video Title" name="title" required>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label for="tag">Tag:</label>
                    <select name="tag_test[]" id="input-tags" class="demo-default" multiple>
                        @foreach($tag as $f)
                            <option value="{{$f->name}}">{{$f->name}}</option>
                        @endforeach
                    </select>
                    <label for="place">Location: </label>
                    <div class="row">
                        <div class="col-md-10">
                            <input type="text" name="place" id="place" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <button  onclick="search()" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                    <br>
                    <div id='map' style="width: 100%; height: 350px;"></div>
                </div>
                <div class="col-sm-6">
                    <label for="category">Categories:</label><br>
                    <div class="category-box">
                    <div class="row">
                        @foreach ($category as $c)
                            <div class="col-md-4">
                                <input type="checkbox" value="{{$c->id}}" name="category[]">
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
                                        <input type="radio" name="license_modify" value="{{$f->id}}">
                                        <label for="">{{$f->name}}</label>
                                    </div>
                                @endforeach</div>
                        </div>
                        <div class="col-md-6">
                            <div class="category-box"><label for="">Usage:</label>
                                @foreach($license_usage as $f)
                                    <div class="col-md-12">

                                        <input type="radio" name="license_usage" value="{{$f->id}}">
                                        <label for="">{{$f->name}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <label for="author_name">Author:</label>
                    <input type="text" class="form-control" id="author_name" placeholder="Enter Author Name"
                           name="author_name" required>
                </div>
            </div>
            <input type="hidden" id="latitude" name="latitude" value="27.7" class="form-control">
            <input type="hidden" id="longitude" name="longitude" value="85.3" class="form-control">
            <div class="row">
                <div class="col-md-8">
                    <label for="info">Info:</label>
                    <textarea class="form-control" name="info" id="info" rows="5"></textarea>
                </div>
            </div>
            <input type="checkbox" name="terms" id="terms">&nbsp;
            <label for="terms">I accept the <a href="{{url('/terms')}}">terms and conditions</a></label>
            <input type="hidden" name="stored" id="stored">
            <br>
            <div id="hidden">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#hidden').hide();
            $('#terms').click(function(){
                if(this.checked  == false){
                    $('#hidden').hide();
                } else {
                    $('#hidden').show();
                }
            });
        });
    </script>
    <script>
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
            center: [85.300140,27.700769], // starting position [lng, lat]
            zoom: 10 // starting zoom
        });

        var marker = new mapboxgl.Marker({
            draggable: true
        }).setLngLat([85.300140,27.700769])
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
    <script type="text/javascript">
        var images = [];
        Dropzone.options.dropzone =
            {
                maxFilesize: 12,
                renameFile: function(file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time+file.name;
                },
                acceptedFiles: ".mp4,.3gp,.mkv,.gif",
                addRemoveLinks: true,
                timeout: 50000,
                removedfile: function(file)
                {
                    var name = file.upload.filename;
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        type: 'POST',
                        url: '{{ url("video-upload/delete") }}',
                        data: {filename: name},
                        success: function (data){
                            console.log("File has been successfully removed!!");
                        },
                        error: function(e) {
                            console.log(e);
                        }});
                    var fileRef;
                    return (fileRef = file.previewElement) != null ?
                        fileRef.parentNode.removeChild(file.previewElement) : void 0;
                },

                success: function(file, response)
                {
                    images.push(response.name);
                    $('#stored').val(JSON.stringify(images));
                },
                error: function(file, response)
                {
                    return false;
                }

            };


    </script>


@stop
