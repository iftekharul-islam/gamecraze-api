<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckpiontsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkpionts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('author_id');
            $table->string('flat_no');
            $table->string('house_no');
            $table->string('road_no');
            $table->string('block_no');
            $table->unsignedBigInteger('area_id');
            $table->time('availability_start_time')->nullable();
            $table->time('availability_end_time')->nullable();
            $table->string('holiday')->nullable();
            $table->boolean('status')->default(0);
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('checkpionts');
    }
}
