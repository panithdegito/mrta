<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = "ผู้ดูแลระบบ";
        $role->save();
        $p = Permission::where('id', '=', 1)->firstOrFail();
        $role = Role::where('id', '=', 1)->first();
        $role->givePermissionTo($p);
        $p = Permission::where('id', '=', 1)->firstOrFail();
        $role = Role::where('id', '=', 2)->first();
        $role->givePermissionTo($p);
        $p = Permission::where('id', '=', 1)->firstOrFail();
        $role = Role::where('id', '=', 3)->first();
        $role->givePermissionTo($p);
        $p = Permission::where('id', '=', 1)->firstOrFail();
        $role = Role::where('id', '=', 4)->first();
        $role->givePermissionTo($p);
        $p = Permission::where('id', '=', 1)->firstOrFail();
        $role = Role::where('id', '=', 5)->first();
        $role->givePermissionTo($p);

        $role = new Role();
        $role->name = "ผู้ดูแลระบบ (รฟม.)";
        $role->save();
        $p = Permission::where('id', '=', 2)->firstOrFail();
        $role = Role::where('id', '=', 1)->first();
        $role->givePermissionTo($p);
        $p = Permission::where('id', '=', 2)->firstOrFail();
        $role = Role::where('id', '=', 2)->first();
        $role->givePermissionTo($p);
        $p = Permission::where('id', '=', 2)->firstOrFail();
        $role = Role::where('id', '=', 3)->first();
        $role->givePermissionTo($p);
        $p = Permission::where('id', '=', 2)->firstOrFail();
        $role = Role::where('id', '=', 4)->first();
        $role->givePermissionTo($p);
        $p = Permission::where('id', '=', 2)->firstOrFail();
        $role = Role::where('id', '=', 5)->first();
        $role->givePermissionTo($p);

        $role = new Role();
        $role->name = "ผู้รับเหมา";
        $role->save();
        $p = Permission::where('id', '=', 3)->firstOrFail();
        $role = Role::where('id', '=', 4)->first();
        $role->givePermissionTo($p);

    }
}
