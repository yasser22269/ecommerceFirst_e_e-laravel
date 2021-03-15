<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use  App\Http\Controllers\Controller;
use App\Http\Requests\AdminProfileRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
   
    public function index()
    {
        return view('Admin.index');
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
