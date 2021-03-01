<?php


namespace App\Repositories\Admin;


use App\Models\Asset;
use App\Models\BasePrice;
use App\Models\Game;
use App\Models\Genre;
use App\Models\Platform;
use App\Models\Screenshots;
use App\Models\Video;
use App\Models\VideoUrl;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class GameRepository
{
    /**
     * @return Game[]|\Illuminate\Database\Eloquent\Collection
     */
    public function allGame()
    {
        return Game::orderBy('created_at', 'DESC')->get();
    }

    /**
     * @return Game[]|\Illuminate\Database\Eloquent\Collection
     */
    public function allGenre()
    {
        return Genre::all();
    }

    /**
     * @return Genre[]|\Illuminate\Database\Eloquent\Collection
     */
    public function allPlatform()
    {
        return Platform::all();
    }

    public function basePrice()
    {
        return BasePrice::all();
    }

    /**
     *
     */
    public function show($id)
    {
        return Game::with('videoUrls', 'screenshots', 'assets', 'platforms', 'genres', 'basePrice')->findOrFail($id);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        $game_data = $request->only(['name', 'slug', 'rating', 'description', 'released', 'is_trending', 'base_price_id', 'publisher', 'developer', 'trending_url', 'cover_url', 'poster_url', 'image_source', 'supported_language', 'official_website']);
        $game_data['author_id'] = auth()->user()->id;
        $game_data['slug'] = Str::slug($game_data['name']);
        $game_data['publisher'] = $game_data['publisher'] ?? 'Testing publisher';
        $game_data['description'] = $game_data['description'] ? $game_data['description'] : 'Testing description';

        if ($request->hasFile('trending_url')) {
            $trending = $request->file('trending_url');
            $trending_name = $game_data['name'] . '-trending-' . auth()->user()->id . '-' . time() . $trending->getClientOriginalName();
            $path = "game-image/" . $trending_name;
            $trending->storeAs('game-image', $trending_name);
            $game_data['trending_url'] = 'storage/' . $path;
        }

        if ($request->hasFile('cover_url')) {
            $cover = $request->file('cover_url');
            $cover_name = $game_data['name'] . '-cover-' . auth()->user()->id . '-' . time() . $cover->getClientOriginalName();
            $path = "game-image/" . $cover_name;
            $cover->storeAs('game-image', $cover_name);
            $game_data['cover_url'] = 'storage/' . $path;
        }

        if ($request->hasFile('poster_url')) {
            $poster = $request->file('poster_url');
            $poster_name = $game_data['name'] . '-poster-' . auth()->user()->id . '-' . time() . $poster->getClientOriginalName();
            $path = "game-image/" . $poster_name;
            $poster->storeAs('game-image', $poster_name);
            $game_data['poster_url'] = 'storage/' . $path;
        }

        if ($request->hasFile('upcoming_image')) {
            $upcoming = $request->file('upcoming_image');
            $upcoming_name = $game_data['name'] . '-upcoming-' . auth()->user()->id . '-' . time() . $upcoming->getClientOriginalName();
            $path = "game-image/" . $upcoming_name;
            $upcoming->storeAs('game-image', $upcoming_name);
            $game_data['upcoming_url'] = 'storage/' . $path;
        }

        $game = Game::create($game_data);

        $game->genres()->sync($request->genres, false);
        $game->platforms()->sync($request->platforms, false);

        if ($request->hasFile('screenshot_image')) {
            foreach ($request->screenshot_image as $value) {
                $screenshot = $value;
                $screenshot_name = $game->name . '-screenshot-' . auth()->user()->id . '-' . time() . $screenshot->getClientOriginalName();
                $path = "game-image/" . $screenshot_name;
                $screenshot->storeAs('game-image', $screenshot_name);

                $data = $request->only(['game_id', 'name', 'url']);
                $data['game_id'] = $game->id;
                $data['name'] = $screenshot_name;
                $data['url'] = 'storage/' . $path;

                Screenshots::create($data);
            }
        }

        if ($request->has('video_url')) {
            foreach ($request->video_url as $value) {
                $video_name = $game->name . '-Video-' . auth()->user()->id . '-' . time();
                $video_data = $request->only(['game_id', 'name', 'url']);
                $video_data['game_id'] = $game->id;
                $video_data['name'] = $video_name;
                $video_data['url'] = $value;

                VideoUrl::create($video_data);
            }
        }

        return $game;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function update($request, $id)
    {
        $game = Game::findOrFail($id);
        $data = $request->only(['name', 'released', 'rating', 'description', 'base_price_id', 'is_trending', 'publisher', 'developer', 'supported_language', 'image_source', 'official_website']);
        $game->is_trending = 0;
        if (isset($data['name'])) {
            $game->name = $data['name'];
        }
        if (isset($data['released'])) {
            $game->released = $data['released'];
        }
        if (isset($data['rating'])) {
            $game->rating = $data['rating'];
        }
        if (isset($data['description'])) {
            $game->description = $data['description'];
        }
        if (isset($data['publisher'])) {
            $game->publisher = $data['publisher'];
        }
        if (isset($data['developer'])) {
            $game->developer = $data['developer'];
        }
        if (isset($data['is_trending'])) {
            $game->is_trending = $data['is_trending'];
        }
        if (isset($data['supported_language'])) {
            $game->supported_language = $data['supported_language'];
        }
        if (isset($data['official_website'])) {
            $game->official_website = $data['official_website'];
        }
        if (isset($data['image_source'])) {
            $game->image_source = $data['image_source'];
        }

        if (isset($data['base_price_id'])) {
            $game->base_price_id = $data['base_price_id'];
        }

        if ($request->hasFile('trending_url')) {
            $trending = $request->file('trending_url');
            $trending_name = $data['name'] . '-trending-' . auth()->user()->id . '-' . time() . $trending->getClientOriginalName();
            $path = "game-image/" . $trending_name;
            $trending->storeAs('game-image', $trending_name);
            deleteFile([$game->trending_url]);
            $game->trending_url = 'storage/' . $path;
        }

        if ($request->hasFile('cover_url')) {
            $cover = $request->file('cover_url');
            $cover_name = $data['name'] . '-cover-' . auth()->user()->id . '-' . time() . $cover->getClientOriginalName();
            $path = "game-image/" . $cover_name;
            $cover->storeAs('game-image', $cover_name);
            deleteFile([$game->cover_url]);
            $game->cover_url = 'storage/' . $path;
        }

        if ($request->hasFile('poster_url')) {
            $poster = $request->file('poster_url');
            $poster_name = $data['name'] . '-poster-' . auth()->user()->id . '-' . time() . $poster->getClientOriginalName();
            $path = "game-image/" . $poster_name;
            $poster->storeAs('game-image', $poster_name);
            deleteFile([$game->poster_url]);
            $game->poster_url = 'storage/' . $path;
        }

        if ($request->hasFile('upcoming_image')) {
            $upcoming = $request->file('upcoming_image');
            $upcoming_name = $data['name'] . '-upcoming-' . auth()->user()->id . '-' . time() . $upcoming->getClientOriginalName();
            $path = "game-image/" . $upcoming_name;
            $upcoming->storeAs('game-image', $upcoming_name);
            deleteFile([$game->upcoming_url]);
            $game->upcoming_url = 'storage/' . $path;
        }

        $game->save();

        $game->genres()->sync($request->genres);
        $game->platforms()->sync($request->platforms);

        if ($request->hasFile('screenshot_image')) {
            foreach ($request->screenshot_image as $value) {
                $screenshot = $value;
                $screenshot_name = $game->name . '-screenshot-' . auth()->user()->id . '-' . time() . $screenshot->getClientOriginalName();
                $path = "game-image/" . $screenshot_name;
                $screenshot->storeAs('game-image', $screenshot_name);

                $data = $request->only(['game_id', 'name', 'url']);
                $data['game_id'] = $game->id;
                $data['name'] = $screenshot_name;
                $data['url'] = 'storage/' . $path;

                Screenshots::create($data);
            }
        }

        if ($request->get('video_url')) {
            foreach ($request->video_url as $value) {
                if (empty($value)) {
                    continue;
                }
                $video_name = $game->name . '-Video-' . auth()->user()->id . '-' . time();
                $video_data = $request->only(['game_id', 'name', 'url']);
                $video_data['game_id'] = $game->id;
                $video_data['name'] = $video_name;
                $video_data['url'] = $value;

                VideoUrl::create($video_data);
            }
        }
    }


    /**
     * @param $id
     * @return mixed
     */
    public function editAsset($id)
    {
        return Asset::findOrFail($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $game = Game::findOrFail($id);
        if ($game) {
            $game->delete();
            return true;
        }
        return false;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function screenshotsDestroy($id)
    {
        $screenshots = Screenshots::findOrFail($id);
        if ($screenshots) {
            deleteFile([$screenshots->url]);
            $screenshots->delete();
            return true;
        }

        return false;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function videoDestroy($id)
    {
        $video_data = VideoUrl::findOrFail($id);
        if ($video_data) {
            $video_data->delete();
            return true;
        }
        return false;
    }
}
