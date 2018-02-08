<?php

use Illuminate\Database\Seeder;
use App\General;
use App\GeneralTranslation;

class GeneralsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $general = new General();
        $general->save();

        $translation = new GeneralTranslation();
        $translation->general_id = $general->id;
        $translation->local = "th";
        $translation->title = "โครงการรถไฟฟ้าสายสีส้ม | การรถไฟฟ้าขนส่งมวลชนแห่งประเทศไทย";
        $translation->description = "โครงการรถไฟฟ้าสายสีส้ม";
        $translation->keyword = "การไฟฟ้าขนส่งมวลชนแห่งประเทศไทย,Mass Rapid Transit Authority of Thailand,รฟม.,M.R.T Chaloem Ratchamongkhon Line,MRT,the MRT Puple Line Project,MRTA,the MRT Blue Line Extension Project,รถไฟฟ้า,โครงการรถไฟฟ้า,โครงการรถไฟฟ้าสายสีม่วง,โครงการรถไฟฟ้าสายสีน้ำเงิน,โครงการรถไฟฟ้าสายสีเขียว,โครงการรถไฟฟ้าสายสีชมพู,โครงการรถไฟฟ้าสายสีเหลือง,โครงการรถไฟฟ้าสายสีส้ม,MRT,MRTA";
        $translation->save();

        $translation = new GeneralTranslation();
        $translation->general_id = $general->id;
        $translation->local = "en";
        $translation->title = "THE ORANGE LINE | Mass Rapid Transit Authority of Thailand";
        $translation->description = "THE ORANGE LINE";
        $translation->keyword = "การไฟฟ้าขนส่งมวลชนแห่งประเทศไทย,Mass Rapid Transit Authority of Thailand,รฟม.,M.R.T Chaloem Ratchamongkhon Line,MRT,the MRT Puple Line Project,MRTA,the MRT Blue Line Extension Project,รถไฟฟ้า,โครงการรถไฟฟ้า,โครงการรถไฟฟ้าสายสีม่วง,โครงการรถไฟฟ้าสายสีน้ำเงิน,โครงการรถไฟฟ้าสายสีเขียว,โครงการรถไฟฟ้าสายสีชมพู,โครงการรถไฟฟ้าสายสีเหลือง,โครงการรถไฟฟ้าสายสีส้ม,MRT,MRTA";
        $translation->save();


    }
}
