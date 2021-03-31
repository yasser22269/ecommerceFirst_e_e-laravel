<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use Translatable,
    SoftDeletes;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand_id',
        'slug',
        'sku',
        'price',
        'is_active'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'manage_stock' => 'boolean',
        // 'in_stock' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        // 'special_price_start',
        // 'special_price_end',
        // 'start_date',
        // 'end_date',
        'deleted_at',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */

    protected $translatedAttributes = ['name', 'description', 'short_description'];

    public function getPhotoAttribute($val)
    {

        return $val ? asset('images/products/'.$val) : '';
    }

    public function getActive()
    {
        return $this->is_active == 0 ? 'غير مفعل' : 'مفعل';
    }

    public function Brand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'tag_products');
    }

    public function category()
    {
        return $this->belongsToMany(Category::class,'category_products');
    }

    public function Images()
    {
        return $this->hasMany(ImageProduct::class,'product_id');
    }

    public function options()
    {
        return $this->hasMany(Option::class, 'product_id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class,'product_id');
    }

    public function order()
    {
        return $this->belongsToMany(Order::class);
    }

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }
    public function Offer()
    {
        return $this->hasOne(Offer::class,'product_id');
    }
    public function ManageStock()
    {
        return $this->hasOne(ManageStock::class,'product_id');
    }

}
