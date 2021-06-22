<?php


namespace App\Repositories;


use App\Jobs\SentSellPostNotificationToAdmin;
use App\Models\GameOrder;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductRepository
{
    public function allCustomer()
    {
        return User::with('roles')->whereHas('roles', function ($query) {
            $query->where('name', '!=', 'admin');
        })->orderBy('created_at', 'DESC')->get();
    }
    public function index($request)
    {
        $product = Product::query();

        if ($request->status){
            $product->where('status', $request->status);
        }
        if ($request->product_type){
            $product->where('product_type', $request->product_type);
        }
        if ($request->is_sold){
            $product->where('is_sold', $request->is_sold);
        }
        return $product->with('user', 'subcategory')->orderBy('created_at', 'DESC')->get();
    }

    public function apiIndex()
    {
        return Product::where('status', 1)->get();
    }

    public function postsById($id)
    {
        return Product::where('status', 1)->where('sub_category_id', $id)->get();
    }

    public function postById($id)
    {
        return Product::where('status', 1)->where('id', $id)->first();
    }

    public function myPosts()
    {
        return Product::where('user_id', Auth::user()->id)->get();
    }

    public function create()
    {
        return SubCategory::where('status', true)->get();
    }

    public function store($request, $user_id)
    {
        $product = $request->only(['sub_category_id', 'name', 'description', 'price', 'is_sold',
            'is_negotiable', 'product_type',
            'user_id', 'status']);

        $isChecked = $request->has('is_negotiable');

        if ($isChecked) {
            $product['is_negotiable'] = 1;
        } else {
            $product['is_negotiable'] = null;
        }

        $product['is_sold'] = 1;
        $product['user_id'] = $user_id;
        $product['product_no'] = $this->generateProductNo();

        $data = Product::create($product);

        $images = $request->file('product_image');
        if (isset($images)) {
            foreach ($images as $image) {
                $data->addMedia($image)->toMediaCollection('product-image');
            }
        }
        $admins = config('admin_mail.mail_to');
        foreach ($admins as $admin){
            SentSellPostNotificationToAdmin::dispatch($data, $admin);
        }
        return $data;

    }

    public function apiStore($request, $user_id)
    {
        $product = $request->only(['sub_category_id', 'name', 'description', 'price', 'is_sold',
            'is_negotiable', 'product_type', 'product_no',
            'user_id', 'status']);

        $product['is_sold'] = 1;
        $product['is_negotiable'] = $product['is_negotiable'] == false ? null : $product['is_negotiable'];
        $product['status'] = 2;
        $product['user_id'] = $user_id;
        $product['product_no'] = $this->generateProductNo();

        $data = Product::create($product);
        logger($request->images);
        $images = $request->images;
        if (count($images) > 0) {
            foreach ($images as $image) {
                $imageName = 'image-product.jpeg';

                $data->addMediaFromBase64($image)
                    ->usingFileName($imageName)
                    ->toMediaCollection('product-image');
            }
        }
        $admins = config('admin_mail.mail_to');
        foreach ($admins as $admin){
            SentSellPostNotificationToAdmin::dispatch($data, $admin);
        }
        return $data;

    }

    public function show($id)
    {
        return Product::with('subcategory')->findOrFail($id);
    }

    public function update($request, $id)
    {
        $product = Product::find($id);

        if (!$product){
            return false;
        }

        $data = $request->only(['sub_category_id', 'name', 'description', 'price',
            'is_negotiable', 'product_type', 'is_sold',
            'user_id', 'status']);

        if (isset($data['sub_category_id'])){
            $product->sub_category_id = $data['sub_category_id'];
        }

        if (isset($data['name'])){
            $product->name = $data['name'];
        }

        if (isset($data['description'])){
            $product->description = $data['description'];
        }

        if (isset($data['price'])){
            $product->price = $data['price'];
        }

        if (isset($data['category_id'])){
            $product->category_id = $data['category_id'];
        }

        $isChecked = $request->has('is_negotiable');

        if ($isChecked) {
            $product->is_negotiable = 1;
        } else {
            $product->is_negotiable = null;
        }

        if (isset($data['product_type'])){
            $product->product_type = $data['product_type'];
        }

        if (isset($data['is_sold'])){
            $product->is_sold = $data['is_sold'];
        }

        if (isset($data['status'])){
            $product->status = $data['status'];
        }

        if ($request->has('product_image')){
            $images = $request->file('product_image');

            if (isset($images)) {
                foreach ($images as $image) {
                    $product->addMedia($image)->toMediaCollection('product-image');
                }
            }
        }

        $product->save();

        return true;
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if (!$product){
            return false;
        }
        $images = $product->getMedia('product-image');
        if (count($images) > 0) {
            foreach ($images as $item){
                $item->delete();
            }
        }


        $product->delete();

        return true;

    }

    public function generateProductNo()
    {
        $latestProduct = Product::orderBy('id', 'desc')->first();
        if ($latestProduct) {
            $lastNumber = explode('-', $latestProduct->product_no);
            $lastNumber = preg_replace("/[^0-9]/", "", end($lastNumber));
            $productNo = 'GH-POST-' . str_pad((int)$lastNumber + 1, 4, '0', STR_PAD_LEFT);
            if (Product::where('product_no', $productNo)->count() > 0) {
                $this->generateOrderNo();
            }
            return $productNo;
        }

        return 'GH-POST-' . date('Y') . date('m') . '-001';
    }

}
