<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConstructTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('construct_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('construct_id')->unsigned();
            $table->string('local',2);
            $table->string('title');
            $table->text('content');
            $table->timestamps();
            $table->foreign('construct_id')->references('id')->on('constructs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('construct_translations');
    }
}
