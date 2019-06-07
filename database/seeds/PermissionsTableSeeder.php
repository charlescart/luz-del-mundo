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

        Permission::create(['name' => 'assing-roles.index']);
        Permission::create(['name' => 'assing-roles.edit']);

        Permission::create(['name' => 'guestUser.index']);
        Permission::create(['name' => 'guestUser.create']);
        Permission::create(['name' => 'guestUser.show']);
        Permission::create(['name' => 'guestUser.edit']);
        Permission::create(['name' => 'guestUser.destroy']);

//        factory(Role::class, 50)->create();

        //Admin
        $admin = Role::create(['name' => 'Administrator']);

        /* Menu de Configuracion -> Roles */
        $admin->givePermissionTo([
            'roles.index',
            'roles.create',
            'roles.show',
            'roles.edit',
            'roles.destroy',
        ]);

        /* Menu de Configuracion -> Asignar Roles */
        $admin->givePermissionTo([
            'assing-roles.index',
            'assing-roles.edit',
        ]);

        /* Menu de Configuracion -> Invitar User, table "guest_users" */
        $admin->givePermissionTo([
            'guestUser.index',
            'guestUser.create',
            'guestUser.show',
            'guestUser.edit',
            'guestUser.destroy',
        ]);

        //$admin->givePermissionTo('products.index');
        //$admin->givePermissionTo(Permission::all());

        //Guest
        $guest = Role::create(['name' => 'Shepherd']);

        $guest->givePermissionTo([
            'roles.index',
            'roles.show'
        ]);

        /*Rol de quien maneja el ingreso de diezmo para control del pastor*/
        // $guest = Role::create(['name' => 'TitheWriter']);

        //User Admin y Shepherd
        $user = User::find(6); //Administrator Rodriguez
        $user->assignRole('Administrator');
        $user = User::find(7); //Pastor Rodriguez
        $user->assignRole('Shepherd');


    }
}
