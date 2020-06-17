<?php

namespace App\Http\Controllers;

use App\AllVideo;
use App\Category;
use App\CategoryMedia;
use App\License;
use App\LicenseVideo;
use App\Notification;
use App\Tag;
use App\Video;
use App\VideoUpload;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:videos-uploader');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::where('user_id',Auth::user()->id )->orderBy('id','DESC')->paginate(12);
        return view('video.index',compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category=Category::all();
        $tag=Tag::all();
        $license_modify=License::where('type',1)->get();
        $license_usage=License::where('type',2)->get();
        return view('video.create',compact('category','tag','license_modify','license_usage'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \request()->validate([
            'title' => 'required',
            'category' => 'required|exists:categories,id',
            'info' => 'required',
            'latitude' => 'string',
            'longitude' => 'string',
            'author_name' => 'required',
        ]);


        $video = new Video;
        $video->title = request('title');
        $video->info=request('info');
        $video->latitude=request('latitude');
        $video->longitude=request('longitude');
        $video->author_name = request('author_name');

        $video->user_id = Auth::user()->id;
        $video->save();
        foreach (request('category') as $key => $value)
        {
            if($value!=0){
                $category_media = CategoryMedia::firstOrNew(['category_id'=>$value,'target_id'=>$video->id,'target_type'=>'video']);
                $category_media->save();
            }
        }

        $modify=request('license_modify');
        $usage=request('license_usage');
        if($modify){
            $mod=new LicenseVideo;
            $mod->video_id=$video->id;
            $mod->type=1;
            if($modify=='1'){
                $mod->license_id=1;
            }
            else{
                $mod->license_id=2;
            }
            $mod->save();
        }
        if($usage){
            $mod=new LicenseVideo;
            $mod->video_id=$video->id;
            $mod->type=2;
            if($usage=='3'){
                $mod->license_id=3;
            }
            else{
                $mod->license_id=4;
            }
            $mod->save();
        }



        $given_tags = $request['tag_test'];
        foreach ($given_tags as $tag) {
            $tags = Tag::firstOrNew(['name' => strtolower($tag)]);
            $tags->save();
            $video->tag_video()->attach($tags->id);
        }


            $stored=request('stored');
            $stored = trim($stored,"[]");
            $stored = explode(",",$stored);
            foreach ($stored as $s){
                $vid=new AllVideo;
                $vid->video_id=$video->id;
                $i = trim($s,'"');
                $vid->video_file=$i;
                $vid->save();
            }

            $user=Auth::user();
            $notification=new Notification;
            $notification->user_id=$user->id;
            $notification->user_type=1;
            $notification->remarks="Video Album added by Uploader ".$user->name;
            $notification->save();

            Session::flash('success', 'Video Added');
            return redirect('/video');
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show_video=Video::findOrFail($id);
        $user=Auth::user()->id;
        if($show_video->user_id==$user){
            return view('video.show',compact('show_video'));
        }
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_video=Video::findOrFail($id);
        $categories=Category::all();
        $license_modify=License::where('type',1)->get();
        $license_usage=License::where('type',2)->get();
        $tags=Tag::all();
        return view('video.edit',compact('edit_video','categories','tags','license_modify','license_usage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        if($video->permission==1) {

            \request()->validate([
            'title' => 'required|string',
            'category' => 'required|exists:categories,id',
            'info' => 'required',
            'latitude' => 'string',
            'longitude' => 'string',
            'author_name' => 'required|string',
        ]);


        if($request->hasFile('file')){
            $filenamewithext=request()->file('file')->getClientOriginalName(); //filename with extension
            $filename=pathinfo($filenamewithext,PATHINFO_FILENAME);  //just filename
            $extension=$request->file('file')->getClientOriginalExtension(); //just extention
            $filenametostore= $filename.'_'.time().'.'.$extension;
            $new_path = \request()->file('file')->store('img');
            $filenametostore ="storage/".$new_path;

            $vid=new AllVideo;
            $vid->video_id=$video->id;
            $vid->video_file=$filenametostore;
            $vid->save();
            $vid2=new VideoUpload;
            $vid2->filename=$filenametostore;
            $vid2->save();
        }
        else{
            $filenametostore='no.vid';
        }




        $video->latitude=request('latitude');
        $video->longitude=request('longitude');
        $video->author_name=request('author_name');
        $video->permission='1';


        $media_cat=CategoryMedia::where('target_id',$video->id)->where('target_type','video')->get();
        foreach ($media_cat as $m){
            $m->delete();
        }
        foreach (request('category') as $key => $value)
        {
            if($value!=0){
                $category_media = CategoryMedia::firstOrNew(['category_id'=>$value,'target_id'=>$video->id,'target_type'=>'video']);
                $category_media->save();
            }
        }




        } else {
            \request()->validate([
                'title' => 'required|string',
                'info' => 'required',
            ]);
            $video->permission = '5';
        }

        $given_tags=$request['tag_test'];
        $delete_tag = DB::table('tag_video')->where('video_id', $id)->delete();

        foreach ($given_tags as $tag) {
            $tags = Tag::firstOrNew(['name' => strtolower($tag)]);
            $tags->save();
            $video->tag_video()->attach($tags->id);
        }

            $video->title=request('title');
            $video->info=request('info');
            $video->save();



        $video_license = LicenseVideo::where('video_id', $video->id)->get();

        foreach ($video_license as $m) {
            $m->delete();
        }

        $modify=request('license_modify');
        $usage=request('license_usage');
        if($modify){
            $mod=new LicenseVideo;
            $mod->video_id=$video->id;
            $mod->type=1;
            if($modify=='1'){
                $mod->license_id=1;
            }
            else{
                $mod->license_id=2;
            }
            $mod->save();
        }
        if($usage){
            $mod=new LicenseVideo;
            $mod->video_id=$video->id;
            $mod->type=2;
            if($usage=='3'){
                $mod->license_id=3;
            }
            else{
                $mod->license_id=4;
            }
            $mod->save();
        }

        $user=Auth::user();
        $notification=new Notification;
        $notification->user_id=$user->id;
        $notification->user_type=1;
        $notification->remarks="Video Album updated by Uploader ".$user->name;
        $notification->save();

            Session::flash('success','Video Edited');
        return redirect('/video/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        if (File::exists($video->video))
        {
            $video->delete();
            unlink($video->video);
        }
        $video->delete();

        $user=Auth::user();
        $notification=new Notification;
        $notification->user_id=$user->id;
        $notification->user_type=1;
        $notification->remarks="Video Album updated by Uploader ".$user->name;
        $notification->save();


        Session::flash('success','Video Deleted');
        return redirect('/video');
    }
}
