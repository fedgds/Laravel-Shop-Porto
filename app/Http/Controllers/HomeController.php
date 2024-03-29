<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $featuredProduct = Product::where([
            ['stock', 1],
            ['status', 1]
        ])->get();

        $newProduct = Product::orderBy('created_at', 'desc')->where('status',1)->take(3)->get();
        // dd($newProduct);

        return view('clients.home', compact('featuredProduct', 'newProduct'));
    }
    public function detail($slug){
        $product = Product::where('slug', $slug)->first();

        $related = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->where('status',1)->get();

        $newProduct = Product::orderBy('created_at', 'desc')->where('status',1)->take(3)->get();

        $featuredProduct = Product::where([
            ['stock', 1],
            ['status', 1]
        ])->take(3)->get();

        return view('clients.detail',compact('product', 'related', 'newProduct', 'featuredProduct'));
    }
    public function wishList(){
        return view('clients.wishlist');
    }
    public function blog(){
        return view('clients.blog');
    }
    public function about(){
        return view('clients.about');
    }
    public function contact(){
        return view('clients.contact');
    }
}
