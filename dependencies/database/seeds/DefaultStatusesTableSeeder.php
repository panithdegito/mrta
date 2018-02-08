<?php

use Illuminate\Database\Seeder;
use App\DefaultStatus;
class DefaultStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = new DefaultStatus();
        $status->name = "Publish";
        $status->save();

        $status = new DefaultStatus();
        $status->name = "Draft";
        $status->save();
    }
}
