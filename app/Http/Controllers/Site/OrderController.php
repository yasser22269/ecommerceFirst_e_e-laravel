<?php

namespace App\Http\Controllers\Site;

use App\Events\NewOrder;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\front\OrderRequest;
use App\Models\coupon;
use App\Models\OrderProduct;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::content();
        //  return  $carts ;
        return view("front\checkout\index", compact('carts'));
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
    public function store(OrderRequest $request)
    {
       try {
            DB::beginTransaction();
            $order = Order::create($request->except(['_token', 'payment-method']));
            $order->payment_gateway = request('payment-method');
            $order->save();

            // Insert into order_product table
            foreach (Cart::content() as $item) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'quantity' => $item->qty,
                    'options' => $item->options->options,
                ]);
                Cart::remove($item->rowId);
            }

            event(new NewOrder($order));
           //  return $order;
            DB::commit();
            return redirect()->Back()->with(['success' => 'تم ألاضافة بنجاح']);
       } catch (\Exception $ex) {
           DB::rollback();
           return  redirect()->Back()->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function coupon(Request $request)
    {
        //return $request;

        $coupon = coupon::where(['code' => $request->code, 'status' => 1])->first();
        if (!$coupon)
            return response()->json(['status' => false, 'error' => "لا يوجد كوبون "]);

        //  return $coupon;
        return response()->json(['status' => true, 'success' => "تم اضافه الكوبون", 'Coupon_value' => $coupon->value, 'Coupon_code' => $coupon->code]);
    }



    public function show(Order $order)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
