<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone')->nullable();
            $table->string('mail')->nullable();
            $table->string('time_ru')->nullable();
            $table->string('time_en')->nullable();
            $table->string('delivery_ru')->nullable();
            $table->string('delivery_en')->nullable();
            $table->string('street_ru')->nullable();
            $table->string('street_en')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('tiktok_link')->nullable();
            $table->string('overlay')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_b')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
