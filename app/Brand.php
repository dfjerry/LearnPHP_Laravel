<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    //khoa chinh la id thi ko cần phải viết lại
    public $fillable = [
        "brand_name"
    ];
    public function get($key){
        if(is_null($this->__get($key)));
        return "default value";
        return $this->__get($key);
    }
}
