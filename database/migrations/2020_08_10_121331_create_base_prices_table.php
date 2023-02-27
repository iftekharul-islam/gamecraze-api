<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_prices', function (Blueprint $table) {
            $table->id('id');
            $table->integer('author_id');
            $table->integer('start');
            $table->integer('end');
            $table->integer('base');
            $table->double('second_week');
            $table->double('third_week');
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('base_prices');
    }
}
