<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lend_id')->index();
            $table->unsignedBigInteger('lender_id')->nullable();
            $table->unsignedBigInteger('renter_id')->nullable();
            $table->decimal('lender_rating',2, 1)->nullable();
            $table->decimal('renter_rating',2, 1)->nullable();
            $table->string('lender_comment')->nullable();
            $table->string('renter_comment')->nullable();
            $table->boolean('notify_lender')->nullable();
            $table->boolean('notify_renter')->nullable();
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
        Schema::dropIfExists('ratings');
    }
}
