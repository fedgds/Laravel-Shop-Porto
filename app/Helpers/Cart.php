<?php
namespace App\Helpers;

class Cart
{
    private $items = [];
    private $total_quantity = 0;
    private $total_price = 0;

    public function __construct(){
        // Kiểm tra session trong giỏ hàng
        $this->items = session('cart') ? session('cart') : [];
    }
    // Lấy về danh sách sản phẩm trong giỏ

    public function list(){
        return $this->items;
    }

    //  Thêm sản phẩm vào giỏ hàng

    public function add($product, $quantity = 1) {
        $item = [
            'productId' => $product->id,
            'name' => $product->name,
            'price' => $product->sale_price > 0 ? $product->sale_price : $product->price,
            'image' => $product->image,
            'quantity' => $quantity
        ];
        $this->items[$product->id] = $item;
        session(['cart'=>$this->items]);
    }

    // Cập nhật giỏ hàng



    // Xóa sản phẩm khỏi giỏ hàng



    // Xóa hết sản phẩm khỏi giỏ hàng

    // Lây tổng tiền

    public function getTotalPrice(){
        $totalPrice = 0;
        foreach($this->items as $item){
            $totalPrice += $item['price'] * $item['quantity'];
        }
        return $totalPrice;
    }

    // Lây số lượng
    public function getTotalQuantity(){
        $total = 0;
        foreach($this->items as $item){
            $total += $item['quantity'];
        }
        return $total;
    }
}
