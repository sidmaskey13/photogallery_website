<?php

namespace App\Http\Controllers;
use App\Branch;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;



class SuperAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admins-superadmin');

    }

    public function admin_index()
    {
        $admins=User::all();
        return view('super-admin.admin.index-admin',compact('admins'));
    }

    public function admin_create()
    {
        $branches=Branch::all();
        return view('super-admin.admin.create-admin',compact('branches'));
    }

    public function admin_store(Request $request)
    {
        \request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],

        ]);
        $user = new User;
        $user->name=request('name');
        $user->email=request('email');
        $pass=request('password');
        $user->password=bcrypt($pass);
        $user->verified='1';
        $user->save();
        $all=$request['branch'];
        $user->assignRole('admin');

        foreach ($all as $a){
            $user->branches()->attach($a);
        }

        Session::flash('success','Admin Added');
        return redirect('/home');
    }

    public function admin_edit($id)
    {
        $edit_admin = User::findOrFail($id);
        $branches=Branch::all();
        return view('super-admin.admin.edit-admin',compact('edit_admin','branches'));
    }

    public function admin_update(Request $request, $id)
    {
        $user = User::findOrFail($id);
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
        $all=$request['branch'];
        $user->branches()->sync($all);

        Session::flash('success','Admin Edited');
        return redirect('/admin');

    }


    public function admin_delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Session::flash('success','Admin Deleted');
        return redirect('/admin');
    }


}
