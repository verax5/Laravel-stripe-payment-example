<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionPricesTable extends Migration {
    public function up() {
        Schema::create('subscription_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('months');
            $table->float('price');
            $table->string('title');
            $table->longText('description');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('subscription_prices');
    }
}