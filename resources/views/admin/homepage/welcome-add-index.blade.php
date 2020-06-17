@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Add to Welcome Page</h1>

        <input type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="Search Image"
               onchange="search(this)">
        <div id="LoadingImage" style="display: none">
            <h1>Loading...</h1>
        </div>


        <div class="row">
            <div class="col-12">
                <div id="other_img">
                    <h5><u>Uploader's Image</u></h5>
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th>Number of selected images</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($selected_images as $selected_image)
                            <tr>
                                <td><b>{{$selected_image->title}}</b></a>
                                </td>
                                <td>
                                    @php
                                        $images=App\AllImage::where('media_id',$selected_image->id)->get();
                                                $total=count($images);
                                         $ticked=App\Homepage::whereIn('image_id',$images->pluck('id'))->get();
                                              $selected=count($ticked);
                                      echo $selected.' / '.$total;
                                    @endphp
                                </td>
                                <td><a href="{{URL::to('/homepage/'.$selected_image->id)}}"
                                       class="btn btn-primary">Show</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    <div class="paginate"> {{$selected_images->render()}}</div>
                    <hr>
                    <h5><u>Admin's Image</u></h5>
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th>Number of selected images</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($admin_images as $admin_image)
                            <tr>
                                <td><b>{{$admin_image->title}}</b></a>
                                </td>
                                <td>
                                    @php
                                        $images=App\AllImage::where('media_id',$admin_image->id)->get();
                                                $total=count($images);
                                         $ticked=App\Homepage::whereIn('image_id',$images->pluck('id'))->get();
                                              $selected=count($ticked);
                                      echo $selected.' / '.$total;
                                    @endphp
                                </td>
                                <td><a href="{{URL::to('/homepage/'.$admin_image->id)}}"
                                       class="btn btn-primary">Show</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    <div class="paginate"> {{$admin_images->render()}}</div>

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
            if ($(btn).val() != '') {
                $.ajax({
                    type: 'get',
                    url: '{{URL::to('result-welcomepage-image')}}',
                    data: {'search': $(btn).val()},
                    beforeSend: function () {
                        $("#LoadingImage").show();
                    },

                    success: function (data) {
                        $('#other_img').hide();
                        $('#result2').html(data);
                        $('#result2').show();
                        $("#LoadingImage").hide();


                    }
                });
            }
            else {
                $('#other_img').show();
                $('#result2').hide();
            }
        }
    </script>
@stop