<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration {
    public function up() {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->string('username');
            $table->longText('message');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('contact');
    }
}
