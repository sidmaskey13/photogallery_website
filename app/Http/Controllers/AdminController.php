<?php

namespace App\Http\Controllers;

use App\Admin_Branch;
use App\AllImage;
use App\AllVideo;
use App\Branch;
use App\Category;
use App\CategoryMedia;
use App\Homepage;
use App\ImageUpload;
use App\License;
use App\LicenseMedia;
use App\LicenseVideo;
use App\Media;
use App\Notification;
use App\Tag;
use App\Thumbnail;
use App\User;
use App\Video;
use App\VideoUpload;
use App\Watermark;
use Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:approve-media-admin', ['only' => [
            'show_pending_image_all',
            'show_pending_image_each',
            'show_pending_video_all',
            'show_pending_video_each',
            'accept_pending_image',
            'accept_pending_video',
            'approved_images',
            'approved_videos',
            'gallery_image_delete',
            'gallery_video_delete',
            'approved_image_show',
            'approved_video_show',
            'approved_image_delete',
            'approved_video_delete',
        ]]);
        $this->middleware('permission:edit-media-admin', ['only' => [
            'edit_image_get',
            'edit_video_get',
            'edit_image_update',
            'edit_video_update',
        ]]);
        $this->middleware('permission:verify-users-admin', ['only' => [
            'verify_get',
            'verify_post',
        ]]);

        $this->middleware('permission:select-branch-admin', ['only' => [
            'select_pending_branch',
            'select_pending_branch_post',
            'select_pending_branch_video',
            'select_pending_branch_video_post',
        ]]);
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function show_pending_image_all()
    {

        $branches = Auth::user()->branches()->select('branches.id')->get();
        $brancheId = [];
        foreach ($branches as $branch){
            $brancheId[] = $branch->id;
        }
        if(Auth::user()->branches()->where('branches.id',1)->count() > 0 ){
            $pending = Media::where('permission', 1)->orWhere('permission', 5)->get();
        }
        else{
            $pending = Media::whereHas('admin__branches',function ($q) use ($brancheId){
                $q->whereIn('admin__branches.branch_id',$brancheId);
            })->where('permission',1)->orWhere('permission', 5)->get();
        }
        return view('admin.pending.pending-image-all', compact('pending'));
    }

    public function show_pending_image_each($id)
    {
        $image = Media::findOrFail($id);
        return view('admin.pending.pending-image', compact('image'));
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function show_pending_video_all()
    {


        $branches = Auth::user()->branches()->select('branches.id')->get();
        $brancheId = [];
        foreach ($branches as $branch){
            $brancheId[] = $branch->id;
        }
        if(Auth::user()->branches()->where('branches.id',1)->count() > 0 ){
            $pending = Video::where('permission', 1)->orWhere('permission', 5)->get();
        }
        else{
            $pending = Video::whereHas('admin__branches',function ($q) use ($brancheId){
                $q->whereIn('admin__branches.branch_id',$brancheId);
            })->where('permission',1)->orWhere('permission', 5)->get();
        }
        return view('admin.pending.pending-video-all', compact('pending'));


    }

    public function show_pending_video_each($id)
    {
        $video = Video::findOrFail($id);
        return view('admin.pending.pending-video', compact('video'));
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////


    public function accept_pending_image(Request $request, $id)
    {
        $m = Media::findOrFail($id);
        $user=Auth::user();
        $notification=new Notification;
        $notification->user_id=$user->id;
        $notification->user_type=2;
        $status = request('approve');
        if ($status == 2) {
            $m->permission = 2;
            $notification->remarks="Image accepted by Admin ".$user->name;
            Session::flash('success', 'Image Accepted');
        }
        if ($status == 3) {
            $m->permission = 3;
            $notification->remarks="Image rejected by Admin ".$user->name;
            Session::flash('success', 'Image Rejected');
        }
        $m->save();
        $notification->save();

        return redirect('/pending-image');
    }

    public function accept_pending_video(Request $request, $id)
    {
        $m = Video::findOrFail($id);
        $user=Auth::user();
        $notification=new Notification;
        $notification->user_id=$user->id;
        $notification->user_type=2;
        $status = request('approve');
        if ($status == 2) {
            $m->permission = 2;
            $notification->remarks="Video accepted by Admin ".$user->name;
            Session::flash('success', 'Video Accepted');

        }
        if ($status == 3) {
            $m->permission = 3;
            $notification->remarks="Video accepted by Admin ".$user->name;
            Session::flash('success', 'Video Rejected');

        }
        $m->save();
        $notification->save();

        return redirect('/pending-video');
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function approved_images()
    {
        $selected = Media::where('permission', 2)->paginate(12);
        return view('admin.approved.gallery-image', compact('selected'));
    }

    public function gallery_image_delete($id)
    {
        $media = Media::findOrFail($id);
        $media->permission = 3;
        $media->save();

        Session::flash('success', 'Image Removed');
        return redirect('/gallery-image');
    }

    public function approved_videos()
    {
        $selected = Video::where('permission', 2)->paginate(12);
        return view('admin.approved.gallery-video', compact('selected'));
    }


    public function gallery_video_delete($id)
    {
        $media = Video::findOrFail($id);
        $media->permission = 3;
        $media->save();

        Session::flash('success', 'Video Removed');
        return redirect('/gallery-video');
    }

    public function approved_image_show($id)
    {
        $media = Media::findOrFail($id);
        return view('admin.approved.gallery-image-show', compact('media'));
    }

    public function approved_video_show($id)
    {
        $video = Video::findOrFail($id);
        return view('admin.approved.gallery-video-show', compact('video'));
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function edit_image_get($id)
    {
        $edit_image = Media::findOrFail($id);
        $categories = Category::all();
        $license_modify=License::where('type',1)->get();
        $license_usage=License::where('type',2)->get();
        $tags = Tag::all();
        return view('admin.edit.edit-image', compact('edit_image', 'categories', 'tags', 'license_modify','license_usage'));
    }

    public function edit_video_get($id)
    {
        $edit_video = Video::findOrFail($id);
        $categories = Category::all();
        $license_modify=License::where('type',1)->get();
        $license_usage=License::where('type',2)->get();
        $tags = Tag::all();
        return view('admin.edit.edit-video', compact('edit_video', 'categories', 'tags', 'license_modify','license_usage'));
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////

    public function edit_image_update(Request $request, $id)
    {
        $media = Media::findOrFail($id);
        \request()->validate([
            'title' => 'required|string',
            'category' => 'required|exists:categories,id',
            'info' => 'required',
            'latitude' => 'string',
            'longitude' => 'string',
            'author_name' => 'required|string',


        ]);

        if ($request->hasFile('file')) {
            $filenamewithext = request()->file('file')->getClientOriginalName(); //filename with extension
            $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);  //just filename
            $extension = $request->file('file')->getClientOriginalExtension(); //just extention
            $thumbnailPath = "storage/img/";
            $file = $filename . '_' . time() . '.' . $extension;

            $filenametostore = $file;

            $path_img = \request()->file('file')->storeAs('img', $filenametostore);
            $filenametostore = $thumbnailPath . $filenametostore;

            $originalImage = $request->file('file');
            $thumbnailImage = Image::make($originalImage);
            $thumbnailImage->resize(null, 230, function ($constraint) {
                $constraint->aspectRatio();
            });


            $waterMarkImage = Image::make($originalImage);

            $imgHeight=$waterMarkImage->height();
            $imgWidth=$waterMarkImage->width();
            $wmarkHeight=$imgHeight*0.1;
            $w=Image::make('ntb_watermark.png');
            $w->resize(null, $wmarkHeight, function ($constraint) {
                $constraint->aspectRatio();
            });
            $waterMarkImage->insert($w, 'bottom-right', 10, 10);

            $filename='img';
            $x=$imgHeight*.015;
            $y=$imgWidth*.030;
            $author=$media->author_name;
            $waterMarkImage->text($author,  $x,  $y, function($font) use($waterMarkImage)
            {
                $imgHeight=$waterMarkImage->height();
                $fontsize=$imgHeight*.035;
                $font_path = public_path('fonts/font2.ttf');
                $font->file($font_path);
                $font->size($fontsize);
                $font->color('#5F5F5F');
                $font->angle(0);
            });

            $watermarkPath = "storage/watermark/";
            $wpath=$watermarkPath.$file;
            $waterMarkImage->save($wpath);





            $thumbnailPath = "storage/thumbnail/";
            $tpath = $thumbnailPath . $file;
            $thumbnailImage->save($tpath);


            $img = new AllImage;
            $img->media_id = $media->id;
            $img->image_file = $filenametostore;
            $img->save();
            $img2 = new ImageUpload;
            $img2->filename = $filenametostore;
            $img2->save();
            $thumbnail = new Thumbnail;
            $thumbnail->thumbnail_file = $tpath;
            $thumbnail->image_id = $img->id;
            $thumbnail->save();
            $watermark = new Watermark;
            $watermark->watermark_file = $wpath;
            $watermark->image_id=$img->id;
            $watermark->save();

        } else {
            $filenametostore = 'no.jpg';
        }

        $media->title = request('title');
        $media->info = request('info');
        $media->latitude = request('latitude');
        $media->longitude = request('longitude');
        $media->author_name = request('author_name');

        $media->permission = '1';
        $media->save();
        $media_cat=CategoryMedia::where('target_id',$media->id)->where('target_type','media')->get();
        foreach ($media_cat as $m){
            $m->delete();
        }
        foreach (request('category') as $key => $value)
        {
            if($value!=0){
                $category_media = CategoryMedia::firstOrNew(['category_id'=>$value,'target_id'=>$media->id,'target_type'=>'media']);
                $category_media->save();
            }
        }
        $given_tags = $request['tag_test'];
        $delete_tag = DB::table('media_tag')->where('media_id', $id)->delete();

        foreach ($given_tags as $tag) {
            $tags = Tag::firstOrNew(['name' => strtolower($tag)]);
            $tags->save();
            $media->tag()->attach($tags->id);
        }

        $media_license = LicenseMedia::where('media_id', $media->id)->get();

        foreach ($media_license as $m) {
            $m->delete();
        }

        $modify=request('license_modify');
        $usage=request('license_usage');
        if($modify){
            $mod=new LicenseMedia;
            $mod->media_id=$media->id;
            $mod->type=1;
            $mod->license_id=$modify;
            $mod->save();
        }
        if($usage){
            $mod=new LicenseMedia;
            $mod->media_id=$media->id;
            $mod->type=2;
            $mod->license_id=$usage;
            $mod->save();
        }
        $user=Auth::user();
        $notification=new Notification;
        $notification->user_id=$user->id;
        $notification->user_type=2;
        $notification->remarks="Image Album updated during pending by Admin ".$user->name;
        $notification->save();

        Session::flash('success', 'Image Edited');
        return redirect('/pending-image/'.$id);
    }

    public function edit_video_update(Request $request, $id)
    {
        \request()->validate([
            'title' => 'required|string',
            'category' => 'required|exists:categories,id',
            'info' => 'required',
            'latitude' => 'string',
            'longitude' => 'string',
            'author_name' => 'required|string',
        ]);

        $video = Video::findOrFail($id);

        if ($request->hasFile('file')) {
            $filenamewithext = request()->file('file')->getClientOriginalName(); //filename with extension
            $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);  //just filename
            $extension = $request->file('file')->getClientOriginalExtension(); //just extention
            $filenametostore = $filename . '_' . time() . '.' . $extension;
            $new_path = \request()->file('file')->store('img');
            $filenametostore = "storage/" . $new_path;

            $vid = new AllVideo;
            $vid->video_id = $video->id;
            $vid->video_file = $filenametostore;
            $vid->save();
            $vid2 = new VideoUpload;
            $vid2->filename = $filenametostore;
            $vid2->save();
        } else {
            $filenametostore = 'no.vid';
        }


        $video->title = request('title');
        $video->info = request('info');
        $video->latitude = request('latitude');
        $video->longitude = request('longitude');
        $video->author_name = request('author_name');

        $video->permission = '1';
        $video->save();

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

        $given_tags = $request['tag_test'];
        $delete_tag = DB::table('tag_video')->where('video_id', $id)->delete();

        foreach ($given_tags as $tag) {
            $tags = Tag::firstOrNew(['name' => strtolower($tag)]);
            $tags->save();
            $video->tag_video()->attach($tags->id);
        }



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
            $mod->license_id=$modify;
            $mod->save();
        }
        if($usage){
            $mod=new LicenseVideo;
            $mod->video_id=$video->id;
            $mod->type=2;
            $mod->license_id=$usage;
            $mod->save();
        }
        $user=Auth::user();
        $notification=new Notification;
        $notification->user_id=$user->id;
        $notification->user_type=2;
        $notification->remarks="Video Album updated during pending by Admin ".$user->name;
        $notification->save();
        Session::flash('success', 'Video Edited');
        return redirect('/pending-video/'.$id);
    }
///////////////////////////////////////////////////////////////////////////////
///
    public function approved_image_delete($id)
    {
        $media = Media::findOrFail($id);
        foreach ($media->all_image as $i) {
            if ($i->homepage_images()->count() > 0) {
                $i->homepage_images->delete();
            }
        }
        $media->delete();

        $user=Auth::user();
        $notification=new Notification;
        $notification->user_id=$user->id;
        $notification->user_type=2;
        $notification->remarks="Approved Image Album deleted by Admin ".$user->name;
        $notification->save();

        Session::flash('success', 'Media Deleted');
        return redirect('/approved-image');
    }

    public function approved_video_delete($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();
        $user=Auth::user();
        $notification=new Notification;
        $notification->user_id=$user->id;
        $notification->user_type=2;
        $notification->remarks="Approved Video Album deleted by Admin ".$user->name;
        $notification->save();
        Session::flash('success', 'Video Deleted');
        return redirect('/approved-video');
    }

    ////////////////////////////////////////////////////////////////////////////////////////////


    public function verify_get()
    {
        $users=User::where('verified','0')->get();
//        dd($users);
        return view('admin.verify.verify',compact('users'));
    }

    public function verify_post(Request $request)
    {
        foreach (\request('verify') as $key => $value){
            if($value != null){
                $user=User::findOrFail($key);
                if($value=='1'){
                    $user->verified='1';
                }
                else{
                    $user->verified='2';
                }
                $user->save();
            }
        }
        $user_admin=Auth::user();
        $notification=new Notification;
        $notification->user_id=$user_admin->id;
        $notification->user_type=2;
        $notification->remarks="Uploader ".$user->name." verified by Admin ".$user_admin->name;
        $notification->save();

        Session::flash('success', 'User Verification done');
        return redirect('/home');
    }

    public function select_pending_branch()
    {
        if(Auth::user()->branches()->where('branches.id',1)->count() > 0 ) {
            $pending = Media::where('permission',1)->has('admin__branches','<',1)->get();
            $branch = Branch::where('id','<>','1')->get();
            return view('admin.verify.branch_select', compact('pending', 'branch'));
        }
        else{
            return redirect('/home');
        }
    }

    public function select_pending_branch_post()
    {
        if(Auth::user()->branches()->where('branches.id',1)->count() > 0 )
        {
            foreach (request('branch') as $key => $value)
            {
                if($value!=0){
                    $media = Media::findOrFail($key);
                    $admin__branch = Admin_Branch::firstOrNew(['branch_id'=>$value,'target_id'=>$key,'target_type'=>'media']);
                    $admin__branch->save();
                }
            }
            Session::flash('success', 'Branch Selected');
            return redirect('/branch-select');
        }
        else{
            return redirect('/home');
        }


    }
    public function select_pending_branch_video()
    {
        if(Auth::user()->branches()->where('branches.id',1)->count() > 0 ) {
            $pending = Video::where('permission',1)->has('admin__branches','<',1)->get();
            $branch = Branch::where('id','<>','1')->get();
            return view('admin.verify.branch_select_video', compact('pending', 'branch'));
        }
        else{
            return redirect('/home');
        }
    }
    public function select_pending_branch_video_post()
    {
        if(Auth::user()->branches()->where('branches.id',1)->count() > 0 )
        {
            foreach (request('branch') as $key => $value)
            {
                if($value!=0){
                    $video = Video::findOrFail($key);
                    $admin__branch = Admin_Branch::firstOrNew(['branch_id'=>$value,'target_id'=>$key,'target_type'=>'video']);
                    $admin__branch->save();
                }
            }
            Session::flash('success', 'Branch Selected');
            return redirect('/branch-select');
        }
        else{
            return redirect('/home');
        }

    }

    public function branch_image()
    {
        $branches = Auth::user()->branches()->select('branches.id')->get();
        $brancheId = [];
        foreach ($branches as $branch){
            $brancheId[] = $branch->id;
        }
            $medias = Media::whereHas('admin__branches',function ($q) use ($brancheId){
                $q->whereIn('admin__branches.branch_id',$brancheId);
            })->where('permission',6)->orWhere('permission', 7)->get();
        $branch_name=Branch::where('id',$brancheId)->get();
        return view('admin.branch.index', compact('medias','branch_name'));
    }
}
