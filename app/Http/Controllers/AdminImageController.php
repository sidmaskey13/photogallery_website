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

class AdminImageController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:crud-images-admin', ['only' => [
            'index',
            'create',
            'store',
            'edit',
            'show',
            'update',
            'destroy',

        ]]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medias = Media::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->where('permission', 4)->orWhere('permission', 7)->paginate(12);
        return view('admin.image.index', compact('medias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $tag = Tag::all();
        $license = License::all();
        $branch = Branch::all();
        $license_modify=License::where('type',1)->get();
        $license_usage=License::where('type',2)->get();
        return view('admin.image.create', compact('category', 'tag', 'license_modify','license_usage','branch'));
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

        $stored=request('stored');
        $stored = trim($stored,"[]");
        $stored = explode(",",$stored);

        foreach ($stored as $s){

            $i = trim($s,'"');
            $trimed=substr($i,12);

            $thumbnailPath = "storage/thumbnail/".$trimed;
            if(!($thumbnail=Thumbnail::where('thumbnail_file',$thumbnailPath)->first())){
                Session::flash('error',"Image could not uploaded!. Please upload again");
                return redirect()->back();
            }
        }



        $media = new Media;
        $media->title = request('title');
        $media->info = request('info');
        $media->latitude = request('latitude');
        $media->longitude = request('longitude');
        $media->author_name = request('author_name');
        $media->user_id = Auth::user()->id;
        $media->save();

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

        $c=0;

          $branch_choosen=request('branch');

          if($branch_choosen)
          {
              foreach ($branch_choosen as $value)
              {
                  if($value!=0){
                      $admin__branch = Admin_Branch::firstOrNew(['branch_id'=>$value,'target_id'=>$media->id,'target_type'=>'media']);
                      $admin__branch->save();

                      $user=Auth::user();
                      $notification=new Notification;
                      $notification->user_id=$user->id;
                      $notification->user_type=2;
                      $branch_name=Branch::where('id',$value)->first();

                      $notification->remarks="Image Album added by Admin ".$user->name." to Department ".$branch_name;
                      $notification->save();

                      $per = Media::findOrFail($media->id);
                      $per->permission = 6;
                      $per->save();
                      $c++;
                  }
              }
          }


        if(request('db')=='1'){


            $per = Media::findOrFail($media->id);
            if($c!=0){
                $per->permission = 7;
                $user=Auth::user();
            $notification=new Notification;
            $notification->user_id=$user->id;
            $notification->user_type=2;
            $branch_name=Branch::where('id',$value)->first();

            $notification->remarks="Image Album added by Admin ".$user->name." to Department ".$branch_name;
            $notification->save();
            }
            else{
                $per->permission = 4;
            }
            $per->save();
        }

        foreach (request('category') as $key => $value)
        {
            if($value!=0){
                $category_media = CategoryMedia::firstOrNew(['category_id'=>$value,'target_id'=>$media->id,'target_type'=>'media']);
                $category_media->save();
            }
        }

        $given_tags = $request['tag_test'];
        foreach ($given_tags as $tag) {
            $tags = Tag::firstOrNew(['name' => strtolower($tag)]);
            $tags->save();
            $media->tag()->attach($tags->id);
        }



        foreach ($stored as $s){
            $main_img=new AllImage;
            $main_img->media_id=$media->id;
            $i = trim($s,'"');
            $main_img->image_file=$i;
            $main_img->save();
            $trimed=substr($i,12);
            $thumbnailPath = "storage/thumbnail/".$trimed;
            $watermarkPath = "storage/watermark/".$trimed;
            $mainPath = "storage/img/".$trimed;

            $img = Image::make(url($mainPath));
            $imgHeight=$img->height();
            $imgWidth=$img->width();
            $wmarkHeight=$imgHeight*0.1;
            $w=Image::make('ntb_watermark.png');
            $w->resize(null, $wmarkHeight, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->insert($w, 'bottom-right', 10, 10);

            $filename='img';
            $path_info = pathinfo($watermarkPath)['extension'];
            $file_name = $filename . '_' . time(). '.' .$path_info;
            $x=$imgHeight*.015;
            $y=$imgWidth*.030;
            $author=$media->author_name;

            $img->text($author,  $x,  $y, function($font) use($img)
            {
                $imgHeight=$img->height();
                $fontsize=$imgHeight*.035;
                $font_path = public_path('fonts/font2.ttf');
                $font->file($font_path);
                $font->size($fontsize);
                $font->color('#5F5F5F');
                $font->angle(0);
            });

            $watermarkPath = "storage/watermark/";
            $wpath=$watermarkPath.$file_name;
            $img->save($wpath);

            $thumbnail=Thumbnail::where('thumbnail_file',$thumbnailPath)->first();
            $thumbnail->image_id=$main_img->id;
            $thumbnail->save();

            $watermark=new Watermark;
            $watermark->watermark_file=$wpath;
            $watermark->image_id=$main_img->id;
            $watermark->save();
        }

        Session::flash('success', 'Image Added');
        return redirect('add-image');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $media = Media::findOrFail($id);
        $user = Auth::user()->id;
            return view('admin.image.show', compact('media'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_media = Media::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        $license_modify=License::where('type',1)->get();
        $license_usage=License::where('type',2)->get();
        return view('admin.image.edit', compact('edit_media', 'categories', 'tags', 'license_modify','license_usage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        $notification->remarks="Image Album updated by Admin ".$user->name;
        $notification->save();
        Session::flash('success', 'Image Edited');
        return redirect('/add-image');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
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
        $notification->remarks="Image Album deleted by Admin ".$user->name;
        $notification->save();
        Session::flash('success', 'Image Deleted');
        return redirect('/add-image');
    }
}
