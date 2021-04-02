<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Order = Order::paginate(PAGINATION_COUNT);

        return view('Admin.orders.index', compact('Order'));
    }

    public function show($id)
    {
        $order = Order::find($id);
        // with('product')->
        //  return $order;
        //return $order->product->first()->pivot->quantity;
        return view('Admin.orders.show', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        // return $request;
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with(['success' => 'تم التعديل بنجاح']);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $Brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Order = Order::find($id);
        if (!$Order)
            return redirect()->route('OrderAdmin.index')->with(['error' => 'هذا الماركة غير موجود ']);

        $Order->delete();
        return redirect()->route('OrderAdmin.index')->with(['success' => 'تم الحذف بنجاح']);
    }
}
