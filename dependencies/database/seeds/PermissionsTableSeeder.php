<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = new Permission();
        $permission->name = "ข่าวสารและกิจกรรม";
        $permission->save();

        $permission = new Permission();
        $permission->name = "หน้าเว็บ";
        $permission->save();

        $permission = new Permission();
        $permission->name = "เมนู";
        $permission->save();

        $permission = new Permission();
        $permission->name = "มีเดีย";
        $permission->save();

        $permission = new Permission();
        $permission->name = "ความคืบหน้าโครงการ";
        $permission->save();

        $permission = new Permission();
        $permission->name = "ตั้งค่า";
        $permission->save();
    }

}
