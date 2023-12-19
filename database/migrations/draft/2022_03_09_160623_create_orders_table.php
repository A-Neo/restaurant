<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('method')->nullable();
            $table->string('wishes')->nullable();
            $table->string('address')->nullable();
            $table->string('total')->nullable();
            $table->string('discount')->nullable();
            $table->string('delivery')->nullable();
            $table->string('payment_status')->nullable();
            $table->boolean('devices')->nullable();
            $table->string('payment_method')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
