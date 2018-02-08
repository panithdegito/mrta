<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('general_id')->unsigned();
            $table->string('local',2);
            $table->string('title');
            $table->text('description');
            $table->text('keyword');
            $table->timestamps();
            $table->foreign('general_id')->references('id')->on('generals');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_translations');
    }
}
