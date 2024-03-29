<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {

        try{
            Category::create($request->all());
            return redirect()->route('category.index')->with('success', 'Thêm thành công!');
        }catch(\Throwable $th){
            return redirect()->back()->with('error', 'Thất bại!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::all();
        return  view('admin.categories.edit',compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try{
            $category->update($request->all());
            return redirect()->route('category.index')->with('success', 'Cập nhật thành công!');
        }catch(\Throwable $th){
            return redirect()->back()->with('error', 'Thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try{
            $category->delete();
            return redirect()->route('category.index')->with('success', 'Xóa thành công!');
        }catch(\Throwable $th){
            return redirect()->back()->with('error', 'Thất bại!');
        }
    }
    public function trash()
    {
        $categories = Category::onlyTrashed()->get();
        return view('admin.categories.trash', compact('categories'));
    }
    public function restore($id)
    {
        Category::withTrashed()->where('id',$id)->restore();
        return redirect()->route('category.index')->with('success', 'Khôi phục thành công!');
    }
    public function forceDelete($id)
    {
        Category::withTrashed()->where('id',$id)->forceDelete();
        return redirect()->route('category.trash')->with('success', 'Xóa thành công!');
    }
}
