<div class="col-4">
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
                    Welcome Admin, {{$user->name}}
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
</div>


<div class="row">
    <div class="col-3">
        <a href="{{url('/approved-image')}}">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <i class="fas fa-images fa-3x"></i>
                    </div>
                    <div class="col-3">
                        <h4 class="mt-0 font-16">Approved Images Album</h4>
                        <h2 class="text-primary my-3 text-center">{{$images}}</h2>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-3">
        <a href="{{url('/approved-video')}}">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <i class="fas fa-video fa-3x"></i>
                    </div>
                    <div class="col-3">
                        <h4 class="mt-0 font-16">Approved Videos Album</h4>
                        <h2 class="text-success my-3 text-center">{{$videos}}</h2>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-3">
        <div class="card-box">
            <div class="row">
                <div class="col-6">
                    <i class="fas fa-image fa-3x"></i>
                </div>
                <div class="col-3">
                    <h4 class="mt-0 font-16">All Approved Images</h4>
                    <h2 class="text-primary my-3 text-center">{{$all_images}}</h2>
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
                    <h4 class="mt-0 font-16">All Approved Videos</h4>
                    <h2 class="text-success my-3 text-center">{{$all_videos}}</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-3">
        <a href="{{url('/pending-image')}}">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <i class="fas fa-file-image fa-3x"></i>
                    </div>
                    <div class="col-3">
                        <h4 class="mt-0 font-16">Pending Image Album</h4>
                        <h2 class="text-danger my-3 text-center">{{$pending_images}}</h2>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-3">
        <a href="{{url('/approved-video')}}">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <i class="fas fa-video fa-3x"></i>
                    </div>
                    <div class="col-3">
                        <h4 class="mt-0 font-16">Pending Video Album</h4>
                        <h2 class="text-danger my-3 text-center">{{$pending_videos}}</h2>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-4">
        <a href="{{url('/homepage')}}">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <i class="fas fa-home fa-3x"></i>
                    </div>
                    <div class="col-3">
                        <h4 class="mt-0 font-16">Selected Images for Homepage</h4>
                        <h2 class="text-primary my-3 text-center">{{$homepage}}</h2>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <a href="{{url('/add-image')}}">
            <div class="card-box">
                <div class="row"><div class="col-6">
                    <i class="fas fa-images fa-3x"></i>
                </div>
                <div class="col-3">
                    <h4 class="mt-0 font-16">Images added by Admin</h4>
                    <h2 class="text-primary my-3 text-center">{{$admin_images}}</h2>
                </div></div>
            </div>
        </a>
    </div>
    <div class="col-6">
            <div class="card-box">
                <div class="row"><div class="col-6">
                        <i class="fas fa-images fa-3x"></i>
                    </div>
                    <div class="col-3">
                        <h4 class="mt-0 font-16">Highest Image Uploader</h4>
                        <h2 class="text-primary my-3 text-center">
                            @if($highest_uploader_name!='0')
                            {{$highest_uploader_name}}
                                @else
                            <h2>None</h2>
                                @endif
                        </h2>
                    </div></div>
            </div>
    </div>

</div>
<div class="row">
    <div class="col-4">
        <div class="card-box">
            <h5>Number of Image Album Uploads (Months)</h5>
            <canvas id="myChart_image" width="50" height="50"></canvas>
        </div>

    </div>
    <div class="col-4">
        <div class="card-box">
            <h5>Number of Video Album Uploads (Months)</h5>
            <canvas id="myChart_video" width="50" height="50"></canvas>
        </div>

    </div>
</div>


@php
    $uploader=0;
@endphp
@foreach($users as $a)
    @php
        $r=$a->getRoleNames()->first();
    if($r=="uploader"){$uploader++;}
    @endphp
@endforeach
<div class="row">
    <div class="col-6">
        <div class="card-box">
            <div class="row">
                <div class="col-6">
                    <i class="fas fa-user-circle fa-3x"></i>
                </div>
                <div class="col-3">
                    <h4 class="mt-0 font-16">Total Uploader:</h4>
                    <h2 class="text-danger my-3 text-center">{{$uploader}}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
