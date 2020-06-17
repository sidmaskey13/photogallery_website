@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Verify Users</h1>
        @if(count($users)>0)
        <form method="POST" action="{{route('verify-users')}}">
            {{@csrf_field()}}
            <table class="table table-striped">
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                @foreach ($users as $user)
                    <tr>
                        <td><h5>{{$user->name}}</h5></td>
                       <td>
                           <select name="verify[{{$user->id}}]" id="">
                               <option value="" selected>Choose</option>
                               <option value="1">Accept</option>
                               <option value="2">Reject</option>
                           </select>
                       </td>
                    </tr>
                @endforeach
            </table>
            <input type="submit" class="btn btn-success" value="Submit">
        </form>
            @else
            <h3>No new users</h3>
            @endif
    </div>
@endsection
