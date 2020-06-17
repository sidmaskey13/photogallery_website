@extends('layouts.main')
@section('content')
    <h1>All permissions</h1>
    <table class="table table-striped">
        <tr>
            <th>Permissions</th>
            <th>Action</th>
        </tr>
        @foreach ($permissions as $permission)
            <tr>
                <td>
                    {{$permission->name}}
                </td>
                <td>

                    <form id="delete-permission_{{$permission->id}}" action="{{URL::to('/permission/'.$permission->id)}}" method="post">
                        {{csrf_field()}}
                        {{method_field('delete')}}
                        <button type="button" class="btn btn-danger" onclick="confirmDelete('{{$permission->id}}')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
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
                        $('#delete-permission_'+item_id).submit();
                    } else {
                        swal("Cancelled Successfully");
                    }
                });
        }

    </script>
@stop