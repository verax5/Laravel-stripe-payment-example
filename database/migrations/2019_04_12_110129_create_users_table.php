<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username');
            $table->string('subscriber')->default(0);
            $table->string('email');
            $table->string('confirm_token')->nullable();
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('users');
    }
}
