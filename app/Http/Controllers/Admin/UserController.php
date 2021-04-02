<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\User;
use App\Models\BrandTranslation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Users = User::paginate(PAGINATION_COUNT);
        // translatedIn(app() -> getLocale())->
        // return Request::has('brands');
        return view('Admin.users.index', compact('Users'));
    }


    public function destroy($id)
    {
        $Brand = User::find($id);
        if (!$Brand)
            return redirect()->route('Users.index')->with(['error' => 'هذا العضو غير موجود ']);

        $Brand->delete();
        return redirect()->route('Users.index')->with(['success' => 'تم الحذف بنجاح']);
    }
}
