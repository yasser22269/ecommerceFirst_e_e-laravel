<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingMethodsRequest;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editShippingMethods($type)
    {
        if ($type === 'free')
            $shippingMethod = Setting::where('key', 'free_shipping_label')->first();


        elseif ($type === 'local')
            $shippingMethod = Setting::where('key', 'local_label')->first();

        elseif ($type === 'outer')
            $shippingMethod = Setting::where('key', 'outer_label')->first();
        else
            $shippingMethod = Setting::where('key', 'free_shipping_label')->first();

        // return $shippingMethod;
        return view('Admin.Settings.index', compact('shippingMethod'));
    }


    public function updateShippingMethods(ShippingMethodsRequest $request, $id)
    {
        //validation

        //update db

        try {
            //   return  $request;

            DB::beginTransaction();
            $shipping_method = Setting::find($id);
            $shipping_method->update(['plain_value' => $request->plain_value]);
            //save translations
            $shipping_method->value = $request->value;
            $shipping_method->save();

            DB::commit();
            return redirect()->back()->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with(['error' => 'هناك خطا ما يرجي المحاولة فيما بعد']);
        }
    }
}
