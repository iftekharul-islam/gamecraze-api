<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReferralCodeColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('referral_code')->nullable();
            $table->string('referred_by')->nullable();
        });

        $users = \App\Models\User::all();
        if(count($users) > 0){
            foreach ($users as $user){
                if ($user->slug == null){
                    $user->referral_code = 'GH-'.rand(1000, 9999).'-'.$user->id;
                    $user->save();
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('referral_code');
            $table->dropColumn('referred_by');
        });
    }
}
