@extends('layouts.main')

@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url('/home') }}">Home</a></li>
            <li><a href="{{url('/media') }}">Media</a></li>
            <li>{{$media->title}}</li>
        </ul>
        <div class="row">
            @foreach($media->all_image as $s)
                <div class="col-md-3">
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
        <div class="detail-container">
            <div class="row">
                <div class="col-10"><h1>{{$media->title}}</h1></div>
                <div class="col-2">
                    @if($media->permission==1 || $media->permission==5)
                        <p class="status-msg">Status: <span
                                    style="color:#fff; background-color: #dcd41a; padding: 5px;">{{'Pending'}}</span>
                        </p>
                        <br>
                    @elseif($media->permission==2)

                        <p class="status-msg">Status: <span
                                    style="color:#fff; background-color: #51a126; padding: 5px;">{{'Approved'}}</span>
                        </p><br>
                    @elseif($media->permission==3)
                        <p class="status-msg"><span
                                    style="color:#fff; background-color: red; padding: 5px;">{{'Rejected'}}</span>
                        </p>
                        <br>
                    @endif
                </div>
            </div>


            <div class="row">
                <div class="col-8">
                    <p>{!!$media->info!!}</p>

                    <i class="far fa-clock"></i>&nbsp;
                    Uploaded at:
                    {{$media->created_at}}
                    </br>
                    <p>
                    <i class="fas fa-list"></i><span class="label"> <b>Category:</b></span>
                    @foreach($media->category_media as $t)
                            <span class="badge badge-info">{{$t->category->name}}</span>
                    @endforeach
                    </p>
                    <i class="fas fa-registered"></i><span class="label"> <b>License:</b></span>
                    @foreach ($media->license as $l)
                        <span class="badge badge-pink">{{$l->license->name}}</span>
                    @endforeach
                </div>
                <div class="col-4">
                    <i class="fas fa-camera"></i><span class="label"> <b>Content Owner:</b></span>
                    {{$media->author_name}}<br>


                    <div class="tags">
                        @foreach($media->tag as $t)
                            <p><span class="badge badge-success">{{$t->name}}</span></p>
                        @endforeach
                    </div>

                    <div class="btn-group">
                        <a href="{{route('media.edit',$media->id)}}" class="btn btn-success">Edit</a>
                        @if($media->permission==1)
                        <form id="delete-media_{{$media->id}}" action="{{route('media.destroy',$media->id)}}" method="post">
                            {{csrf_field()}}
                            {{method_field('delete')}}
                            <button type="button" class="btn btn-danger" onclick="confirmDelete('{{$media->id}}')">Delete</button>
                        </form>
                        @endif
                    </div>

                </div>

            </div>

        </div>
        <input type="hidden" id="latitude" name="latitude" value="{{$media->latitude}}" class="form-control">
        <input type="hidden" id="longitude" name="longitude" value="{{$media->longitude}}" class="form-control">
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
                        $('#delete-media_'+item_id).submit();
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