@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Profile</h1>


        <div class="card-profile">

            @if($user->profile_picture!=null)
                <img src="{{url($user->profile_picture->image_file)}}" alt="" style="width:100%">
            @else
                <img src="{{asset('images/default-pic.jpg')}}" alt="Default Img" style="width:100%">
            @endif



            <h1>{{$user->name}}</h1>
            <p class="title-profile ">{{$user->getRoleNames()->first()}}</p>
            <p>{{$user->email}}</p>
            <p><a href="{{url('profile/'.$user->id)}}" class="button-profile">Edit</a></p>
        </div>
    </div>
@endsection
