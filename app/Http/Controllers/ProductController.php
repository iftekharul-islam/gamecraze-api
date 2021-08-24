<?php

namespace App\Http\Controllers;

use App\Jobs\SellPostApproved;
use App\Jobs\SellPostRejected;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
    public function index(Request $request)
    {
        $data = $this->repository->index($request);

        return view('admin.product.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = $this->repository->allCustomer();
        $subcategory = $this->repository->create();

        return view('admin.product.create', compact('subcategory', 'users'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user_id = $request->user_id;
        $data = $this->repository->store($request, $user_id);
        Cache::forget('subCategories');
        return redirect()->route('product')->with("status", 'Product successfully created!');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $data = $this->repository->show($id);
        $images = $data->getMedia('product-image');
        $coverImages = $data->getMedia('cover-image');


        return view('admin.product.show', compact('data', 'coverImages', 'images'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->repository->show($id);
        $coverImages = $data->getMedia('cover-image');
        $subcategory = $this->repository->create();
        $users = $this->repository->allCustomer();

        return view('admin.product.edit', compact('data', 'subcategory', 'users', 'coverImages'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = $this->repository->update($request, $id);

        if (!$data){
            return redirect()->route('product')->with("error", 'product cannot Update!');
        }
        Cache::forget('subCategories');
        return redirect()->route('product')->with("status", 'product successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->repository->delete($id);

        if (!$data){
            return redirect()->route('product')->with("error", 'product cannot delete!');
        }
        Cache::forget('subCategories');
        return redirect()->route('product')->with("status", 'product deleted successfully!');
    }

    public function approve($id)
    {
        $data = Product::findOrFail($id);
        $data->status = 1;
        $data->save();

        SellPostApproved::dispatch($data);
        Cache::forget('subCategories');
        return back()->with('status', 'Product Request Approved !!');
    }

    public function reject($id)
    {
        $data = Product::findOrFail($id);
        $data->status = 3;
        $data->save();

        SellPostRejected::dispatch($data);

        return back()->with('status', 'Product Request Rejected !!');
    }
}
