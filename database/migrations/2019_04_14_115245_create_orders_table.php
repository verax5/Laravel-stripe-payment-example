<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {
    public function up() {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('paid');
            $table->dateTime('subscribe_date');
            $table->dateTime('expires');

            $table->integer('user_id')->references('id')->on('users');

            $table->json('order');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('orders');
    }
}
