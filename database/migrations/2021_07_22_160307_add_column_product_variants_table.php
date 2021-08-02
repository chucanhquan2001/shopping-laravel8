<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_variants', function (Blueprint $table) {
            $table->string('sku')->after('id');
            $table->float('price')->after('id');
            $table->float('discount')->default(0)->after('id');
            $table->string('image')->after('id');
            $table->integer('quantity')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_variants', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->dropColumn('discount');
            $table->dropColumn('quantity');
            $table->dropColumn('image');
            $table->dropColumn('skud');
        });
    }
}