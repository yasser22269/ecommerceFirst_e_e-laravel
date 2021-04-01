<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use  App\Http\Controllers\Controller;
use App\Http\Requests\AdminProfileRequest;
use App\Models\Admin;
use App\Models\ContactUS;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function index()
    {
        $produtctCount = Product::count();
        $OrderCount = Order::count();
        $UserCount = User::count();
        $ContactUSCount = ContactUS::count();
        return view('Admin.index',compact('produtctCount','OrderCount','UserCount','ContactUSCount'));
    }


    public function profile()
    {
        $admin = auth('admin')->user();
        // Auth()->guard('admin')->user()
        return view('Admin.profile.index',compact('admin'));
    }


    public function updateprofile(AdminProfileRequest $request,$id)
    {

            $admin = Admin::findOrfail($id);
            // return $request;
            $admin->name = $request->name;
            $admin->email = $request->email;
            if(isset($request['password']) && $request['password'] != ''){
                $admin->password = bcrypt($request['password']);
              }
            $admin->save();

            // DB::commit();
            return redirect()->back()->with(['success' => 'تم التحديث بنجاح']);
    }
}
