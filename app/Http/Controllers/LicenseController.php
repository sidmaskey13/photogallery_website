<?php

namespace App\Http\Controllers;

use App\License;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LicenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:licenses-superadmin');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $licenses=License::all();
        return view('super-admin.license.index',compact('licenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super-admin.license.create');
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
            'name' => 'required|string',
            'type' => 'required',
        ]);

        $license_name=request('name');
        $type=request('type');
$license=new License;
$license->name=$license_name;
$license->type=$type;
$license->save();

        Session::flash('success','Licenses Added');
        return redirect('/home');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\License  $license
     * @return \Illuminate\Http\Response
     */
    public function show(License $license)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\License  $license
     * @return \Illuminate\Http\Response
     */
    public function edit(License $license)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\License  $license
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, License $license)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\License  $license
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $license = License::findOrFail($id);
        if(!(($license->media()->count() > 0) || ($license->video()->count() > 0)) ) {
            $license->delete();
            Session::flash('success', 'License Deleted');
        }
        return redirect('/license');
    }
}
