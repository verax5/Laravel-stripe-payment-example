<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {
    public function up() {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('status')->default(1);
            $table->bigInteger('category_id')->references('id')->on('categories');
            $table->string('slug');
            $table->string('title')->nullable();
            $table->longText('snippet');
            $table->enum('type', ['members', 'subscribers',])->default('members');
            $table->longText('body');
            $table->string('download')->nullable();
            $table->string('thumbnail')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('products');
    }
}