<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('game_id');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->date('availability');
            $table->integer('max_week');
            $table->integer('platform_id')->unsigned();
            $table->decimal('earning_amount')->nullable();
            $table->integer('disk_condition_id')->unsigned();
            $table->string('cover_image')->nullable();
            $table->string('disk_image')->nullable();
            $table->unsignedBigInteger('rented_user_id')->nullable();
            $table->foreign('rented_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('status')->nullable();
            $table->text('reason')->nullable();
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
        Schema::dropIfExists('rents');
    }
}
