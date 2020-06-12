<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $fillable = [
        "user_id",
        "grand_total",
        "user_name",
        "address",
        "telephone",
        "note",
        "status"
    ];
    public const PENDING = 0;
    public const PROCESS = 1;
    public const SHIPPING = 2;
    public const COMPLETE = 3;
    public const CANCEL = 4;


}
