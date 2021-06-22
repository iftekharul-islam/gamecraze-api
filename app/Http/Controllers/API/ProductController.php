<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Repositories\ProductRepository;
use App\Transformers\CategoryTransformer;
use App\Transformers\ProductTransformer;
use App\Transformers\SubCategoryTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    private $repository;

    public function __construct(ProductRepository $repository){
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->repository->apiIndex();

        return $this->response->collection($data, new ProductTransformer());
    }

    public function postsById($id)
    {
        $data = $this->repository->postsById($id);

        return $this->response->collection($data, new ProductTransformer());
    }

    public function postById($id)
    {
        $data = $this->repository->postById($id);

        return $this->response->item($data, new ProductTransformer());
    }

    public function mySellPosts()
    {
        $data = $this->repository->myPosts();

        return $this->response->collection($data, new ProductTransformer());
    }

    /**
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = $this->repository->apiStore($request, $user_id);

        return $this->response->item($data, new ProductTransformer());

    }

    public function categoryList()
    {
        $data = Category::where('status', 1)->get();

        return $this->response->collection($data, new CategoryTransformer());
    }

    public function subCategoryList()
    {
       $data = SubCategory::where('status', true)->get();

       return $this->response->collection($data, new SubCategoryTransformer());
    }
}
