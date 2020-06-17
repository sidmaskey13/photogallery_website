<?php

namespace App\Http\Controllers;

use App\Media;
use App\Video;
use DB;
use Auth;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function search_media(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $search = $request->search;
            $products = Media::where('permission', '=', '2')->where(function ($q) use ($search)
            {
                        $q->where('title', 'LIKE', "%$search%")->orWhere('author_name', 'LIKE', "%$search%")
                            ->orWhereHas('tag',function ($q) use ($search) {
                                $q->where('name','like',"%$search%");
                            });
            })->paginate(12);

            $products_vid = Video::where('permission', '=', '2')->where(function ($q) use ($search)
            {
                $q->where('title', 'LIKE', "%$search%")->orWhere('author_name', 'LIKE', "%$search%")
                    ->orWhereHas('tag_video', function ($q) use ($search) {
                        $q->where('name', 'like', "%$search%");
                    });
            })->paginate(12);

            return view('search.result.result', compact('products','products_vid'));
        }

    }

    public function search_image_approved(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $search = $request->search;
            $products=Media::where('permission', '=', '2')->where(function ($q) use ($search)
            {
                $q->where('title', 'LIKE', "%$search%")->orWhere('author_name', 'LIKE', "%$search%")
                    ->orWhereHas('tag',function ($q) use ($search) {
                        $q->where('name','like',"%$search%");
                    });
            })->get();

            return view('search.result.result-approved-image', compact('products'));
        }

    }

    public function search_video_approved(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $search = $request->search;
            $products=Video::where('permission', '=', '2')->where(function ($q) use ($search)
            {
                $q->where('title', 'LIKE', "%$search%")->orWhere('author_name', 'LIKE', "%$search%")
                    ->orWhereHas('tag_video',function ($q) use ($search) {
                        $q->where('name','like',"%$search%");
                    });
            })->get();

            return view('search.result.result-approved-video', compact('products'));
        }

    }

    public function search_image_uploader(Request $request)
    {
        $user=Auth::user()->id;
        if ($request->ajax()) {
            $output = "";
            $search = $request->search;
            $products = Media::where('permission', '!=', '4')->where('user_id','=',$user)->where(function ($q) use ($search)
            {
                $q->where('title', 'LIKE', "%$search%")->orWhere('author_name', 'LIKE', "%$search%")
                    ->orWhereHas('tag',function ($q) use ($search) {
                        $q->where('name','like',"%$search%");
                    });
            })->get();

            return view('search.result.result-uploader-image', compact('products'));
        }
    }

    public function search_video_uploader(Request $request)
    {
        $user=Auth::user()->id;
        if ($request->ajax()) {
            $output = "";
            $search = $request->search;
            $products = Video::where('permission', '!=', '4')->where('user_id','=',$user)->where(function ($q) use ($search)
            {
                $q->where('title', 'LIKE', "%$search%")->orWhere('author_name', 'LIKE', "%$search%")
                    ->orWhereHas('tag_video',function ($q) use ($search) {
                        $q->where('name','like',"%$search%");
                    });
            })->get();

            return view('search.result.result-uploader-video', compact('products'));
        }
    }

    public function search_image_admin(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $search = $request->search;
            $products = Media::where('permission', '=', '4')->where(function ($q) use ($search){
                $q->where('title', 'LIKE', "%$search%")->orWhere('author_name', 'LIKE', "%$search%")
                    ->orWhereHas('tag',function ($q) use ($search) {
                        $q->where('name','like',"%$search%");
                    });
            })->get();
            return view('search.result.result-admin-image', compact('products'));
        }
    }

    public function search_image_welcomepage(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $search = $request->search;
            $selected_images = Media::where('permission', '=', '2')->where(function ($q) use ($search){
                $q->where('title', 'LIKE', "%$search%")->orWhere('author_name', 'LIKE', "%$search%")
                    ->orWhereHas('tag',function ($q) use ($search) {
                        $q->where('name','like',"%$search%");
                    });
            })->get();
            $admin_images = Media::where('permission', '=', '4')->where(function ($q) use ($search){
                $q->where('title', 'LIKE', "%$search%")->orWhere('author_name', 'LIKE', "%$search%")
                    ->orWhereHas('tag',function ($q) use ($search) {
                        $q->where('name','like',"%$search%");
                    });
            })->get();
            return view('search.result.result-welcomepage-image', compact('selected_images','admin_images'));
        }
    }



    public function show_media($id)
    {
        $media=Media::findorfail($id);
        return view('search.show.show',compact('media'));
    }

    public function show_video($id)
    {
        $video=Video::findorfail($id);
        return view('search.show.show-video',compact('video'));
    }

    public function show_image_approved($id)
    {
        $media=Media::findorfail($id);
        return view('admin.show.gallery-image-show',compact('media'));
    }

    public function show_image_uploader($id)
    {
        $media=Media::findOrFail($id);
        $user=Auth::user()->id;
        if($media->user_id==$user){
            return view('media.album',compact('media'));
        }
        return redirect('/');

    }

    public function show_image_admin($id)
    {
        $media=Media::findOrFail($id);
        return view('admin.gallery-image-show',compact('media'));
    }

    public function show_image_welcomepage($id)
    {
        $media=Media::findOrFail($id);
        return view('admin.gallery-image-show',compact('media'));
    }
    public function show_video_uploader($id)
    {
        $show_video=Video::findOrFail($id);
        $user=Auth::user()->id;
        if($show_video->user_id==$user){
            return view('video.show',compact('show_video'));
        }
        return redirect('/');

    }

    public function show_video_approved($id)
    {
        $video=Video::findorfail($id);
        return view('admin.show.gallery-video-show',compact('video'));
    }

    }






















