<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function product()
    {
        return $this->belongsToMany(Product::class,"order_products",
        'order_id', 'product_id')->withPivot('quantity', 'options');
        // ->with('quantity', 'options');
    }

}
