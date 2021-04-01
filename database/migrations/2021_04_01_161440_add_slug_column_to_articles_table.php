<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugColumnToArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });

        $articles = \App\Models\Article::all();

        foreach ($articles as $article) {
            if ($article->slug == null){
                $article->slug = \Illuminate\Support\Str::slug($article->title);
                $article->save();
            }
            logger($article->slug);
        }
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
