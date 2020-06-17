@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>All Branches</h1>
        @if(count($branches)>0)
            <table class="table table-striped">
                <tr>
                    <th>Branches</th>
                    <th>Action</th>
                </tr>

                @foreach ($branches as $c)
                    <tr>
                        <td>
                            {{$c->name}}
                        </td>
                        <td>
                            <a href="{{route('branch.edit',$c->id)}}" class="btn btn-success">Edit</a>                                <form id="delete-branch_{{$c->id}}" action="{{route('branch.destroy',$c->id)}}" method="post">
                                    {{csrf_field()}}
                                    {{method_field('delete')}}
                                @if($c->users()->count() == 0)
                                    <button type="button" class="btn btn-danger" onclick="confirmDelete('{{$c->id}}')">Delete</button>
                                    @endif
                                </form>
                        </td>
                    </tr>
                @endforeach



            </table>
        @else
            {{'No Branches'}}
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
                        $('#delete-branch_'+item_id).submit();
                    } else {
                        swal("Cancelled Successfully");
                    }
                });
        }

    </script>
@stop