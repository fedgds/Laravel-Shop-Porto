<?php
use App\Models\Category;
function categoryParent($categories, $selected = 0, $parentId = 0, $character = ''){
    foreach($categories as $key => $item){
        if($item->parent_id == $parentId) {
            if($selected == $item->id){
                echo  "<option value=''$item->id' selected> $character $item->name</option>";
            }else{
                echo  "<option value='$item->id'> $character $item->name </option>";
            }
            // Xóa danh mục đã duyệt
            unset( $categories[$key]);
            // Gọi đến hàm CategoryParent để tìm các danh mục con của danh mục đang duyệt
            categoryParent($categories, $selected, $item->id, $character . '---');
        }
    }
}
function getAllCategories(){
    $categories = new Category;
    return $categories->all();
}
function percent($sale, $price){
    return round(($price - $sale)*100/$price);
}
