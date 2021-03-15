<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SliderImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $data = [];
    public function __construct()
    {
        //  $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $categories = Category::where('parent_id',Null)->select('id', 'slug')->with(['childrens'=>function($q){
        //     $q->select('id', 'parent_id', 'slug');
        //     $q->with(['childrens'=>function($q){
        //         $q->select('id', 'parent_id','slug');
        //     }]);
        // }])->translatedIn(app() -> getLocale())->get();
        //    return  $categories;
         $SliderImages = SliderImages::translatedIn(app() -> getLocale())->limit(5)->get();
        //    return $SliderImages->Count();
            // return  auth('web')->user()->wishlist->Count() ;
        return view('home',compact('SliderImages'));
    }
}
