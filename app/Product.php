<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = "products";
    public $fillable = [
        "product_name",
        "product_image",
        "product_desc",
        "price",
        "qty",
        "category_id",
        "brand_id"
    ];
    //hàm getImage lấy ảnh ra hiển thị ở view
    public function getImage(){
        if(is_null($this->__get("product_image"))){
            return asset("media/default.png");
        }
        return asset($this->__get("product_image"));
    }
    public function getPrice(){
        return "$".number_format($this->__get("price"));
    }
    public function Category(){
        return $this->belongsTo("\App\Category", "category_id");
    }
    public function Brand(){
        return $this->belongsTo("\App\Brand");
    }
    public function getProductUrl(){
        return url("/product/{$this->__get("slug")}");
    }
}
