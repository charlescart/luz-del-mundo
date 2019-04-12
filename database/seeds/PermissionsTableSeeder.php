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
        Permission::create(['name' => 'roles.index']);
        Permission::create(['name' => 'roles.create']);
        Permission::create(['name' => 'roles.show']);
        Permission::create(['name' => 'roles.edit']);
        Permission::create(['name' => 'roles.destroy']);

        factory(Role::class, 100)->create();

        //Admin
        $admin = Role::create(['name' => 'Administrator']);

        $admin->givePermissionTo([
            'roles.index',
            'roles.create',
            'roles.show',
            'roles.edit',
            'roles.destroy',
        ]);
        //$admin->givePermissionTo('products.index');
        //$admin->givePermissionTo(Permission::all());

        //Guest
        $guest = Role::create(['name' => 'Shepherd']);

        $guest->givePermissionTo([
            'roles.index',
            'roles.show'
        ]);

        //User Admin y Shepherd
        $user = User::find(6); //Administrator Rodriguez
        $user->assignRole('Administrator');
        $user = User::find(7); //Pastor Rodriguez
        $user->assignRole('shepherd');


    }
}
