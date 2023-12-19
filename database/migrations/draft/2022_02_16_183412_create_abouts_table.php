<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_ru');
            $table->string('title_en')->nullable();
            $table->string('subtitle_ru')->nullable();
            $table->string('subtitle_en')->nullable();
            $table->text('description_ru')->nullable();
            $table->text('description_en')->nullable();
            $table->text('describe_ru')->nullable();
            $table->text('describe_en')->nullable();
            $table->string('btn_ru')->nullable();
            $table->string('btn_en')->nullable();
            $table->string('btn_link')->nullable();
            $table->string('bg_image')->nullable();
            $table->string('image')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abouts');
    }
}
