<?php

namespace App\Http\Controllers;

use App\AllImage;
use App\AllVideo;
use App\Category;
use App\Homepage;
use App\License;
use App\Mail\VerifyUser;
use App\Media;
use App\Video;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

//user dashboard

        $user = Auth::user();


        $upload_images_album=Media::where('user_id',$user->id)->count();
        $upload_videos_album=Video::where('user_id',$user->id)->count();
        $upload_approved_image_album=Media::where('user_id',$user->id)->where('permission',2)->count();
        $upload_approved_video_album=Video::where('user_id',$user->id)->where('permission',2)->count();
        $all_my_images=Media::select('all_images.id')->join('all_images','all_images.media_id','media.id')->where('user_id',$user->id)->where('permission',2)->count();
        $all_my_videos=Video::select('all_videos.id')->join('all_videos','all_videos.video_id','videos.id')->where('user_id',$user->id)->where('permission',2)->count();


        $all_my_images_selected=Media::select('all_images.id')
            ->join('all_images','all_images.media_id','media.id')
            ->where('user_id',$user->id)
            ->where('permission',2)
            ->get();
        $all_my_images_selected_homepage=Homepage::whereIn('image_id',$all_my_images_selected->pluck('id'))->count();


//admin dashboard
        $branches = Auth::user()->branches()->select('branches.id')->get();
        $brancheId = [];
        foreach ($branches as $branch){
            $brancheId[] = $branch->id;
        }
        $images=Media::where('permission',2)->count();
//        $pending_images=Media::where('permission',1)->count();

        $pending_images=Media::whereHas('admin__branches',function ($q) use ($brancheId){
            $q->whereIn('admin__branches.branch_id',$brancheId);
        })->where('permission',1)->count();

//        $pending_videos=Video::where('permission',1)->count();
        $pending_videos=Video::whereHas('admin__branches',function ($q) use ($brancheId){
            $q->whereIn('admin__branches.branch_id',$brancheId);
        })->where('permission',1)->count();



$highest_uploader= Media::select('user_id',DB::raw("count(*) as total"))->where('permission',2)->groupBy('user_id')->orderBy('total','DESC')->first();
       if($highest_uploader) {
           $highest_uploader_name = $highest_uploader->user->name;
       }
       else{
           $highest_uploader_name='0';
       }


        $videos=Video::where('permission',2)->count();
        $all_images=Media::select('all_images.id')->join('all_images','all_images.media_id','media.id')->where('permission',2)->count();
        $all_videos=Video::select('all_videos.id')->join('all_videos','all_videos.video_id','videos.id')->where('permission',2)->count();
        $homepage=Homepage::all()->count();;

        $uploaded_images_months_chart = Media::orderBy('created_at', 'asc')->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('M');
        });
        $uploaded_videos_months_chart = Video::orderBy('created_at', 'asc')->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('M');
        });

        $uploaded_images_each_months_chart = Media::orderBy('created_at', 'asc')->where('user_id',$user->id)->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('M');
        });
        $uploaded_videos_each_months_chart = Video::orderBy('created_at', 'asc')->where('user_id',$user->id)->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('M');
        });

        $created_users = User::orderBy('created_at', 'asc')->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('M');
        });
        $admin_images=Media::where('permission',4)->count();

        //super-admin dashboard
        $users=User::all();
        $all_user=User::all()->count();
        $categories=Category::all()->count();
        $licenses=License::all()->count();






        return view('dashboard.home',compact('images','videos','pending_images','pending_videos','all_images','all_videos',
            'homepage','upload_images_album','upload_videos_album','all_my_images','all_my_videos','upload_approved_image_album','upload_approved_video_album','user','all_user'
        ,'users','categories','licenses','uploaded_videos_months_chart','uploaded_images_months_chart','uploaded_images_each_months_chart','uploaded_videos_each_months_chart',
            'all_my_images_selected_homepage','created_users','admin_images','highest_uploader_name'));
    }

    public function terms()
    {
        return view('homepage.terms');
    }

}
