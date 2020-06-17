@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Add Category</h1>

        <form method="POST" action="{{route('add-category')}}">
            {{@csrf_field()}}
            <div class="table-responsive">
                <table class="table table-bordered" id="dynamic_field">
                    <tr>
                        <td>Add Category:<input type="text" class="form-control" id="name" name="name[]"></td>
                        <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                    </tr>
                </table>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

    </div>
@endsection

@section('script')
    <script>

        $(document).ready(function(){

            var i=1;
            $('#add').click(function(){
                i++;
                $('#dynamic_field').append('<tr id="row'+i+'"><td>Add Category:<input type="text" class="form-control" id="name" name="name[]"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
            });

            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });
        });
    </script>
@stop
