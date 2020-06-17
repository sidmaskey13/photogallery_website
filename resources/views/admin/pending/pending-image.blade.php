@extends('layouts.main')

@section('content')
    <div class="container">
<h1>Pending Media</h1>
        <ul class="breadcrumb">
            <li><a href="{{url('/home') }}">Home</a></li>
            <li><a href="{{url('/pending-image') }}">Pending Image</a></li>
            <li>{{$image->title}}</li>
        </ul>
            <table border="1" class="table table-striped">
                <tr>
                    <th>Title</th>
                    <td>{{$image->title}}</td>
                </tr>
                <tr>
                    <th>Tag</th>
                    <td>   <div class="tags">
                            @foreach($image->tag as $t)
                                <p><span class="badge badge-success">{{$t->name}}</span></p>
                            @endforeach
                        </div></td>
                </tr>
                <tr>
                    <th>Category</th>
                    <td>
                        @foreach($image->category_media as $c)
                            <span class="badge badge-info">{{$c->category->name}}</span>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th>Info</th>
                    <td>{!!$image->info!!}</td>
                </tr>
                <tr>
                    <th>Author Name</th>
                    <td>{{$image->author_name}}</td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td>
                        <div id='map' style="width: 50%; height: 200px;"></div>
                    </td>
                </tr>
                <input type="hidden" id="latitude" name="latitude" value="{{$image->latitude}}" class="form-control">
                <input type="hidden" id="longitude" name="longitude" value="{{$image->longitude}}" class="form-control">

                <tr>
                    <th>Action</th>
                    <td>
                        <form action="{{url('/pending-image/'.$image->id)}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="appointment" value="{{$image->id}}">
                            Action:
                            <select name="approve" class="form-control">
                                <option disabled>Select One</option>
                                <option value="2">Accept</option>
                                <option value="3">Reject</option>
                            </select>
                            <input type="submit" class="btn btn-success" value="Send">
                        </form>

                    </td>
                </tr>
            </table>
        <a href="{{url('edit-image/'.$image->id)}}" class="btn btn-primary">Edit</a>
     <div class="row">   @foreach($image->all_image as $s)
            <div class="col-md-3">
                <div class="gallery-container">
                    <div id="myBtn_{{$s->id}}" onclick="showModal({{$s->id}})" class="gallery-single-container">
                        <img src="{{url($s->thumbnail_image->thumbnail_file)}}" class="gallery-single-image">
{{--                        <img src="{{url($s->image_file)}}" class="gallery-single-image">--}}
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

        @endforeach</div>
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
