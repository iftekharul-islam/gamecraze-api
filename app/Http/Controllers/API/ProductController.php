<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Rent;
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
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function index(Request $request)
    {
        logger($request->all());
        $subcategories = [];

        if ($request->input('subcategory')) {
            $items = explode(',', $request->input('subcategory'));
            $subcategories = SubCategory::whereIn('name', $items)->select('id')->get();
        }

        $data = $this->repository->apiIndex($subcategories);

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

    public function update(Request $request)
    {
        $data = $this->repository->apiUpdate($request);

        if ($data) {
            return $this->response->array([
                'error' => false,
                'message' => 'Sell post updated'
            ]);
        }

        return $this->response->array([
            'error' => true,
            'message' => 'Sell post cannot update'
        ]);

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

    public function soldStatusUpdate(Request $request)
    {
        $product = $this->repository->soldStatus($request);
        if ($product) {
            return $this->response->array([
                'error' => false,
                'message' => 'Rent post status updated'
            ]);
        }

        return $this->response->array([
            'error' => true,
            'message' => 'Rent post status cannot update'
        ]);
    }
}
