<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\WishList;
use App\Models\Product;

class WishListController extends Controller
{
    public function index(WishList $wishlist){
        return view('clients.wishlist', compact('wishlist'));
    }
    public function add(Request $request, WishList $wishlist){
        $product = Product::find($request->id);
        $wishlist->add($product);
        return redirect()->route('wishlist.index');
    }
}
