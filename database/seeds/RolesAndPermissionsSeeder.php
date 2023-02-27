<?php

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $user = new User();
        $user->name = 'iftekhar';
        $user->email = 'iftekhar@gmail.com';
        $user->password = bcrypt('password');
        $user->phone_number = '01521466101';

        $address = Address::create([
            'address' => '11/18 pallabi, mirpur 12',
        ]);
        $user->address_id = $address->id;

        $user->save();

        // create permissions
        Permission::create(['name' => 'add game']);
        Permission::create(['name' => 'update game']);
        Permission::create(['name' => 'delete game']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('add game');
        $role->givePermissionTo('update game');
        $role->givePermissionTo('delete game');

        $user->assignRole($role);

//        $role->givePermissionTo('edit doctor_list');

        // or may be done by chaining
//        $role = Role::create(['name' => 'moderator'])
//            ->givePermissionTo(['publish articles', 'unpublish articles']);

//        $role = Role::create(['name' => 'super-admin']);
//        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'customer']);
    }
}
