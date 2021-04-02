<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\front\UserProfileRequest;
use App\Http\Requests\front\UserContactRequest;
use App\Models\ContactUS;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{

    public function profile()
    {
        $user = auth('web')->user();
        // Auth()->guard('admin')->user()
        return view('front.profile.profile', compact('user'));
    }


    public function Updateprofile(UserProfileRequest $request)
    {

        $user = User::where('id', $request->id)->first();

        //   return $user;
        $user->name = $request->name;
        $user->email = $request->email;
        if (isset($request['password']) && $request['password'] != '') {
            $user->password = bcrypt($request['password']);
        }
        // return public_path("images/Avatars/". $user->avatar);

        if ($request->has('avatar') && $request->avatar != "account-image-placeholder.jpg") {

            $fileName = uploadImage('Avatars', $request->avatar);

            $image_path = public_path("images/Avatars/" . $user->avatar);

            // Value is not URL but directory file path
            if (File::exists($image_path) && $user->avatar != "account-image-placeholder.jpg") {
                File::delete($image_path);
            }
            $user->avatar =  $fileName;
        }

        $user->save();

        // DB::commit();
        return redirect()->back()->with(['success' => 'تم التحديث بنجاح']);
    }













    public function Contacts()
    {
        // $user = auth('web')->user();
        // Auth()->guard('admin')->user()   ,compact('user'))
        return view('front.contacts.index');
    }


    public function UpdateContacts(UserContactRequest $request)
    {

        // return $request->all();
        ContactUS::create($request->all());

        //   return $user;Request
        // return public_path("images/Avatars/". $user->avatar);
        // DB::commit();
        return redirect()->back()->with(['success' => 'تم الارسال بنجاح']);
    }
}
