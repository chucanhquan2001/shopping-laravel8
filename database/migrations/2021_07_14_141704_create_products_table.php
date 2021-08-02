<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->float('price');
            $table->float('discount')->default(0);
            $table->string('image');
            $table->text('content');
            $table->text('description');
            $table->integer('status')->default(1);
            $table->integer('view')->default(0);
            $table->foreignId('category_id')->constrained()->onDelete('no action')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('no action')->onUpdate('cascade');
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
        Schema::dropIfExists('products');
    }
}