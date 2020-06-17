@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>All My Images</h1>
        <input type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="Search Image" onchange="search(this)">
        <div id="LoadingImage" style="display: none">
            <h1>Loading...</h1>
        </div>

        <div class="paginate"> {{$medias->render()}}</div>

        <div class="row">
         <div class="col-12">
             <div id="other_img">
            @if(count($medias)>0)
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($medias as $m)
                            <tr>
                                <td>
                                    <h5>{{$m->title}}</h5>
                                </td>
                                <td>  @if($m->permission==1 || $m->permission==5)
                                        <i style="color:black; background-color: darkgrey; padding: 3px;">{{'Pending'}}</i>
                                        <br>
                                    @elseif($m->permission==2)
                                        <i style="color:green; background-color: greenyellow; padding: 3px;">{{'Approved'}}</i>
                                        <br>
                                    @elseif($m->permission==3)
                                        <i style="color:whitesmoke; background-color: red; padding: 3px;">{{'Rejected'}}</i>
                                        <br>
                                    @endif</td>
                                <td><a href="{{URL::to('/media/'.$m->id)}}" class="btn btn-primary">Show</a></td>
                            </tr>
                        @endforeach
                        </tbody>


                    </table>
                    @else
                     <h4>No Image Found</h4>
                    @endif
                </div>
         </div>
        </div>
        <div class="row">
          <div class="col-12">
              <div id="result2"></div>
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
                    url: '{{URL::to('result-uploader-image')}}',
                    data: {'search': $(btn).val()},
                    beforeSend: function() {
                        $("#LoadingImage").show();
                    },

                    success: function (data) {
                        $('#other_img').hide();
                        $('#result2').html(data);
                        $('#result2').show();
                        $("#LoadingImage").hide();


                    }
                });}
            else{
                $('#other_img').show();
                $('#result2').hide();
            }
        }
    </script>
@stop
