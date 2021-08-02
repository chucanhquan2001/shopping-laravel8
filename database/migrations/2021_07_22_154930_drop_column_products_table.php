<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->dropColumn('discount');
            $table->dropColumn('quantity');
            $table->dropColumn('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->float('price');
            $table->float('discount')->default(0);
            $table->string('image');
            $table->integer('quantity')->after('discount')->nullable();
        });
    }
}