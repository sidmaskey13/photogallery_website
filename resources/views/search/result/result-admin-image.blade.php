@if(count($products)>0)
    <table class="table table-striped">
        <thead> <tr>
            <th>Title</th>
            <th>Action</th>
        </tr></thead>
        <tbody>
        @foreach ($products as $m)
            <tr>
                <td>
                    <h5>{{$m->title}}</h5>
                </td>
                <td><a href="{{URL::to('/add-image/'.$m->id)}}" class="btn btn-primary">Show</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <h4>No images found</h4>
@endif