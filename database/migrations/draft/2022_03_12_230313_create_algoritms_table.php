<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlgoritmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('algoritms', function (Blueprint $table) {
            $table->id();
            $table->integer('y1')->nullable();
            $table->integer('y2')->nullable();
            $table->integer('y3')->nullable();
            $table->integer('x1')->nullable();
            $table->integer('x2')->nullable();
            $table->integer('z1')->nullable();
            $table->integer('z2')->nullable();
            $table->integer('z3')->nullable();
            $table->integer('z4')->nullable();
            $table->integer('z5')->nullable();
            $table->integer('z6')->nullable();
            $table->integer('z7')->nullable();
            $table->integer('z8')->nullable();
            $table->integer('z9')->nullable();
            $table->integer('z10')->nullable();
            $table->integer('z11')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('algoritms');
    }
}
