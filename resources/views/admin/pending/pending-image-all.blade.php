@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Pending Images</h1>
        @if(count($pending)>0)

                <table border="1" class="table table-striped">
                    <tr>
                        <th>Title</th>
                        <th>Tag</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                    @foreach($pending as $m)
                    <tr>
                        <td>{{$m->title}}</td>
                        <td>   <div class="tags">
                                @foreach($m->tag as $t)
                                    <p><span class="badge badge-success">{{$t->name}}</span></p>
                                @endforeach
                            </div></td>
                        <td>@foreach($m->category_media as $t)
                                <span class="badge badge-info">{{$t->category->name}}</span>
                            @endforeach</td>
                        <td>
                            <a href="{{URL::to('/pending-image/'.$m->id)}}" class="btn btn-primary">Show</a>
                        </td>
                    </tr>
                    @endforeach
                </table>

        @else
            {{'No Pending Images'}}
        @endif




    </div>
@endsection
