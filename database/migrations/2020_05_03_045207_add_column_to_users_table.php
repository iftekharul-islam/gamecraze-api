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
            $table->string('phone_number')->unique()->nullable();
            $table->string('gender')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('address')->nullable();
            $table->string('interest')->nullable();
            $table->string('image')->nullable();
            $table->decimal('wallet')->default(0);
            $table->integer('status')->default(0);
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
            $table->dropColumn('address');
            $table->dropColumn('interest');
            $table->dropColumn('image');
            $table->dropColumn('wallet');
            $table->dropColumn('status');
        });
    }
}
