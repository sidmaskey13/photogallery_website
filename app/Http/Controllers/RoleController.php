<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:roles-superadmin');
    }
    public function create()
     {
        $permissions=Permission::all();
        return view('super-admin.role.create',compact('permissions'));
     }
    public function index()
     {
        $roles=Role::all();
        return view('super-admin.role.index',compact('roles'));
     }

    public function postCreate(Request $request)
     {
         \request()->validate([
             'name' => ['required', 'string', 'max:255','distinct'],
         ]);

        $r = request('name');
        $name = Role::create(['name' => $r]);
        $ticked = request('permission');
        $insertedId = $name->id;
        $role=Role::findById($insertedId);
        $role->givePermissionTo($ticked);
        return redirect('role');
     }
    public function edit($id)
     {
      $role=Role::findById($id);
      $all=Permission::all();
      $permissions = $role->permissions;
        return view('super-admin.role.edit',compact('role','permissions','all'));
     }
    public function update(Request $request, $id)
     {
         \request()->validate([
             'name' => ['required', 'string', 'max:255','distinct'],
         ]);

        $role=Role::findById($id);
        $allpermissions = Permission::all();
        $role->revokePermissionTo($allpermissions);
        $ticked=request('permission');
        $role->givePermissionTo($ticked);
        return redirect('role');
     }

    public function destroy($id)
    {
        $p = Role::findOrFail($id);
        $p->delete();
        return redirect('role');
    }
}
