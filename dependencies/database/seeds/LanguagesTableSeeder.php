<?php

use Illuminate\Database\Seeder;
use App\Language;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $language = new Language();
        $language->name = "ไทย";
        $language->abbreviation = "th";
        $language->default = 1;
        $language->save();

        $language = new Language();
        $language->name = "English";
        $language->abbreviation = "en";
        $language->save();
    }
}
