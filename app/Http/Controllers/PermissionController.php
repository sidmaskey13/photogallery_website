<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:permissions-superadmin');
    }

    public function allpermissions()
    {
        $permissions=Permission::all();
        return view('super-admin.permission.index',compact('permissions'));
    }
    public function create(){
        return view('super-admin.permission.create');
    }
    public function postCreate(Request $request){
        \request()->validate([
            'name.*' => ['required', 'string', 'max:255'],
        ]);

        $p=$_POST['name'];
        $count=count($p);
        for($i=0;$i<$count;$i++)
        {
            $per=new Permission;
                $per->name=$p[$i];
                $per->save();
        }
        return redirect('/permission');
    }
    public function destroy($id)
    {
        $p = Permission::findOrFail($id);
        $p->delete();
        return redirect('permission');
    }
}
