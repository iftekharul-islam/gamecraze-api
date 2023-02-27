<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = SubCategory::with('category')->whereHas('category')->orderBy('created_at', 'DESC')->get();

        return view('admin.sub_category.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('status', true)->get();

        return view('admin.sub_category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subCategory = $request->only(['category_id', 'name', 'description', 'image_url', 'status']);

        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $image_url = 'subcategory-' . auth()->user()->id . '-' . time() . $image->getClientOriginalExtension();
            $path = "subcategory-image/" . $image_url;
            $image->storeAs('subcategory-image', $image_url);
            $subCategory['image_url'] = 'storage/' . $path;
        }

        SubCategory::create($subCategory);

        return redirect()->route('subcategory')->with("status", 'Sub Category successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = SubCategory::with('category')->findOrFail($id);

        return view('admin.sub_category.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = SubCategory::with('category')->findOrFail($id);
        $category = Category::where('status', true)->get();

        return view('admin.sub_category.edit', compact('data', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subCategory = SubCategory::findOrFail($id);

        $data = $request->only(['category_id', 'name', 'description', 'image_url', 'status']);

        if (isset($data['name'])){
            $subCategory->name = $data['name'];
        }

        if (isset($data['description'])){
            $subCategory->description = $data['description'];
        }

        if (isset($data['category_id'])){
            $subCategory->category_id = $data['category_id'];
        }

        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $image_url = $subCategory['image_url'] . '-subcategory-' . auth()->user()->id . '-' . time() . $image->getClientOriginalExtension();
            $path = "subcategory-image/" . $image_url;
            $image->storeAs('subcategory-image', $image_url);
            $subCategory['image_url'] = 'storage/' . $path;
        }

        if (isset($data['status'])){
            $subCategory->status = $data['status'];
        }

        $subCategory->save();

        return redirect()->route('subcategory')->with("status", 'Sub Category successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = SubCategory::findOrFail($id);
        $data->delete();
        return redirect()->route('subcategory')->with("status", 'Sub Category Deleted Updated!');
    }
}
