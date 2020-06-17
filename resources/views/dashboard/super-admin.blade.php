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
                    Welcome Super Admin
                </div>
                <div class="col-6">
                    <img src="{{asset('ntb.png')}}" alt="user-image" class="rounded-circle">
                </div>
            </div>

        </div>
    </div>
</div>


<div class="row">
    <div class="col-3">
        <a href="{{url('/category')}}">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <i class="fas fa-align-justify fa-3x"></i>
                    </div>
                    <div class="col-3">
                        <h4 class="mt-0 font-16">Total Categories:</h4>
                        <h2 class="text-danger my-3 text-center">{{$categories}}</h2>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-3">
        <a href="{{url('/license')}}">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <i class="fas fa-registered fa-3x"></i>
                    </div>
                    <div class="col-3">
                        <h4 class="mt-0 font-16">Total Licenses:</h4>
                        <h2 class="text-danger my-3 text-center">{{$licenses}}</h2>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @php
        $admin=0;
              $uploader=0;
    @endphp
    @foreach($users as $a)
        @php
            $r=$a->getRoleNames()->first();
        if($r=="admin"){$admin++;}
        elseif($r=="uploader"){$uploader++;}
        @endphp
    @endforeach
    <div class="col-3">
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
    <div class="col-3">
        <a href="{{url('/admin')}}">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <i class="fas fa-users fa-3x"></i>
                    </div>
                    <div class="col-3">
                        <h4 class="mt-0 font-16">Total Admins:</h4>
                        <h2 class="text-danger my-3 text-center">{{$admin}}</h2>
                    </div>
                </div>
            </div>
        </a>
    </div>

</div>

<div class="row">
    <div class="col-3">

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

    </div>
    <div class="col-3">

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
    <div class="col-4">
        <div class="card-box">
            <h5>Number of Users</h5>
            <canvas id="myChart_users" width="50" height="50"></canvas>
        </div>

    </div>
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
<div class="card">
    <div class="card-body">
        <a href="{{url('/users')}}"><h4 class="header-title mb-0">All Users</h4></a>

        <div id="cardCollpase4" class="collapse pt-3 show">
            <div class="table-responsive">
                <table class="table table-centered table-borderless mb-0">
                    <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $u)
                        <tr>
                            <td>{{$u->name}}</td>
                            <td>{{$u->email}}</td>
                            <td>{{$u->getRoleNames()->first()}}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div> <!-- .table-responsive -->
        </div> <!-- end collapse-->
    </div> <!-- end card-body-->
</div>
