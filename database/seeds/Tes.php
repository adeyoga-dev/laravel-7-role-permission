<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class Tes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset cahced roles and permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // crete permission user
        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'show user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'active user']);
        Permission::create(['name' => 'non-active user']);
        // crete permission role
        Permission::create(['name' => 'view role']);
        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'show role']);
        Permission::create(['name' => 'edit role']);
        Permission::create(['name' => 'delete role']);
        Permission::create(['name' => 'active role']);
        Permission::create(['name' => 'non-active role']);
        // crete permission permission
        Permission::create(['name' => 'view permission']);
        Permission::create(['name' => 'show permission']);
        Permission::create(['name' => 'create permission']);
        Permission::create(['name' => 'edit permission']);
        Permission::create(['name' => 'delete permission']);
        //create roles and assign existing permissions
        $super_admin = Role::create(['name' => 'super-admin']);
        // //create roles and assign existing permissions
        // $writerRole = Role::create(['name' => 'writer']);
        // $writerRole->givePermissionTo('view posts');
        // create demo users
        $user = User::create([
            'name' => 'Muhammad Rizki Adeyoga',
            'nik' => '1822003',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($super_admin);
        User::create([
            'name' => 'Admin',
            'nik' => '1822004',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        User::create([
            'name' => 'User 1',
            'nik' => '1822005',
            'email' => 'user1@gmail.com',
            'password' => bcrypt('12345678')
        ]);
    }
}
