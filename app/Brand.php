<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    //khoa chinh la id thi ko cần phải viết lại
    public $fillable = [
        "brand_name",
        "brand_image"
    ];
    //hàm getImage lấy ảnh ra hiển thị ở view
    public function getImage(){
        if(is_null($this->__get("product_image"))){
            return asset("media/default.png");
        }
        return asset($this->__get("product_image"));
    }

}
