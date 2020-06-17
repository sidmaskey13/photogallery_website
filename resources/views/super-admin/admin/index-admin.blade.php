@extends('layouts.main')

@section('content')
    <div class="container">
        <table class="table table-striped">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Branch</th>
                <th>Action</th>
            </tr>


        @foreach($admins as $a)
            @php
                $r=$a->getRoleNames()->first();
            @endphp
            <tr>

            @if($r=="admin")
              <td>  {{$a->name}}</td>
                <td>{{$a->email}}</td>
                <td>
                    @foreach ($a->branches as $b)
                        {{$b->name}}<br>
                    @endforeach
                </td>
               <td>
                   <a href="{{url('admin/'.$a->id.'/edit')}}" class="btn btn-primary">Edit</a>
                   <form id="delete-admin_{{$a->id}}" action="{{URL::to('/admin/'.$a->id)}}" method="post">
                       {{csrf_field()}}
                       {{method_field('delete')}}
                       <button type="button" class="btn btn-danger" onclick="confirmDelete('{{$a->id}}')">
                           Delete
                       </button>
                   </form>
                    </td>
            @endif
            </tr>
        @endforeach
        </table>
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
                        $('#delete-admin_'+item_id).submit();
                    } else {
                        swal("Cancelled Successfully");
                    }
                });
        }

    </script>
@stop