<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'user-self-edit']);
        Permission::create(['name' => 'user-self-delete']);
        Permission::create(['name' => 'user-edit']);
        Permission::create(['name' => 'user-delete']);
        Permission::create(['name' => 'user-create']);
        Permission::create(['name' => 'user-view']);
        Permission::create(['name' => 'result-self-record']);
        Permission::create(['name' => 'result-self-edit']);
        Permission::create(['name' => 'result-self-delete']);
        Permission::create(['name' => 'result-record']);
        Permission::create(['name' => 'result-edit']);
        Permission::create(['name' => 'result-delete']);
        Permission::create(['name' => 'result-view']);
        Permission::create(['name' => 'club-create']);
        Permission::create(['name' => 'club-self-edit']);
        Permission::create(['name' => 'club-self-delete']);
        Permission::create(['name' => 'club-self-invite']);
        Permission::create(['name' => 'club-self-fire']);
        Permission::create(['name' => 'club-edit']);
        Permission::create(['name' => 'club-delete']);
        Permission::create(['name' => 'club-add-member']);
        Permission::create(['name' => 'club-remove-member']);
        Permission::create(['name' => 'user-make-admin']);


        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'player']);
        $role->givePermissionTo('user-self-edit');
        $role->givePermissionTo('user-self-delete');
        $role->givePermissionTo('user-view');
        $role->givePermissionTo('result-self-record');
        $role->givePermissionTo('result-self-edit');
        $role->givePermissionTo('result-self-delete');
        $role->givePermissionTo('result-view');
        $role->givePermissionTo('club-create');


        // or may be done by chaining
        $role = Role::create(['name' => 'club_owner']);
        $role->givePermissionTo('user-self-edit');
        $role->givePermissionTo('user-self-delete');
        $role->givePermissionTo('user-view');
        $role->givePermissionTo('result-self-record');
        $role->givePermissionTo('result-self-edit');
        $role->givePermissionTo('result-self-delete');
        $role->givePermissionTo('result-view');
        $role->givePermissionTo('club-create');
        $role->givePermissionTo('club-self-edit');
        $role->givePermissionTo('club-self-delete');
        $role->givePermissionTo('club-self-invite');
        $role->givePermissionTo('club-self-fire');


        $role = Role::create(['name' => 'administrator']);
        $role->givePermissionTo('user-create');
        $role->givePermissionTo('user-edit');
        $role->givePermissionTo('user-delete');
        $role->givePermissionTo('user-view');
        $role->givePermissionTo('result-record');
        $role->givePermissionTo('result-edit');
        $role->givePermissionTo('result-delete');
        $role->givePermissionTo('result-view');
        $role->givePermissionTo('club-create');
        $role->givePermissionTo('club-edit');
        $role->givePermissionTo('club-delete');
        $role->givePermissionTo('club-add-member');
        $role->givePermissionTo('club-remove-member');
        $role->givePermissionTo('user-make-admin');
    }
}
