<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];


    protected $translatedAttributes = ['name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['parent_id', 'slug', 'is_active'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
     //protected $hidden = ['translations'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
   ];

   public function getactive(){
       return $this->is_active ==0 ? 'غير مفعل' : "مفعل";
   }

   public function Parent(){
    return $this->belongsTo(self::class,'parent_id');
    }


    public function product()
    {
        return $this->belongsToMany(Product::class,'category_products');
    }

        //get all childrens=
        
        public function childrens(){
            return $this -> hasMany(Self::class,'parent_id');
        }
}
