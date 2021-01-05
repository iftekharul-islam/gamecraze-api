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
        return Game::orderBy('name', 'ASC')->get();
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
        $game_data = $request->only(['name', 'rating', 'description', 'released', 'is_trending', 'base_price_id', 'publisher', 'developer', 'trending_url', 'cover_url', 'poster_url']);
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

        if ($request->hasFile('game_image')) {
            $image = $request->file('game_image');
            $image_name = 'game-' . auth()->user()->id . '-' . time() . $image->getClientOriginalName();
            $path = "game-image/" . $image_name;
            $image->storeAs('game-image', $image_name);

            Asset::create([
                'game_id' => $game->id,
                'name' => $image_name,
                'url' => 'storage/' . $path,
            ]);
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
        $data = $request->only(['name', 'released', 'rating', 'description', 'is_trending', 'publisher', 'developer']);

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

        if ($request->hasFile('game_image')) {
            $image = $request->file('game_image');
            $image_name = 'game-' . auth()->user()->id . '-' . $image->getClientOriginalName();
            $path = "game-image/" . $image_name;
            $image->storeAs('game-image', $image_name);

            if (isset($game->assets[0]) && $game->assets[0] != null) {
                $oldImg = $game->assets[0]->url;
                if (file_exists($oldImg)) {
                    unlink($oldImg);
                }

                $img = Asset::find($game->assets[0]->id);
                $img->name = $image_name;
                $img->url = 'storage/' . $path;
                $img->save();
            } else {
                Asset::create([
                    'game_id' => $game->id,
                    'name' => $image_name,
                    'url' => 'storage/' . $path,
                ]);
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
