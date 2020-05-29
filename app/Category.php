<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    //khoa chinh la id thi ko cần phải viết lại
    public $fillable = [
        "category_name",
        "category_image"
    ];

    public function Products(){
        return $this->hasMany("\App\Product");//trả về 1 collection lấy tất cả sản phẩm của category đó
    }
    public function getImage(){
        if(is_null($this->__get("category_image"))){
            return asset("media/default.png");
        }
        return asset($this->__get("category_image"));
    }
}
