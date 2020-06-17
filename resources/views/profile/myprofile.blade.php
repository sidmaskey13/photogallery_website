@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="profile-card">
        <div class="row">
           <div class="col-md-4">
                   @if($user->profile_picture!=null)
                       <img src="{{url($user->profile_picture->image_file)}}" alt="" style="width:100px; border-radius: 50%;">
                   @else
                       <img src="{{asset('images/default-pic.jpg')}}" alt="Default Img" style="width:100px ;border-radius: 50%;">
                   @endif

           </div>
           <div class="col-md-8">
               <h1>{{$user->name}}</h1>
               <h5>{{$user->email}}</h5>
           </div>
       </div>
        </div>
        <h3>Images</h3><br>
        <div class="row">
            @if(count($images)>0)
            @foreach($images as $album)
               <div class="col-md-4">
                   <div class="profile-gallery-card">
                       @foreach ($album->all_image as $u)
                           <a href="{{url('/profile-media/'.$album->id)}}">
                               <img alt="User Pic" src="{{url($u->thumbnail_image->thumbnail_file)}}"
                                    style="margin: 2px"
                                    class="gallery-image" height="200" width="340">
                           </a>




                           @php
                               break;
                           @endphp
                       @endforeach
                   </div>
                   <input type="hidden" id="latitude[{{$u->id}}]" name="latitude" value="{{$u->latitude}}" class="form-control">
                   <input type="hidden" id="longitude[{{$u->id}}]" name="longitude" value="{{$u->longitude}}" class="form-control">

               </div>
           @endforeach
            @else
                <h5>No Images</h5>
            @endif

       </div>

        <h3>Videos</h3><br>
        <div class="row">
            @if(count($videos)>0)
            @foreach($videos as $album)
                <div class="col-md-4">
                    <div class="profile-gallery-card">
                        @foreach ($album->all_video as $u)
                            <a href="{{url('/profile-video/'.$album->id)}}">
                                <video alt="User Pic" src="{{url($u->video_file)}}" style="margin: 2px" class="gallery-video" height="100%" width="100%"/>

                            </a>
                            @php
                                break;
                            @endphp
                        @endforeach
                    </div>

                </div>
            @endforeach
                @else
            <h5>No Videos</h5>
                @endif

        </div>

        <label for="map_canvas">Location:</label>
        <div id='map' style="width: 50%; height: 500px;"></div>

    </div>
@endsection

@section('script')
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoibnRiMjAxOSIsImEiOiJjanVjZnlvbmwwNXVrNDRwOHo5N2RsdGw5In0.Dpepc7BGD-6hd2B4uCDbzA';
        var coordinates = document.getElementById('coordinates');
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [85.32, 27.717],
            zoom: 10
        });
                @forEach($loc as $l)
                   new mapboxgl.Marker({
                   draggable: false
                    })
                   .setLngLat([{{$l->longitude}}, {{$l->latitude}}])
                    .addTo(map);
                @endforeach


    </script>

@stop
