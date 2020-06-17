@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>All Licenses</h1>
        @if(count($licenses)>0)
            <table class="table table-striped">
                <tr>
                    <th>Licenses</th>
                    <th>Action</th>
                </tr>

                @foreach ($licenses as $c)
                    <tr>
                        <td>
                            {{$c->name}}
                        </td>
                        <td>
                            @if(!(($c->media()->count() > 0) || ($c->video()->count() > 0)) )
                            <form id="delete-license_{{$c->id}}" action="{{route('license.destroy',$c->id)}}" method="post">
                                {{csrf_field()}}
                                {{method_field('delete')}}
                                <button type="button" class="btn btn-danger" onclick="confirmDelete('{{$c->id}}')">Delete</button>
                            </form>
                                @endif
                        </td>
                    </tr>
                @endforeach



            </table>
        @else
            {{'No Licenses'}}
        @endif
    </div>
@endsection
@section('script')
    <script>
        function confirmDelete(item_id) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover it!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#delete-license_'+item_id).submit();
                    } else {
                        swal("Cancelled Successfully");
                    }
                });
        }

    </script>
@stop