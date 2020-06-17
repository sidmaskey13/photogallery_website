<?php

namespace App\Http\Controllers;

use App\AllImage;
use App\Category;
use App\Homepage;
use App\Media;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomepageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:add-welcome-photos', ['only' => ['add_to_welcome_index','add_to_welcome_show','add_to_welcome_showPost']]);
    }
    public function add_to_welcome_index()
    {
        $selected_images = Media::where('permission',2)->paginate(12);
        $admin_images = Media::where('permission',4)->orWhere('permission',7)->paginate(12);
        return view('admin.homepage.welcome-add-index',compact('selected_images','admin_images'));
    }

    public function add_to_welcome_show($id)
    {
        $show_media=Media::findOrFail($id);
        $selected=Homepage::all()->pluck('image_id');
//        dd($selected);
        return view('admin.homepage.welcome-add-show',compact('show_media','selected'));
    }


    public function add_to_welcome_showPost(Request $request)
    {
        $all=request('list');
        foreach ($all as $a){
            $c=Homepage::where('image_id', $a)->first();
            if($c){$c->delete();}
        }
        $select=request('image_id');
        if($select!=null)
        {
            foreach ($select as $s)
            {
                $add =new Homepage;
                $add->image_id=$s;
                $add->save();
            }
        }
        Session::flash('success','Photos Status For Homepage Changed');
        return redirect('homepage');
    }

    public function welcome_gallery()
    {
        $selected = Homepage::all();
        $categories = Category::all();
//        $selected=json_encode(Homepage::with('media')->get()->toArray());
        return view('homepage.frontpage.welcome',compact('selected','categories'));
    }

    public function categoryShow($id)
    {
        $c=Category::findOrFail($id);
        $categories = Category::all();
        $media = Media::whereHas('category_media',function ($q) use ($c){
            $q->whereIn('category_media.category_id',$c);
        })->where('permission',2)->get();
        $video = Video::whereHas('category_media',function ($q) use ($c){
            $q->whereIn('category_media.category_id',$c);
        })->where('permission',2)->get();

        return view('homepage.category.welcome-category-show',compact('media','categories','c','video'));    }
}
