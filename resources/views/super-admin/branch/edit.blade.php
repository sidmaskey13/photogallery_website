@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Add Branch</h1>

        <form method="POST" action="{{route('branch.update',$branch->id)}}">
            {{@csrf_field()}}
            {{method_field('PUT')}}


                <label for="branch">Branch Name:</label>
                <input type="text" name="branch" id="branch" value="{{$branch->name}}" class="form-control"/>

            <br>
        <input type="submit" class="btn btn-primary" value="Edit">

        </form>

    </div>
@endsection
