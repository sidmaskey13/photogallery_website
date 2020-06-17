@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Selected Images</h1>
        <input type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="Search Image" onchange="search(this)">
        <div id="LoadingImage" style="display: none">
            <h1>Loading...</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div id="result"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div id="other_img">
                @if(count($selected)>0)
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                    @foreach($selected as $m)
                        <tr>
                            <td>
                                <h5>{{$m->title}}</h5>
                            </td>
                            <td><a href="{{URL::to('/approved-image/'.$m->id)}}" class="btn btn-primary">Show</a></td>
                        </tr>

                    @endforeach
                            </tbody>
                        </table>
                @else
                    <h5>No Approved Image</h5>
                @endif
                    {{ $selected->links() }}
            </div>
        </div>
      </div>
    </div>
@endsection
@section('script')
    <script>
        function search(btn) {
            if($(btn).val()!=''){
                $.ajax({
                    type: 'get',
                    url: '{{URL::to('result-approved-image')}}',
                    data: {'search': $(btn).val()},
                    beforeSend: function() {
                        $("#LoadingImage").show();
                    },

                    success: function (data) {
                        $('#other_img').hide();
                        $('#result').html(data);
                        $('#result').show();
                        $("#LoadingImage").hide();


                    }
                });}
            else{
                $('#other_img').show();
                $('#result').hide();
            }
        }
    </script>
@stop
