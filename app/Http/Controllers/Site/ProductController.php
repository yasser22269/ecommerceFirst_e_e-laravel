<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductTranslation;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $slug)
    {
        // $products = Product::paginate(PAGINATION_COUNT);
        //    return $slug;
        $categories = Category::where('slug', $slug)->translatedIn(app()->getLocale())->first();
        // return $categories;
        //القسم-الثانى Allproducts
        if ($slug == 'Allproducts') {
            $products = Product::translatedIn(app()->getLocale())->paginate(PAGINATION_COUNT);
            foreach ($products as $product) {
                Check_specialprice_null($product);
            }
        } else {
            if ($categories) {

                $products = $categories->product()->translatedIn(app()->getLocale())->paginate(PAGINATION_COUNT);

                foreach ($products as $product) {
                    Check_specialprice_null($product);
                }
                // return $products;
            } else
                $products = Product::translatedIn(app()->getLocale())->paginate(PAGINATION_COUNT);
        }

        //  return $products;

        return view('front.products.index', compact('products', 'slug'));
    }




    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();

        //return $product ;
        Check_specialprice_null($product);


        //viewed ++
        $product->viewed++;

        $product->save();

        if (!$product) {
            $products = Product::translatedIn(app()->getLocale())->paginate(PAGINATION_COUNT);
            return view('front.products.index', compact('products', 'slug'))
                ->with(['success' => 'لا يوجد منتج بهذا الشكل']);
        }

        $product_id = $product->id;
        $product_attributes =  Attribute::whereHas('option', function ($q) use ($product_id) {
            //  $q -> whereHas('product',function ($qq) use($product_id){
            $q->where('product_id', $product_id);
            //  });
        })->get();
        //return $product_attributes ;
        $Total_comments = $product->comment->count();
        $countnum = 0;
        foreach ($product->comment as $comment) {
            $countnum += intval($comment->rate);
        }
        if ($Total_comments != 0)
            $countnum = $countnum / $Total_comments;



        return view('front.products.show', compact('product', 'slug', 'product_attributes', "Total_comments", 'countnum'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $productid = ProductTranslation::select('product_id')->where('name', 'like', '%' . $request->name . '%')->orWhere('description', 'like', '%' . $request->name . '%')->orWhere('short_description', 'like', '%' . $request->name . '%')->get();

        $products = Product::whereIn("id", $productid)->paginate(PAGINATION_COUNT);

        if (!$products) {
            $products = Product::translatedIn(app()->getLocale())->paginate(PAGINATION_COUNT);
            return view('front.products.index', compact('products', 'slug'))
                ->with(['success' => 'لا يوجد منتج بهذا الشكل']);
        }

        return view('front.products.search', compact('products'));
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
