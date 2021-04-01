<?php

namespace App\Transformers;

// We need to reference the Items Model
use App\Models\Article;
use App\Models\Game;
use Carbon\Carbon;
// Dingo includes Fractal to help with transformations
use Illuminate\Support\Str;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{
//    protected $availableIncludes = [
//        'genres', 'assets', 'platforms', 'rents', 'basePrice'
//    ];
    public function transform(Article $article)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $article->id,
            'title' => $article->title,
            'slug' => $article->slug,
            'description' => $article->description,
            'created' => Carbon::parse($article->created_at)->format('F d, Y'),
            'thumbnail' => $article->thumbnail != null ? asset('/'. $article->thumbnail) : null,
            'status' => $article->status,
        ];
    }

//    public function includeGenres(Game $game) {
//        return $this->collection($game->genres, new GenreTransformer());
//    }
}
