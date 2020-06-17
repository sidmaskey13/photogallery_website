@extends('layouts.main')

@section('content')
    <div class="container">
        @if(count($pending)>0)
            <h3>Choose branch</h3>
            <form method="POST" action="{{route('select-branch-video')}}">
                {{@csrf_field()}}
                <table border="1" class="table table-striped">
                    <tr>
                        <th>Title</th>
                        <th>Tag</th>
                        <th>Category</th>
                        <th>Branch</th>
                    </tr>
                    @foreach($pending as $m)
                        <tr>
                            <td>{{$m->title}}</td>
                            <td>   <div class="tags">
                                    @foreach($m->tag_video as $t)
                                        <p><span class="badge badge-success">{{$t->name}}</span></p>
                                    @endforeach
                                </div></td>
                            <td>@foreach($m->category_media as $t)
                                    <span class="badge badge-info">{{$t->category->name}}</span>
                                @endforeach</td>
                            <td>
                                <select name="branch[{{$m->id}}]" id="">
                                    <option value selected>Choose</option>
                                    @foreach ($branch as $b)
                                        <option value="{{$b->id}}">{{$b->name}}</option>
                                    @endforeach
                                </select>
                                <a href="{{URL::to('/pending-video/'.$m->id)}}" class="btn btn-primary">Show</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <input type="submit" class="btn btn-primary" value="Submit">
            </form>
        @else
            {{'No Pending Videos'}}
        @endif
    </div>
@endsection
