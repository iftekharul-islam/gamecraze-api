<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\ArticleRepository;
use App\Transformers\ArticleTransformer;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private $repository;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $order = $request->get('order') ?? 'ASC';
        $perPage = $request->get('perPage') ?? 5;
        $articles = $this->repository->allArticle($order, $perPage);
        return $this->response->paginator($articles, new ArticleTransformer());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = $this->repository->show($id);
        return $this->response->item($article, new ArticleTransformer());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * get latest articles
     *
     * @param  int  number 
     * @return \Illuminate\Http\Response
     */
    public function topArticles(Request $request) {
        $number = $request->get('number') ? $request->get('number') : 5;
        $articles = $this->repository->latestArticles($number);
        return $this->response->collection($articles, new ArticleTransformer());
    }

    /**
     * get related articles
     * @param  int  number 
     * @return \Illuminate\Http\Response
     */
    public function getRelatedArticles(Request $request, $id) {
        $number = $request->get('number') ? $request->get('number') : 3;
        $articles = $this->repository->relatedArticles($id, $number);
        return $this->response->collection($articles, new ArticleTransformer());
    }
}
