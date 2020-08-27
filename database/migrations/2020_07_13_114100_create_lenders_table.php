<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lenders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lender_id');
            $table->foreign('lender_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('rent_id');
            $table->foreign('rent_id')->references('id')->on('rents')->onDelete('cascade');
            $table->unsignedBigInteger('checkpoint_id')->nullable();
            $table->integer('lend_week');
            $table->integer('lend_cost');
            $table->date('lend_date');
            $table->string('payment_method');
            $table->boolean('status');
            $table->softDeletes();
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
        Schema::dropIfExists('lenders');
    }
}
