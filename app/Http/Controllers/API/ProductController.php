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
use Illuminate\Support\Facades\Cache;

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
        $subcategories = [];
        $sortType = [];
        $priceRange = [];
        $ascPrice = $request->input('ascPrice') == 1 ? 1 : null;
        $descPrice = $request->input('descPrice') == 1 ? 1 : null;
        $ascDate = $request->input('ascDate') == 1 ? 1 : null;
        $descDate = $request->input('descDate') == 1 ? 1 : null;
        $division_id = $request->input('division_id') == 'null' ? '' : $request->input('division_id');
        $district_id = $request->input('district_id') == 'null' ? '' : $request->input('district_id');
        $thana_id = $request->input('thana_id') == 'null' ? '' : $request->input('thana_id');
        $sortNew = $request->input('sortNew') == 1 ? $sortType[] = 1 : null;
        $sortUsed = $request->input('sortUsed') == 1 ? $sortType[] = 2 : null;

        if ($request->input('priceRange')){
            $priceRange = explode(',', $request->input('priceRange'));
        }
        if ($request->input('subcategory')) {
            $items = explode(',', $request->input('subcategory'));
            $subcategories = SubCategory::whereIn('name', $items)->select('id')->get();
        }

        if ($request->input('search')) {
            $search = $request->input('search');
        }
        else {
            $search = "";
        }
        $data = $this->repository->apiIndex($search, $subcategories, $ascDate, $descDate, $ascPrice, $descPrice, $sortType, $priceRange, $division_id, $district_id, $thana_id);

        return $this->response->paginator($data, new ProductTransformer());
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
    public function allSellPost()
    {
        $data = $this->repository->allPost();

        return $this->response->collection($data, new ProductTransformer());
    }

    public function mySellPosts()
    {
        $data = $this->repository->myPosts();

        return $this->response->collection($data, new ProductTransformer());
    }

    public function lastedSellPosts()
    {
        $data = $this->repository->latestPosts();

        return $this->response->collection($data, new ProductTransformer());
    }

    public function relatedSellPosts($id, $cat_id)
    {
        $data = $this->repository->relatedPosts($id, $cat_id);

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

    public function subCategoryfixedList()
    {
        $minutes = 1440; # 1 day
        $data = Cache::remember('subCategories', $minutes, function () {
            return SubCategory::where('status', 1)->whereHas('category')->withCount('products')->orderBy('products_count', 'desc')->take(3)->get();
        });
        return $this->response->collection($data, new SubCategoryTransformer());
    }

    public function subCategoryList()
    {
       $data = SubCategory::whereHas('category')->where('status', true)->get();

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
