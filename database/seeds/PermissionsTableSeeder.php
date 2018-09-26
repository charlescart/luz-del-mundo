<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permission list
        Permission::create(['name' => 'products.index']);
        Permission::create(['name' => 'products.edit']);
        Permission::create(['name' => 'products.show']);
        Permission::create(['name' => 'products.create']);
        Permission::create(['name' => 'products.destroy']);
        Permission::create(['name' => 'roles.index']);

        //Admin
        $admin = Role::create(['name' => 'Administrator']);

        $admin->givePermissionTo([
            'products.index',
            'products.edit',
            'products.show',
            'products.create',
            'products.destroy',
            'roles.index',
        ]);
        //$admin->givePermissionTo('products.index');
        //$admin->givePermissionTo(Permission::all());

        //Guest
        $guest = Role::create(['name' => 'Member']);

        $guest->givePermissionTo([
            'products.index',
            'products.show'
        ]);

        //User Admin y Guest
        $user = User::find(1); //Charles Rodriguez
        $user->assignRole('Administrator');
        $user = User::find(2); //Aarón Rodriguez
        $user->assignRole('Member');
    }
}
