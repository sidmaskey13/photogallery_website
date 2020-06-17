<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:users-superadmin');
    }

    public function index()
    {
        $user=User::all();
        return view('super-admin.user.index',compact('user'));
    }
    public function show($id)
    {
        $user=User::findorfail($id);
        $permission=Permission::all();
        $roles=Role::all();

        $selected_role=$user->getRoleNames()->first();
        $tick=$user->getDirectPermissions();
        return view('super-admin.user.show',compact('user','permission','tick','roles','selected_role'));
    }
    public function update(Request $request)
    {
        $u = User::findorfail(request('user'));
        $ticked = request('permission');
        $role = request('role');
        $allpermissions = Permission::all();
        $u->revokePermissionTo($allpermissions);
        $u->syncRoles($role);
        $u->givePermissionTo($ticked);
        Session::flash('success','User Updated');
        return redirect('users');

    }

    public function destroy($id)
    {
        $p = Permission::findOrFail($id);
        $p->delete();
        return redirect('permissions');
    }

    public function delete_user($id)
    {
        $user=User::findorfail($id);
        $role=$user->getRoleNames()->first();
        if($role=='super-admin'){
            Session::flash('error','Superadmin cant be deleted');
        }
        else{
                    $user->delete();
            Session::flash('success','User Deleted');
        }

        return redirect('users');
    }
}
