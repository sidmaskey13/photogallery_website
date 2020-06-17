@extends('layouts.main')

@section('content')
    <h1>Add Role</h1>
    <form action="{{route('add-role')}}" method="POST" enctype="multipart/form-data">
        {{@csrf_field()}}
        <div class="col-md-5">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="row">
            @foreach($permissions as $p)
                <div class="col-md-3">
                    <label for="name">
                        <h5>{{$p->name}}</h5>
                    </label>
                    <input type="checkbox" name="permission[]" value="{{$p->id}}">
                </div>
            @endforeach
        </div>
        <input type="submit" class="btn btn-primary" value="Add">
    </form>

@endsection