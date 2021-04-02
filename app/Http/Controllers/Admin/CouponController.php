<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = coupon::paginate(PAGINATION_COUNT);

        return view('Admin.coupons.index', compact('coupons'));
    }

    public function create()
    {

        return view('Admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request)
    {
        try {
            // return $request;
            DB::beginTransaction();
            if (isset($request->status) && $request->status == 1)
                $request->request->add(['status' => 1]);
            else
                $request->request->add(['status' => 0]);

            //   return $request->except('_token','type');
            $coupon =  coupon::create($request->except('_token', 'type'));

            DB::commit();
            return redirect()->route('coupon.index')->with(['success' => 'تم ألاضافة بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('coupon.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = coupon::findOrFail($id);

        return view('Admin.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CouponRequest $request, $id)
    {
        try {

            DB::beginTransaction();
            $coupon = coupon::find($id);
            if (isset($request->status) && $request->status == 1)
                $request->request->add(['status' => 1]);
            else
                $request->request->add(['status' => 0]);

            $coupon->update($request->all());

            DB::commit();
            return redirect()->route('coupon.index')->with(['success' => 'تم التعديل بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('coupon.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $Brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = coupon::find($id);
        if (!$coupon)
            return redirect()->route('coupon.index')->with(['error' => 'هذا الماركة غير موجود ']);

        $coupon->delete();
        return redirect()->route('coupon.index')->with(['success' => 'تم الحذف بنجاح']);
    }
}
