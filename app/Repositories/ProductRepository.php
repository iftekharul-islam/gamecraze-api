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

    public function apiIndex($subcategory, $ascDate, $descDate, $ascPrice, $descPrice, $sortType, $priceRange)
    {
        $product = Product::query();

        if (count($priceRange) > 0){
            $product->whereBetween('price', $priceRange);
        }
        if ($ascPrice == 1){
            $product->orderBy('price', 'ASC');
        }
        if ($descPrice == 1){
            $product->orderBy('price', 'DESC');
        }
        if ($ascDate == 1){
            $product->orderBy('created_at', 'ASC');
        }
        if ($descDate == 1){
            $product->orderBy('created_at', 'DESC');
        }
        if (count($sortType) > 0){
            $product->whereIn('product_type', $sortType);
        }
        if (count($subcategory) > 0){
            $product->whereIn('sub_category_id', $subcategory);
        }

        return $product->where('status', 1)->paginate(12);
    }

    public function postsById($id)
    {
        return Product::where('status', 1)->where('sub_category_id', $id)->get();
    }

    public function postById($id)
    {
        return Product::where('id', $id)->first();
    }

    public function allPost()
    {
        return Product::where('status', 1)->orderBy('created_at', 'DESC')->get();
    }

    public function myPosts()
    {
        return Product::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
    }

    public function latestPosts()
    {
        return Product::where('status', 1)->orderBy('created_at', 'DESC')->take(5)->get();
    }

    public function relatedPosts($id, $cat_id)
    {
        return Product::where('id', '!=', $id)->where('sub_category_id', $cat_id)->where('status', 1)->orderBy('created_at', 'DESC')->get();
    }

    public function create()
    {
        return SubCategory::where('status', true)->get();
    }

    public function store($request, $user_id)
    {
        $product = $request->only(['sub_category_id', 'name', 'description', 'price', 'is_sold',
            'is_negotiable', 'product_type', 'condition_summary', 'phone_no', 'address',
            'used_year', 'used_month', 'used_day', 'warranty_availability',
            'warranty_year', 'warranty_month', 'warranty_day', 'email',
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

        $coverImage = $request->file('cover_image');
        if (isset($coverImage)) {
            $data->addMedia($coverImage)->toMediaCollection('cover-image');
        }

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
            'is_negotiable', 'product_type', 'used_year', 'used_month', 'used_day', 'warranty_availability',
            'warranty_year', 'warranty_month', 'warranty_day', 'email',
            'product_no', 'condition_summary', 'phone_no', 'address',
            'user_id', 'status']);
        $product['is_sold'] = 1;
        $product['is_negotiable'] = $product['is_negotiable'] == false ? null : $product['is_negotiable'];
        $product['status'] = 2;
        $product['user_id'] = $user_id;
        $product['product_no'] = $this->generateProductNo();
        if ($product['product_type'] === 1) {
            $product['condition_summary'] = null;
        }
        $data = Product::create($product);
        logger($request->images);
        $cover = $request->cover_image;
        if (isset($cover)){
            $data->addMediaFromBase64($cover)
                ->toMediaCollection('cover-image');
        }
        $images = $request->images;
        if (count($images) > 0) {
            foreach ($images as $image) {
                $imageName = $image['name'];

                $data->addMediaFromBase64($image['file'])
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

    public function apiUpdate($request)
    {
        $product = Product::find($request->id);

        if (!$product) {
            return false;
        }

        $data = $request->only(['sub_category_id', 'name', 'description', 'price',
            'is_negotiable', 'phone_no', 'email', 'address']);

        if (isset($data['name'])){
            $product->name = $data['name'];
        }

        if (isset($data['description'])){
            $product->description = $data['description'];
        }

        if (isset($data['price'])){
            $product->price = $data['price'];
        }

        if (isset($data['is_negotiable'])){
            $product->is_negotiable = $data['is_negotiable'];
        }

        if (isset($data['sub_category_id'])){
            $product->sub_category_id = $data['sub_category_id'];
        }

        if (isset($data['phone_no'])){
            $product->phone_no = $data['phone_no'];
        }

        if (isset($data['email'])){
            $product->email = $data['email'];
        }

        if (isset($data['address'])){
            $product->address = $data['address'];
        }
        $product->save();

        $removeCover = $request->removeCover;
        if ($removeCover != null){
            $product->deleteMedia($removeCover);
        }

        $removeScreenshots = $request->removeScreenshots;
        if ($removeScreenshots != null){
            foreach ($removeScreenshots as $item) {
                $product->deleteMedia($item);
            }
        }

        $cover = $request->cover_image;
        if ($cover != null){
            $product->clearMediaCollection('cover-image');
            $product->addMediaFromBase64($cover)
                ->toMediaCollection('cover-image');
        }
        $images = $request->images;
        if (count($images) > 0) {
            foreach ($images as $image) {
                $imageName = $image['name'];

                $product->addMediaFromBase64($image['file'])
                    ->usingFileName($imageName)
                    ->toMediaCollection('product-image');
            }
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
            'is_negotiable', 'product_type', 'is_sold', 'condition_summary', 'phone_no', 'address',
            'used_year', 'used_month', 'used_day', 'warranty_availability',
            'warranty_year', 'warranty_month', 'warranty_day', 'email',
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

        $isChecked = $request->has('is_negotiable');

        if ($isChecked) {
            $product->is_negotiable = 1;
        } else {
            $product->is_negotiable = null;
        }

        if (isset($data['product_type'])){
            $product->product_type = $data['product_type'];
        }

        if (isset($data['used_year'])){
            $product->used_year = $data['used_year'];
        }

        if (isset($data['used_month'])){
            $product->used_month = $data['used_month'];
        }

        if (isset($data['used_day'])){
            $product->used_day = $data['used_day'];
        }

        if (isset($data['warranty_availability'])){
            $product->warranty_availability = $data['warranty_availability'];
        }

        if (isset($data['warranty_year'])){
            $product->warranty_year = $data['warranty_year'];
        }

        if (isset($data['warranty_month'])){
            $product->warranty_month = $data['warranty_month'];
        }

        if (isset($data['warranty_day'])){
            $product->warranty_day = $data['warranty_day'];
        }

        if (isset($data['email'])){
            $product->email = $data['email'];
        }

        if (isset($data['condition_summary'])){
            $product->condition_summary = $data['condition_summary'];
        }

        if (isset($data['phone_no'])){
            $product->phone_no = $data['phone_no'];
        }

        if (isset($data['address'])){
            $product->address = $data['address'];
        }

        if (isset($data['is_sold'])){
            $product->is_sold = $data['is_sold'];
        }

        if (isset($data['status'])){
            $product->status = $data['status'];
        }

        $product->save();

        if ($request->has('cover_image')) {
            $product->clearMediaCollection('cover-image');
            $coverImage = $request->file('cover_image');

            $product->addMedia($coverImage)->toMediaCollection('cover-image');
        }

        if ($request->has('product_image')){
            $images = $request->file('product_image');

            if (isset($images)) {
                foreach ($images as $image) {
                    $product->addMedia($image)->toMediaCollection('product-image');
                }
            }
        }

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

    public function soldStatus($request)
    {
        $product = Product::where('id', $request->id)->where('user_id', Auth::user()->id)->first();
        if ($product) {
            $product->is_sold = $request->status == false ? 2 : 1;
            $product->save();

            return true;
        }

        return false;
    }

}
