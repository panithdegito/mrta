<?php

use Illuminate\Database\Seeder;

class StationStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = new \App\StationStatus();
        $status->name = "ใช้งาน / แล้วเสร็จ";
        $status->save();

        $status = new \App\StationStatus();
        $status->name = "กำลังก่อสร้าง";
        $status->save();

        $status = new \App\StationStatus();
        $status->name = "ยกเลิก";
        $status->save();
    }
}
