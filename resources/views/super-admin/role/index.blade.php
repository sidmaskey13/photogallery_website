@extends('layouts.main')

@section('content')
<table class="table table-striped">
    <tr>
        <th>Role</th>
        <th>Permissions</th>
        <th>Action</th>
    </tr>
    @foreach ($roles as $role)
        <tr>
            <td>{{$role->name}}</td>
            <td>
                @php
                    $permissions = $role->permissions;
                    $count=count($permissions);
                    $c=$count-1;
                @endphp

                @foreach ($permissions as $permission)
                    {{$permission->name}}
                    @if ($c!=0)
                        {{','}}
                    @endif

                    @php
                        $c--;
                    @endphp
                @endforeach
            </td>
            <td>
                <a href="{{URL::to('/role/'.$role->id.'/edit')}}" class="btn btn-primary">Edit</a>
                <form id="delete-role_{{$role->id}}" action="{{url('/role/'.$role->id)}}" method="post">
                    {{csrf_field()}}
                    {{method_field('delete')}}
                    <button type="button" class="btn btn-danger" onclick="confirmDelete('{{$role->id}}')">Delete</button>
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
                        $('#delete-role_'+item_id).submit();
                    } else {
                        swal("Cancelled Successfully");
                    }
                });
        }

    </script>
@stop