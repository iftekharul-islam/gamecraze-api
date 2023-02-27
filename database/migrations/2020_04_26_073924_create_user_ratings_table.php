<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_ratings', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('by_user');
            $table->foreign('by_user')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('to_user');
            $table->foreign('to_user')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('rating',2, 1)->default(0.0);
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
        Schema::dropIfExists('user_ratings');
    }
}
