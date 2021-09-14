<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('used_year')->nullable();
            $table->integer('used_month')->nullable();
            $table->integer('used_day')->nullable();
            $table->integer('warranty_availability');
            $table->integer('warranty_year')->nullable();
            $table->integer('warranty_month')->nullable();
            $table->integer('warranty_day')->nullable();
            $table->string('email')->nullable();
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
            //
        });
    }
}
