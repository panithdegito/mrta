<?php

use Illuminate\Database\Seeder;

class StationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $station = new \App\Station();
        $station->code = "OR14";
        $station->kilometer_marker = 13.54;
        $station->status_id = 2;
        $station->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "th";
        $station_translation->name = "ศูนย์วัฒนธรรมแห่งประเทศไทย";
        $station_translation->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "en";
        $station_translation->name = "Thailand Cultural Center";
        $station_translation->save();

        $station = new \App\Station();
        $station->code = "OR15";
        $station->kilometer_marker = 15.05;
        $station->status_id = 2;
        $station->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "th";
        $station_translation->name = "รฟม.";
        $station_translation->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "en";
        $station_translation->name = "MRTA";
        $station_translation->save();

        $station = new \App\Station();
        $station->code = "OR16";
        $station->kilometer_marker = 16.62;
        $station->status_id = 2;
        $station->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "th";
        $station_translation->name = "ประดิษฐ์มนูธรรม";
        $station_translation->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "en";
        $station_translation->name = "Pradit Manutham";
        $station_translation->save();

        $station = new \App\Station();
        $station->code = "OR17";
        $station->kilometer_marker = 18.77;
        $station->status_id = 2;
        $station->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "th";
        $station_translation->name = "รามคำแหง 12";
        $station_translation->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "en";
        $station_translation->name = "Ramkhamhaeng 12";
        $station_translation->save();

        $station = new \App\Station();
        $station->code = "OR18";
        $station->kilometer_marker = 19.98;
        $station->status_id = 2;
        $station->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "th";
        $station_translation->name = "มหาวิทยาลัยรามคำแหง";
        $station_translation->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "en";
        $station_translation->name = "Ramkhamhaeng University";
        $station_translation->save();

        $station = new \App\Station();
        $station->code = "OR19";
        $station->kilometer_marker = 20.93;
        $station->status_id = 2;
        $station->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "th";
        $station_translation->name = "ราชมังคลา";
        $station_translation->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "en";
        $station_translation->name = "Rajamangala";
        $station_translation->save();

        $station = new \App\Station();
        $station->code = "OR20";
        $station->kilometer_marker = 22.20;
        $station->status_id = 2;
        $station->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "th";
        $station_translation->name = "หัวหมาก";
        $station_translation->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "en";
        $station_translation->name = "Hua Mak";
        $station_translation->save();

        $station = new \App\Station();
        $station->code = "OR21";
        $station->kilometer_marker = 23.20;
        $station->status_id = 2;
        $station->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "th";
        $station_translation->name = "ลำสาลี";
        $station_translation->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "en";
        $station_translation->name = "Lam Sali";
        $station_translation->save();

        $station = new \App\Station();
        $station->code = "OR22";
        $station->kilometer_marker = 24.56;
        $station->status_id = 2;
        $station->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "th";
        $station_translation->name = "ศรีบูรพา";
        $station_translation->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "en";
        $station_translation->name = "Si Burapha";
        $station_translation->save();

        $station = new \App\Station();
        $station->code = "OR23";
        $station->kilometer_marker = 25.75;
        $station->status_id = 2;
        $station->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "th";
        $station_translation->name = "คลองบ้านม้า";
        $station_translation->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "en";
        $station_translation->name = "Khlong Ban Ma";
        $station_translation->save();

        $station = new \App\Station();
        $station->code = "OR24";
        $station->kilometer_marker = 26.73;
        $station->status_id = 2;
        $station->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "th";
        $station_translation->name = "สัมมากร";
        $station_translation->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "en";
        $station_translation->name = "Sammakon";
        $station_translation->save();

        $station = new \App\Station();
        $station->code = "OR25";
        $station->kilometer_marker = 28.66;
        $station->status_id = 2;
        $station->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "th";
        $station_translation->name = "น้อมเกล้า";
        $station_translation->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "en";
        $station_translation->name = "Nom Klao";
        $station_translation->save();

        $station = new \App\Station();
        $station->code = "OR26";
        $station->kilometer_marker = 29.95;
        $station->status_id = 2;
        $station->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "th";
        $station_translation->name = "ราษฎร์พัฒนา";
        $station_translation->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "en";
        $station_translation->name = "Rat Phatthana";
        $station_translation->save();

        $station = new \App\Station();
        $station->code = "OR27";
        $station->kilometer_marker = 31.01;
        $station->status_id = 2;
        $station->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "th";
        $station_translation->name = "วัดบางเพ็ง";
        $station_translation->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "en";
        $station_translation->name = "Wat Bang Pheng";
        $station_translation->save();

        $station = new \App\Station();
        $station->code = "OR28";
        $station->kilometer_marker = 32.59;
        $station->status_id = 2;
        $station->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "th";
        $station_translation->name = "เคหะรามคำแหง";
        $station_translation->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "en";
        $station_translation->name = "Kheha Ramkhamhaeng";
        $station_translation->save();

        $station = new \App\Station();
        $station->code = "OR29";
        $station->kilometer_marker = 33.85;
        $station->status_id = 2;
        $station->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "th";
        $station_translation->name = "มีนบุรี";
        $station_translation->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "en";
        $station_translation->name = "Min Buri";
        $station_translation->save();

        $station = new \App\Station();
        $station->code = "OR30";
        $station->kilometer_marker = 34.63;
        $station->status_id = 2;
        $station->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "th";
        $station_translation->name = "สุวินทวงศ์";
        $station_translation->save();
        $station_translation = new \App\StationTranslation();
        $station_translation->station_id = $station->id;
        $station_translation->local = "en";
        $station_translation->name = "Suwinthawong";
        $station_translation->save();
    }
}
