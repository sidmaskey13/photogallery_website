@if(count($products)>0)
    <div class="row">
        @foreach ($products as $p)
            <a href="{{URL::to('/result/'.$p->id)}}">
                <div class="gallery-box">
                    <h5>{{$p->title}}</h5>
                    <div class="tags">
                        @foreach($p->tag as $t)
                            <p><span class="badge badge-success">{{$t->name}}</span></p>
                        @endforeach
                    </div>

                    @foreach ($p->all_image as $u)

                        <img alt="User Pic" src="{{url($u->thumbnail_image->thumbnail_file)}}"
                             style="margin: 2px"
                             class="gallery-image" height="200" width="320">

                        @php
                            break;
                        @endphp
                    @endforeach
                </div>
            </a>
        @endforeach
    </div>
@else
    <h1>No images found</h1>
@endif

@if(count($products_vid)>0)
    <div class="row">
        @foreach ($products_vid as $p)
            <a href="{{URL::to('/result-video/'.$p->id)}}" >
                <div class="gallery-box">
                    <h5>{{$p->title}}</h5>
                    <div class="tags">
                        @foreach($p->tag_video as $t)
                            <p><span class="badge badge-success">{{$t->name}}</span></p>
                        @endforeach</div>

                    @foreach ($p->all_video as $u)

                        <video alt="User Pic" src="{{url($u->video_file)}}" style="margin: 2px"
                               height="200px" width="320px"/>
                        @php
                            break;
                        @endphp
                    @endforeach
                </div>
            </a>
        @endforeach
    </div>
@else
    <h1>No Videos found</h1>
@endif










<tr>
<td colspan="5">{{ $products->links() }}</td>
</tr>

