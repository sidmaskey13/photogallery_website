@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Notifications</h1>
       @if(count($notifications)>0)
           <table class="table table-striped">
               <tr><th>Remarks</th>
               <th>Time</th></tr>

           @foreach ($notifications as $n)
             <tr><td>
                     <h5>{{$n->remarks}}</h5>
                 </td>
             <td>
                 {{$n->created_at->diffForHumans()}}
             </td></tr>
           @endforeach
           @else
           <h4>No Notification</h4>
           @endif
    </div>
@endsection

