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
