<?php

namespace App\Http\Middleware;

use App\Models\Category;
use Closure;
use Illuminate\Support\Facades\View;

class GlobalData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // start categories And childrens
        $categories = Category::where('parent_id',Null)->select('id', 'slug')->with(['childrens'=>function($q){
            $q->select('id', 'parent_id', 'slug');
            $q->with(['childrens'=>function($q){
                $q->select('id', 'parent_id','slug');
            }]);
        }])->translatedIn(app() -> getLocale())->limit(7)->get();
        // End categories And childrens


     

        View::share([
               'categories'=> $categories,

               ]);
        //   View::share('categories', $categories);
          return $next($request);
    }
}
