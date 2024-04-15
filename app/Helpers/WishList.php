<?php
namespace App\Helpers;

class WishList{
    private $items = [];
    public function __construct(){
        // Kiểm tra session trong giỏ hàng
        $this->items = session('wishlist') ? session('wishlist') : [];
    }
    // Lấy về danh sách sản phẩm trong giỏ

    public function list(){
        return $this->items;
    }

    //  Thêm sản phẩm vào giỏ hàng

    public function add($product) {
        $item = [
            'productId' => $product->id,
            'name' => $product->name,
            'price' => $product->sale_price > 0 ? $product->sale_price : $product->price,
            'image' => $product->image
        ];
        $this->items[$product->id] = $item;
        session(['wishlist'=>$this->items]);
    }
}