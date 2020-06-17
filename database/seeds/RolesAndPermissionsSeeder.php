<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


//uploader

        Permission::create(['name' => 'photos-uploader']);
        Permission::create(['name' => 'videos-uploader']);


        //admin

        Permission::create(['name' => 'approve-media-admin']);
        Permission::create(['name' => 'add-welcome-photos']);
        Permission::create(['name' => 'edit-media-admin']);
        Permission::create(['name' => 'verify-users-admin']);
        Permission::create(['name' => 'crud-images-admin']);
        Permission::create(['name' => 'select-branch-admin']);

        //super-admin

        Permission::create(['name' => 'categories-superadmin']);
        Permission::create(['name' => 'licenses-superadmin']);
        Permission::create(['name' => 'admins-superadmin']);
        Permission::create(['name' => 'branch-superadmin']);
        Permission::create(['name' => 'permissions-superadmin']);
        Permission::create(['name' => 'roles-superadmin']);
        Permission::create(['name' => 'users-superadmin']);
        Permission::create(['name' => 'change-terms-superadmin']);

        Role::create(['name' => 'super-admin'])->givePermissionTo([
            'categories-superadmin',
            'licenses-superadmin',
            'admins-superadmin',
            'branch-superadmin',
            'permissions-superadmin',
            'roles-superadmin',
            'users-superadmin',
            'change-terms-superadmin',
        ]);



        Role::create(['name' => 'admin'])->givePermissionTo([
            'approve-media-admin',
            'add-welcome-photos',
            'edit-media-admin',
            'verify-users-admin',
            'crud-images-admin',
            'select-branch-admin',
            ]);

        Role::create(['name' => 'uploader'])->givePermissionTo([
            'photos-uploader',
            'videos-uploader',
        ]);



        DB::table('model_has_roles')->insert([
            [
                'role_id' => 1,
                'model_type' => 'App\User',
                'model_id' => 1,
            ],

        ]);

        DB::table('branches')->insert([
            [
                'name' => 'Main',
            ],
        ]);




    }
}
