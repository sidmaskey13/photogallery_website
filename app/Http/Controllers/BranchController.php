<?php

namespace App\Http\Controllers;

use App\Branch;
use Auth;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BranchController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:branch-superadmin');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::all();
        return view('super-admin.branch.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super-admin.branch.create');
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
            'name.*' => 'required|string|distinct',
        ]);


        $branch = $_POST['name'];
        $count = count($branch);
        for ($i = 0; $i < $count; $i++) {
            $c = new Branch();
            $c->name = $branch[$i];
            $c->save();
        }
        $user=Auth::user();
        $notification=new Notification;
        $notification->user_id=$user->id;
        $notification->user_type=3;
        $notification->remarks="Branch added by ".$user->name;
        $notification->save();
        Session::flash('success', 'Branches Added');
        return redirect('/branch');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        return view('super-admin.branch.edit',compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $branch=Branch::findOrFail($id);
        $branch->name=request('branch');
        $branch->save();
        $user=Auth::user();
        $notification=new Notification;
        $notification->user_id=$user->id;
        $notification->user_type=3;
        $notification->remarks="Branch updated by ".$user->name;
        $notification->save();
        Session::flash('success', 'Branches Edited');
        return redirect('/branch');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        if($branch->users()->count() == 0) {
            $branch->delete();
            Session::flash('success', 'Category Deleted');
        }
        $user=Auth::user();
        $notification=new Notification;
        $notification->user_id=$user->id;
        $notification->user_type=3;
        $notification->remarks="Branch deleted by ".$user->name;
        $notification->save();
        return redirect('/branch');
    }
}
