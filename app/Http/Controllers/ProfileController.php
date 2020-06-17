<?php

namespace App\Http\Controllers;

use App\Media;
use App\ProfilePicture;
use App\User;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class ProfileController extends Controller
{
    public function change_details_get()
    {
        $user=Auth::user();
        return view('profile.main',compact('user'));
    }
    public function change_details_show($id)
    {
        $user=User::findOrFail($id);
        $u_id=Auth::user()->id;
        if($id==$u_id){
            return view('profile.change-details',compact('user'));
        }
        return view('profile.main',compact('user'));
    }

    public function change_details_post(Request $request, $id)
    {
        $user = User::findOrFail($id);
//        \request()->validate([
//            'name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//            'password' => [ 'string', 'min:6', 'confirmed'],
//
//        ]);

        if($request->hasFile('file')){
            $old_img=ProfilePicture::where('user_id',$user->id)->first();
            if($old_img!=null){
                if (file_exists($old_img->image_file)) {
                    unlink($old_img->image_file);
                    $old_img->delete();
                }
            }

            $filenamewithext=request()->file('file')->getClientOriginalName(); //filename with extension
            $filename=pathinfo($filenamewithext,PATHINFO_FILENAME);  //just filename
            $extension=$request->file('file')->getClientOriginalExtension(); //just extention

            $thumbnailPath = "storage/profile/";
            $filenametostore=$filename.'_'.time().'.'.$extension;

            $path_img = \request()->file('file')->storeAs('profile',$filenametostore);
            $filenametostore=$thumbnailPath.$filenametostore;


            $profile=new ProfilePicture;
            $profile->user_id=$user->id;
            $profile->image_file=$filenametostore;
            $profile->save();
        }
        $user->name=request('name');
        $user->email=request('email');

        if(!empty($request->input('password'))) {
            $pass=request('password');
            $user->password=bcrypt($pass);
        }
        else{
            $user->password=request('old_password');
        }


        $user->save();
        Session::flash('success','Admin Edited');
        return redirect('/profile');
    }
    public function allFiles()
    {
        $user=Auth::user();
        $images = Media::where('user_id',$user->id )->orderBy('id','DESC')->where('permission',2)->limit(6)->get();
        $loc = Media::where('user_id',$user->id )->select('id','latitude','longitude')->get();
//        dd($loc);
        $videos = Video::where('user_id',$user->id )->orderBy('id','DESC')->where('permission',2)->limit(6)->get();
        return view('profile.myprofile',compact('images','user','videos','loc'));
    }
    public function allImages_show($id)
    {
        $image=Media::findOrFail($id);
        $user=Auth::user()->id;
        if($image->user_id==$user){
            return view('profile.myprofile-show',compact('image'));
        }
        return redirect('/');
    }

    public function allVideos_show($id)
    {
        $show_video=Video::findOrFail($id);
        $user=Auth::user()->id;
        if($show_video->user_id==$user){
            return view('profile.myprofile-show-video',compact('show_video'));
        }
        return redirect('/');
    }
}
