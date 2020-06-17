@extends('layouts.main')

@section('content')
    <h1>Assign Roles</h1>
    <form action="{{route('set-permission')}}" method="POST" enctype="multipart/form-data">
        {{@csrf_field()}}
        <div class="col-md-5">
            <select name="role" class="form-control">
                <option disabled selected>Select One</option>
                @foreach ($roles as $r)
                    <option value="{{$r->id}}"
                            @if($selected_role==$r->name)
                            selected
                            @endif
                    >{{$r->name}}
                    </option>
                @endforeach
            </select>
        </div>

                <input type="hidden" name="user" value="{{$user->id}}" >

        <h4>Extra Permissions</h4>
        <div class="row">
                @foreach($permission as $p)
                    <div class="col-md-3">
                        <h5>{{$p->name}}</h5>
                        <input type="checkbox" name="permission[]" value="{{$p->id}}" @foreach ($tick as $u)
                        @if($p->id==$u->id)
                        checked
                                @endif
                                @endforeach
                        >
                   </div>
                @endforeach
        </div>


        <input type="submit" class="btn btn-primary" value="Submit">
    </form>
    <hr>
@endsection