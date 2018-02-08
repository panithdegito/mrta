<?php

use Illuminate\Database\Seeder;
use App\ConstructPercent;

class ConstructPercentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $percent = new ConstructPercent();
        $percent->percent = 0;
        $percent->save();
    }
}
