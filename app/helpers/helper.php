<?php

use App\Models\Category;

define('PAGINATION_COUNT', 10);

function getFolder()
{
    return app()->getLocale() == 'ar' ? 'css-rtl' : 'css';
}


function uploadImage($folder,$image){
    $image->store('/', $folder);
    $filename = $image->hashName();
    return  $filename;
 }
// function dataWeb ()
// {
//     $categories = Category::where('parent_id',Null)->translatedIn(app() -> getLocale())->limit(10)->get();
//     $data =[
//         'categories' => $categories,
//     ];
//     return $data;
// }
function Check_specialprice_null($product)
{

if($product->special_price !=null  && $product->special_price_end < now()){
    $product->special_price =null;
    $product->special_price_type =null;
    $product->special_price_start =null;
    $product->special_price_end =null;
    $product->save();
}
}
