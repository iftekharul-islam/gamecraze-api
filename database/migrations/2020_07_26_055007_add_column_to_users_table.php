<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number')->unique();
            $table->string('gender')->nullable();
            $table->date('birth_date')->nullable();
            $table->unsignedBigInteger('address_id')->nullable();
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
            $table->string('identification_number')->nullable();
            $table->string('identification_image')->nullable();
            $table->string('interest')->nullable();
            $table->string('image')->nullable();
            $table->decimal('wallet')->default(0);
            $table->boolean('status')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone_number');
            $table->dropColumn('gender');
            $table->dropColumn('birth_date');
            $table->dropColumn('address_id');
            $table->dropColumn('identification_number');
            $table->dropColumn('identification_image');
            $table->dropColumn('interest');
            $table->dropColumn('image');
            $table->dropColumn('wallet');
            $table->dropColumn('status');
        });
    }
}
