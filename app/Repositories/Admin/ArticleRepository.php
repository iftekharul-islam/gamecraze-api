<?php


namespace App\Repositories\Admin;


use App\Models\Article;
use Illuminate\Support\Str;

class ArticleRepository
{
    /**
     * @return mixed
     */
    public function allArticle()
    {
        return Article::orderBy('created_at', 'DESC')->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($slug)
    {
        return Article::where('slug', $slug)->first();
    }

    /**
     * @param $request
     * @param $id
     * @return bool
     */
    public function update($request, $id)
    {
        $article = Article::findOrFail($id);
        $data = $request->only(['title', 'thumbnail', 'slug', 'description', 'user_id', 'status', 'is_featured']);
        $article->is_featured = 0;

        if (isset($data['title'])) {
            $article->title = $data['title'];
            $article->slug = Str::slug($data['title']);
        }
        if (isset($data['thumbnail'])) {
            $article->thumbnail = $data['thumbnail'];
        }
        if (isset($data['description'])) {
            $article->description = $data['description'];
        }
        if (isset($data['user_id'])) {
            $article->user_id = $data['user_id'];
        }
        if (isset($data['status'])) {
            $article->status = $data['status'];
        }
        if (isset($data['is_featured'])) {
            $article->is_featured = $data['is_featured'];
        }

        if (isset($data['thumbnail'])) {

            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = 'thumbnail-' . auth()->user()->id . '-' . time() . $thumbnail->getClientOriginalName();
            logger($thumbnail_name);
            $path = "article-image/" . $thumbnail_name;
            $thumbnail->storeAs('article-image', $thumbnail_name);

            $article->thumbnail = 'storage/' . $path;
        }

        $article->save();

        return true;

    }
    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        $data = $request->only(['title', 'slug', 'thumbnail', 'description', 'user_id', 'status', 'is_featured']);
        $data['user_id'] = auth()->user()->id;
        $data['slug'] = Str::slug($data['title']);
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = 'thumbnail-' . auth()->user()->id . '-' . time() . $thumbnail->getClientOriginalName();
            $path = "article-image/" . $thumbnail_name;
            $thumbnail->storeAs('article-image', $thumbnail_name);

            $data['thumbnail'] = 'storage/' . $path;
        }
        Article::create($data);

        return $data;
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $game = Article::findOrFail($id);
        if ($game) {
            $game->delete();
            return true;
        }
        return false;
    }

    /**
     * @param $number
     * @return collection
     */
    public function relatedArticles($article_id, $number = 3)
    {
        return Article::where('status', 1)
            ->where('id', '!=', $article_id)
            ->take($number)
            ->inRandomOrder()
            ->get();
    }

    public function featuredArticles($number)
    {
        return Article::where('status', 1)
            ->where('is_featured', 1)
            ->orderBy('created_at', 'DESC')
            ->take($number)
            ->get();
    }
    public function topArticles($number = 4)
    {
        return Article::where('status', 1)
            ->orderBy('created_at', 'DESC')
            ->take($number)
            ->get();
    }
}
