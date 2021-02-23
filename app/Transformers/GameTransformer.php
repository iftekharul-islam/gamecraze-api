<?php

namespace App\Transformers;

// We need to reference the Items Model
use App\Models\Game;

// Dingo includes Fractal to help with transformations
use Illuminate\Support\Str;
use League\Fractal\TransformerAbstract;

class GameTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'genres', 'assets', 'platforms', 'rents', 'basePrice', 'screenshots', 'videoUrls'
    ];
    public function transform(Game $game)
    {
        // specify what elements are going to be visible to the API
        return [
            'id' => $game->id,
            'name' => $game->name,
            'slug' => Str::slug($game->name),
            'release_date' => $game->released,
            'game_mode' => $game->game_mode,
            'description' => $game->description,
            'base_price_id' => $game->base_price_id,
            'rating' => $game->rating,
            'publisher' => $game->publisher,
            'poster_url' => asset($game->poster_url),
            'trending_url' => asset($game->trending_url),
            'developer' => $game->developer,
            'coverImage' => asset($game->cover_url),
            'upcoming_url' => asset($game->upcoming_url),
            'supported_language' => $game->supported_language,
            'official_website' => $game->official_website,
            'image_source' => $game->image_source,
        ];
    }

    public function includeGenres(Game $game) {
        return $this->collection($game->genres, new GenreTransformer());
    }

    public function includeAssets(Game $game) {
        return $this->collection($game->assets, new AssetTransformer());
    }

    public function includePlatforms(Game $game) {
        return $this->collection($game->platforms, new PlatformTransformer());
    }
    public function includeRents(Game $game) {
        return $this->collection($game->rents, new RentTransformer());
    }

    public function includeBasePrice(Game $game) {
        return $this->item($game->basePrice, new BasePriceTransformer());
    }
    public function includeScreenshots(Game $game) {
        return $this->collection($game->screenshots, new ScreenshotTransformer());
    }
    public function includeVideoUrls(Game $game) {
        return $this->collection($game->videoUrls, new VideoTransformer());
    }
}
