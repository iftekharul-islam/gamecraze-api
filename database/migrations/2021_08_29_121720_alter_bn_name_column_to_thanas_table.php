<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBnNameColumnToThanasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('thanas', function (Blueprint $table) {
            $table->string('bn_name');
            $table->boolean('status')->default(true)->change();
            $table->dropColumn('author_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('thanas', function (Blueprint $table) {
            $table->dropColumn('bn_name');
            $table->boolean('status')->change();
            $table->unsignedBigInteger('author_id');
        });
    }
}
