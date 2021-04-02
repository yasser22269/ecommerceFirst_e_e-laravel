<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{

    public function index(Request $request)
    {

        $products = auth('web')->user()->wishlist()->paginate(PAGINATION_COUNT);


        //   return $products;

        return view('front.wishlist.index', compact('products', 'slug'));
    }




    public function store(Request $request)
    {
        if (!Auth::user() == 1) {
            // return redirect()->route('login')->with(['error' => 'يرجى تسجيل الدخول اولا']);
            return response()->json(['error' => 'يرجى تسجيل الدخول اولا']);
        } else if (!auth('web')->user()->wishlistHas(request('productId'))) {
            auth('web')->user()->wishlist()->attach(request('productId'));
            return response()->json(['status' => true, 'wished' => true]);
        } else {
            auth('web')->user()->wishlist()->detach(request('productId'));
            return response()->json(['status' => true, 'wished' => false]);  // added before we can use enumeration here

        }
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
