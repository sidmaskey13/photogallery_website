<div class="col-4">
    <a href="{{url('/profile-media') }}">
    <div class="card">
        <div class="card-header"><h4>Dashboard</h4></div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Welcome User, {{$user->name}}
                </div>
                <div class="col-6">
                    @if(Auth()->user()->profile_picture!=null)
                        <img src="{{url(Auth()->user()->profile_picture->image_file)}}" alt="user-image" class="rounded-circle">
                    @else
                        <img src="{{asset('ntb.png')}}" alt="user-image" class="rounded-circle">
                    @endif
                </div>
            </div>
        </div>
    </div>
    </a>
</div>

<div class="row">
    <div class="col-3">
        <a href="{{url('/media')}}">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <i class="fas fa-image fa-3x"></i>
                    </div>
                    <div class="col-3">
                        <h4 class="mt-0 font-16">Approved Images Album</h4>
                        <h2 class="text-primary my-3 text-center">{{$upload_approved_image_album.'/'.$upload_images_album}}</h2>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-3">
        <a href="{{url('/video')}}">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <i class="fas fa-video fa-3x"></i>
                    </div>
                    <div class="col-3">
                        <h4 class="mt-0 font-16">Approved Videos Album</h4>
                        <h2 class="text-success my-3 text-center">{{$upload_approved_video_album.'/'.$upload_videos_album}}</h2>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-3">
        <div class="card-box">
            <div class="row">
                <div class="col-6">
                    <i class="fas fa-file-image fa-3x"></i>
                </div>
                <div class="col-3">
                    <h4 class="mt-0 font-16">My Approved Images</h4>
                    <h2 class="text-primary my-3 text-center">{{$all_my_images}}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card-box">
            <div class="row">
                <div class="col-6">
                    <i class="fas fa-file-video fa-3x"></i>
                </div>
                <div class="col-3">
                    <h4 class="mt-0 font-16">My Approved Videos</h4>
                    <h2 class="text-success my-3 text-center">{{$all_my_videos}}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="card-box">
            <div class="row">
                <div class="col-6">
                    <i class="fas fa-home fa-3x"></i>
                </div>
                <div class="col-3">
                    <h4 class="mt-0 font-16">Selected in Homepage</h4>
                    <h2 class="text-success my-3 text-center">{{$all_my_images_selected_homepage}}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <div class="card-box">
            <h5>Number of Image Uploads (Months)</h5>
            <canvas id="myChart_image_each" width="50" height="50"></canvas>
        </div>

    </div>
    <div class="col-4">
        <div class="card-box">
            <h5>Number of Video Uploads (Months)</h5>
            <canvas id="myChart_video_each" width="50" height="50"></canvas>
        </div>

    </div>
</div>
