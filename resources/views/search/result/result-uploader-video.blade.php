@if(count($products)>0)
    <table class="table table-striped">
        <tr>
            <th>Title</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        @foreach($products as $m)
            <tr>
                <td>
                    <h5>{{$m->title}}</h5>
                </td>
                <td>  @if($m->permission==1)
                        <i style="color:black; background-color: darkgrey; padding: 3px;">{{'Pending'}}</i>
                        <br>
                    @elseif($m->permission==2)
                        <i style="color:green; background-color: greenyellow; padding: 3px;">{{'Approved'}}</i>
                        <br>
                    @elseif($m->permission==3)
                        <i style="color:whitesmoke; background-color: red; padding: 3px;">{{'Rejected'}}</i>
                        <br>
                    @endif</td>
                <td><a href="{{URL::to('/video/'.$m->id)}}" class="btn btn-primary">Show</a></td>
            </tr>
        @endforeach
    </table>
@else
    <h4>No Videos found</h4>
@endif