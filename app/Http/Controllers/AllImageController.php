<?php

namespace App\Http\Controllers;

use App\AllImage;
use App\ImageUpload;
use App\Media;
use App\Thumbnail;
use App\Watermark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

use Intervention\Image\ImageManagerStatic as Image;



class AllImageController extends Controller
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
    public function goto()
    {
        return view('media.add-images');
    }
    public function create()
    {
        return view('media.add-images');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set ( "memory_limit", "4000M");
        if($request->hasFile('file')) {
            $filenamewithext = request()->file('file')->getClientOriginalName(); //filename with extension
            $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);  //just filename
            $extension = $request->file('file')->getClientOriginalExtension(); //just extention
            $thumbnailPathMain = "storage/img/";
            $file_name = $filename . '_' . time() . '.' . $extension;
            $filenametostore = $thumbnailPathMain . $file_name;

            $path_img = \request()->file('file')->storeAs('img', $file_name);


            //for main image
            $imageUpload = new ImageUpload;
            $imageUpload->filename = $filenametostore;
            $imageUpload->save();

            $originalImage= $request->file('file');
            $thumbnailImage = Image::make($originalImage);
            $thumbnailImage->resize(null, 230, function ($constraint) {
                $constraint->aspectRatio();
            });



            //for thumbnail
            $thumbnailPath = "storage/thumbnail/";
            $tpath=$thumbnailPath.$file_name;
            $thumbnailImage->save($tpath);
            $thumbnail= new Thumbnail;
            $thumbnail->thumbnail_file=$tpath;
            $thumbnail->save();

            //for watermark
//            $image = $request->file('file');
//            $img=Image::make($image);
//            $imgHeight=$img->height();
//            $imgWidth=$img->width();
//            $wmarkHeight=$imgHeight*0.1;
//            $w=Image::make('ntb_watermark.png');
//            $w->resize(null, $wmarkHeight, function ($constraint) {
//                $constraint->aspectRatio();
//            });
//            $img->insert($w, 'bottom-right', 10, 10);
//            $x=$imgHeight*.07;
//            $y=$imgWidth*.05;
//            while($y<=$imgHeight){
//                $img->text('Nepal Tourism Board', $x, $y, function($font) use($img) {
//
//                    $imgHeight=$img->height();
//                    $fontsize=$imgHeight*.019;
//                    $font_path = public_path('fonts/font2.ttf');
//                    $font->file($font_path);
//                    $font->size($fontsize);
////                    $font->color(array(255, 255, 255, 0.8));
//                    $font->color('#FFFFFF');
//                    $font->align('center');
//                    $font->valign('top');
//                    $font->angle(45);
//                });
//                $x+=($imgHeight*0.3);
//                if($x>=$imgWidth){
//                    $x=0;
//                    $y+=($imgWidth*0.3);
//                }
//            }
//
//            $watermarkPath = "storage/watermark/";
//            $wpath=$watermarkPath.$file_name;
//            $img->save($wpath);
//
//            $watermark=new Watermark;
//            $watermark->watermark_file=$wpath;
//            $watermark->save();

            return response()->json(['name'=>$filenametostore]);

        }





    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AllImage  $allImage
     * @return \Illuminate\Http\Response
     */
    public function show(AllImage $allImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AllImage  $allImage
     * @return \Illuminate\Http\Response
     */
    public function edit(AllImage $allImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AllImage  $allImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AllImage $allImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AllImage  $allImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $request->all();
        $filename =  $request->get('filename');
        ImageUpload::where('filename',$filename)->delete();
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
        $image = AllImage::findOrFail($id);
        $img = ImageUpload::where('filename',$image->image_file)->first();
        $image->delete();
        if (File::exists($img->filename)) {
            $img->delete();
            unlink($img->filename);
        }
        return response()->json(['id'=>$id]);
    }
}
