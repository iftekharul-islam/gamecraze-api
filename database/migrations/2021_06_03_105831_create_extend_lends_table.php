<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtendLendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extend_lends', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lend_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('week');
            $table->integer('amount');
            $table->integer('commission');
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
        Schema::dropIfExists('extend_lends');
    }
}
