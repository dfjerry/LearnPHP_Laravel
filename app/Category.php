<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    //khoa chinh la id thi ko cần phải viết lại
    public $fillable = [
        "category_name"
    ];
    public function get($key){
        if(is_null($this->__get($key)));
            return "default value";
        return $this->__get($key);
    }
    public function Products(){
        return $this->hasMany("\App\Product");//trả về 1 collection lấy tất cả sản phẩm của category đó
    }
}
