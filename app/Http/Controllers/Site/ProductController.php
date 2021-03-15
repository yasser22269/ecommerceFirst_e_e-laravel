<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request ,$slug)
    {
        // $products = Product::paginate(PAGINATION_COUNT);
    //    return $slug;
        $categories = Category::where('slug', $slug)->translatedIn(app() -> getLocale())->first();
        // return $categories;
        //القسم-الثانى Allproducts

         if($slug =='Allproducts')
         $products = Product::translatedIn(app() -> getLocale())->paginate(PAGINATION_COUNT);
        else{
            if ($categories)
             $products = $categories->product()->translatedIn(app() -> getLocale())->paginate(PAGINATION_COUNT);
             else
            $products = Product::translatedIn(app() -> getLocale())->paginate(PAGINATION_COUNT);

        }

        //  return $products;

        return view('front.products.index',compact('products','slug'));
    }




    public function show($slug)
    {
        $product = Product::where('slug', $slug)->translatedIn(app() -> getLocale())->first();


        //viewed ++
        $product->viewed ++;

        $product->save();

        if (!$product){
            $products = Product::translatedIn(app() -> getLocale())->paginate(PAGINATION_COUNT);
        return view('front.products.index',compact('products','slug'))
        ->with(['success' => 'لا يوجد منتج بهذا الشكل']);
        }

        $product_id =$product->id;
        $product_attributes =  Attribute::whereHas('option' , function ($q) use($product_id){
             $q -> whereHas('product',function ($qq) use($product_id){
                $qq -> where('product_id',$product_id);
             });
        })->get();

        return view('front.products.show',compact('product','slug','product_attributes'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
