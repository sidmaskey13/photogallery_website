@extends('layouts.main')

@section('content')
    <h1>All users</h1>
    <table class="table table-striped">
        <tr>
            <th>User Name</th>
            <th>Role</th>
            <th>Permissions by roles</th>
            <th>Extra Permissions</th>
            <th>Edit</th>
        </tr>
        @foreach ($user as $u)
            <tr>
                <td>
                    {{$u->name}}
                </td>
                <td>
                    {{$u->getRoleNames()->first()}}
                </td>
                <td>
                    @php
                        $permissions=$u->getPermissionsViaRoles();
                        $count=count($permissions);
                        $c=$count-1;
                    @endphp

                    @foreach ($permissions as $p)

                        {{$p->name}}

                        @if ($c!=0)
                            {{','}}
                        @endif

                        @php
                            $c--;
                        @endphp
                    @endforeach
                </td>
                <td>
                    @php
                        $permissions=$u->getDirectPermissions();
                        $count=count($permissions);
                        $c=$count-1;
                    @endphp

                    @foreach ($permissions as $p)

                        {{$p->name}}

                        @if ($c!=0)
                            {{','}}
                        @endif

                        @php
                            $c--;
                        @endphp
                    @endforeach
                </td>
                <td>
                    <a href="{{URL::to('/users/'.$u->id)}}" class="btn btn-primary">Edit</a>
                    <form id="delete-user_{{$u->id}}" action="{{url('users',$u->id)}}" method="post">
                        {{csrf_field()}}
                        {{method_field('delete')}}
                        <button type="button" class="btn btn-danger" onclick="confirmDelete('{{$u->id}}')">Delete</button>
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
                        $('#delete-user_'+item_id).submit();
                    } else {
                        swal("Cancelled Successfully");
                    }
                });
        }

    </script>
@stop