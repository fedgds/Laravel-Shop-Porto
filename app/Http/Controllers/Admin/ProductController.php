<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ImgProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $fileName = $request->photo->getClientOriginalName();
        $request->photo->storeAs('public/images',$fileName);
        $request->merge(['image' => $fileName]);
        try{
            $product = Product::create($request->all());

            if ($product && $request->hasFile('photos')){
                foreach ($request->photos as $key => $value){
                    $fileNames = $value->getClientOriginalName();
                    $value->storeAs('public/images',$fileNames);
                    ImgProduct::create([
                        'product_id' => $product->id,
                        'image' => $fileNames
                    ]);
                }
            }
        }catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Thất bại! ' . $th->getMessage());
        }
        return redirect()->route('product.index');
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
    public function edit(Product $product)
    {
        $categories = Category::all();
        $imgProduct = ImgProduct::where( 'product_id', $product->id)->get();
        return  view('admin.products.edit',compact('product', 'categories', 'imgProduct'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {

            // Kiểm tra nếu người dùng đã chọn file ảnh mới
            if ($request->hasFile('photos')) {
                // Xóa tất cả các ảnh mô tả cũ của sản phẩm cứng
                ImgProduct::where('product_id', $product->id)->forceDelete();
                foreach ($request->photos as $key => $value) {
                    $fileNames = $value->getClientOriginalName();
                    $value->storeAs('public/images', $fileNames);
                    // Thêm ảnh mới vào bảng img_product
                    ImgProduct::create([
                        'product_id' => $product->id,
                        'image' => $fileNames
                    ]);
                }
            }

            // Cập nhật thông tin sản phẩm khác nếu có
            $product->update($request->except(['photo', 'photos']));

            // Kiểm tra nếu người dùng đã chọn file ảnh đại diện mới
            if ($request->hasFile('photo')) {
                // Lưu file ảnh vào thư mục và lấy tên file
                $fileName = $request->photo->getClientOriginalName();
                $request->photo->storeAs('public/images', $fileName);

                // Cập nhật thông tin sản phẩm với tên file ảnh mới
                $product->update(['image' => $fileName]);
            }

            return redirect()->route('product.index')->with('success', 'Cập nhật thành công!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Thất bại!');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try{
            ImgProduct::where('product_id', $product->id)->delete();
            
            $product->delete();
            return redirect()->route('product.index')->with('success', 'Xóa thành công!');
        }catch(\Throwable $th){
            return redirect()->back()->with('error', 'Thất bại!');
        }
    }
    public function trash()
    {
        $products = Product::onlyTrashed()->get();
        return view('admin.products.trash', compact('products'));
    }
    public function restore($id)
    {
        Product::withTrashed()->where('id',$id)->restore();
        ImgProduct::withTrashed()->where('product_id',$id)->restore();
        return redirect()->route('product.index')->with('success', 'Khôi phục thành công!');
    }
    public function forceDelete($id)
    {
        ImgProduct::withTrashed()->where('product_id',$id)->forceDelete();
        Product::withTrashed()->where('id',$id)->forceDelete();
        return redirect()->route('product.trash')->with('success', 'Xóa thành công!');
    }
}
