<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_ru');
            $table->string('title_en')->nullable();
            $table->string('slug')->unique();
            $table->text('description_ru')->nullable();
            $table->text('description_en')->nullable();
            $table->string('image')->nullable();
            $table->boolean('form')->default(0);
            $table->tinyInteger('rubric')->default(0);
            $table->tinyInteger('order')->default(0);
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
        Schema::dropIfExists('articles');
    }
}