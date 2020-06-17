<?php

namespace App\Http\Controllers;
use App\Video;

use App\AllVideo;
use App\VideoUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class AllVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('file')){
            $filenamewithext=request()->file('file')->getClientOriginalName(); //filename with extension
            $filename=pathinfo($filenamewithext,PATHINFO_FILENAME);  //just filename
            $extension=$request->file('file')->getClientOriginalExtension(); //just extention
            $filenametostore= $filename.'_'.time().'.'.$extension;
            $new_path = \request()->file('file')->store('img');
            $filenametostore ="storage/".$new_path;
        }
        else {
            $filenametostore='no.jpg';
        }

        $videoUpload = new VideoUpload;
        $videoUpload->filename = $filenametostore;
        $videoUpload->save();
        return response()->json(['name'=>$filenametostore]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AllVideo  $allVideo
     * @return \Illuminate\Http\Response
     */
    public function show(AllVideo $allVideo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AllVideo  $allVideo
     * @return \Illuminate\Http\Response
     */
    public function edit(AllVideo $allVideo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AllVideo  $allVideo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AllVideo $allVideo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AllVideo  $allVideo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $request->all();
        $filename =  $request->get('filename');
        VideoUpload::where('filename',$filename)->delete();
        if (file_exists($filename)) {
            unlink($filename);
        }
        if (File::exists($filename)) {
            unlink($filename);
        }
        return response()->json(['id'=>$filename->id]);

    }

    public function delete($id)
    {
        $video = AllVideo::findOrFail($id);
        $video->delete();
        if (($vid = VideoUpload::where('filename',$video->video_file)->first()) && File::exists($vid->filename)) {
            unlink($vid->filename);
            $vid->delete();
        }
        return response()->json(['id'=>$id]);
    }
}
