<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugCloumnToGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });

        $games = \App\Models\Game::all();

        foreach ($games as $game) {
            if ($game->slug == null){
                $game->slug = \Illuminate\Support\Str::slug($game->name);
                $game->save();
            }
            logger($game->slug);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
