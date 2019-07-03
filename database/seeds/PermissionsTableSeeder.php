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
        //Permisos de Configuracion -> Roles
        Permission::create(['name' => 'roles.index']);
        Permission::create(['name' => 'roles.create']);
        Permission::create(['name' => 'roles.show']);
        Permission::create(['name' => 'roles.edit']);
        Permission::create(['name' => 'roles.destroy']);

        //Permisos de Configuracion -> Asignar Roles
        Permission::create(['name' => 'assing-roles.index']);
        Permission::create(['name' => 'assing-roles.edit']);

        //Permisos de Configuracion -> Invitar Usuario
        Permission::create(['name' => 'guest-user.index']);
        Permission::create(['name' => 'guest-user.create']);
        Permission::create(['name' => 'guest-user.edit']);

        //Permisos de Mi Iglesia -> Config. Mi Iglesia
        Permission::create(['name' => 'churches.index']);
        Permission::create(['name' => 'churches.create']);
        Permission::create(['name' => 'churches.destroy']);

//        factory(Role::class, 50)->create();

        //Rol de Administrador
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

        /* Menu de Configuracion -> Invitar User */
        $admin->givePermissionTo([
            'guest-user.index',
            'guest-user.create',
            'guest-user.edit',
        ]);

        //$admin->givePermissionTo('products.index');
        //$admin->givePermissionTo(Permission::all());

        //Rol de Pastor Jefe de Mision
        $pastor = Role::create(['name' => 'Pastor Jefe de Mision']);

        // Menu Iglesia -> Config. Iglesia
        $pastor->givePermissionTo([
            'churches.index',
            'churches.create',
            'churches.destroy',
        ]);

        /*Rol de quien maneja el ingreso de diezmo para control del pastor*/
        // $guest = Role::create(['name' => 'TitheWriter']);

        //User Admin y Shepherd
        $user = User::find(6); //Administrator Rodriguez
        $user->assignRole('Administrator');
        $user = User::find(7); //Pastor Rodriguez
        $user->assignRole('Pastor Jefe de Mision');


    }
}
