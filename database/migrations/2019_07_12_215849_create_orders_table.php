<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('order_id');
            $table->integer('user_id');
            $table->string('session_id');
            $table->string('item_title');
            $table->string('item_id');
            $table->integer('quantity');
            $table->integer('discount');
            $table->string('coupon');
            $table->string('price');
            $table->enum('status', ['0', '1', '2', '3'])->default('0');
            $table->ipAddress('ip_address');
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
