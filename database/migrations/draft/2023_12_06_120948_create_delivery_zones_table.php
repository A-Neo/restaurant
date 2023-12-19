<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_zones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('restaurant_id');
            $table->string('title')->nullable();
            $table->string('county')->default('Россия')->nullable();
            $table->string('city')->default('Москва')->nullable();
            $table->string('street')->default('Улица')->nullable();
            $table->text('coordinates')->nullable(); // JSON строка с координатами
            $table->decimal('min_amount', 8, 2)->nullable();
            $table->decimal('free_delivery', 8, 2)->nullable();
            $table->integer('min_time')->nullable();
            $table->integer('max_time')->nullable();
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('delivery_zones');
    }
}
