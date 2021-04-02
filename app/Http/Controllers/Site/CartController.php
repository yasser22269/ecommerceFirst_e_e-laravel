<?php

namespace App\Http\Controllers\Site;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function Index()
    {
        $carts = Cart::content();
        //return  $carts ;
        return view('front\cart\index', compact('carts'));
    }

    public function store($id, Request $request)
    {
        //   return  $request;
        $product = Product::find($id);
        //  return $product;
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id == $product->id;
        });

        if ($duplicates->isNotEmpty()) {
            return response()->json(['status' => true, 'wished' => false, 'success' => 'تم الاضافه من قبل']);
        }
        if (   $product->Offer->special_price )
                $price = $product->Offer->special_price;
        else
        $price =  $product->price;
        $carts = Cart::add([
            'id' => $id, 'name' => $product->name,
            'price' => $price ,
            'qty' => (request('QuantityNumber')) ?? "1",
            'options' => [
                'image' => $product->Images[0]->photo ?? asset('front/assets/images/product/product-1.png'),
                'slug' => $product->slug,
                "options" => request('options'),
                'discond' => 11
            ]


        ]);
        // return  $carts ;
        return response()->json(['status' => true, 'wished' => true, 'success' => 'تم الاضافه']);
    }


    public function delete(Request $request)
    {
        $id = request('cartId');
        $cartget = Cart::get($id);

        $price = $cartget->price * $cartget->qty;
        $cart = Cart::remove($id);
        $cartsCount = Cart::Count();
        return response()->json(['status' => true, 'wished' => true, 'success' => 'تم الحذف', 'id' => $id, 'price' => $price, 'cartsCount' => $cartsCount]);

        //return  $carts ;
        //return view('front\cart\index',compact('carts'));
        // return redirect()->back()->with(['success' => 'تم الحذف بنجاح');

    }

    // public function update(Request $request){
    //   //  try{

    //         DB::beginTransaction();

    //         Cart::update($rowId, $product);


    //     DB::commit();
    //         return redirect()->Back()->with(['success' => 'تم ألاضافة بنجاح']);

    //       //   }catch (\Exception $ex) {
    //       //       DB::rollback();
    //       //       return  redirect()->Back()->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    //       //   }
    // }
}
