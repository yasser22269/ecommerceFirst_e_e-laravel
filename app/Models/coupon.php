<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class coupon extends Model
{
    protected $guarded = [];


    public function getactive(){
        return $this->status ==0 ? 'غير مفعل' : "مفعل";
    }
}
