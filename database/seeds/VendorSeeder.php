<?php

use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Spatie\Permission\Models\Permission::create(['name' => 'user assign']);
        \Spatie\Permission\Models\Permission::create(['name' => 'product show']);
        \Spatie\Permission\Models\Permission::create(['name' => 'product create']);
        \Spatie\Permission\Models\Permission::create(['name' => 'product update']);
        \Spatie\Permission\Models\Permission::create(['name' => 'product delete']);

        $role = \Spatie\Permission\Models\Role::create(['name' => 'vendor_admin']);
        $role->givePermissionTo('user assign');
        $role->givePermissionTo('product show');
        $role->givePermissionTo('product create');
        $role->givePermissionTo('product update');
        $role->givePermissionTo('product delete');

        $role = \Spatie\Permission\Models\Role::create(['name' => 'vendor_analyst']);
        $role->givePermissionTo('product show');

        $role = \Spatie\Permission\Models\Role::create(['name' => 'vendor_editor']);
        $role->givePermissionTo('product show');
        $role->givePermissionTo('product create');
        $role->givePermissionTo('product update');
        $role->givePermissionTo('product delete');

        $role = \Spatie\Permission\Models\Role::create(['name' => 'vendor_accountant']);
        $role->givePermissionTo('product show');
    }
}
