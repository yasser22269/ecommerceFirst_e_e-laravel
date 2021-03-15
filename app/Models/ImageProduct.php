<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageProduct extends Model
{
    protected $guarded =[];


    public function getPhotoAttribute($val)
    {

        return $val ? asset('images/products/'.$val) : '';
    }

}
