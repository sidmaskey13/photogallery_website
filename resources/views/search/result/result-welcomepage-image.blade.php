<h5><u>Uploader's Image</u></h5>
@if (count($selected_images)>0)
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
    @else
    <h5>No Images Found</h5>
@endif

{{--<div class="paginate"> {{$selected_images->render()}}</div>--}}
<hr>
<h5><u>Admin's Image</u></h5>
@if (count($admin_images)>0)

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

@else
    <h4>No Images Found</h4>
@endif

{{--<div class="paginate"> {{$admin_images->render()}}</div>--}}
