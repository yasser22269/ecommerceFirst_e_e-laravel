<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $guarded = [];
    protected $dates = [
        'deleted_at',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
