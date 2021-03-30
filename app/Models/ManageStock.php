<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManageStock extends Model
{
    protected $guarded = [];

    protected $casts = [
        'manage_stock' => 'boolean',
        'in_stock' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
