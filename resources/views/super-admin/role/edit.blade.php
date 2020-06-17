@extends('layouts.main')

@section('content')
    <h1>Edit Role</h1>
<form action="{{url('role/'.$role->id.'/edit')}}" method="POST" enctype="multipart/form-data">
    {{@csrf_field()}}
    {{method_field('PUT')}}

    <div class="col-md-5">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{$role->name}}">
    </div>

    <div class="row">
        @foreach($all as $p)
            <div class="col-md-3">
                <h5>{{$p->name}}</h5>
                <input type="checkbox" name="permission[]" value="{{$p->id}}" @foreach ($permissions as $u)
                @if($p->id==$u->id)
                checked
                        @endif
                        @endforeach
                ></div>
        @endforeach
    </div>

    <input type="submit" class="btn btn-primary" value="Edit">
</form>

    @endsection