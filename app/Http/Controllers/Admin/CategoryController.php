<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category as RequestsCategory;
use App\Models\Category ;
use App\Models\CategoryTranslation;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //translatedIn(app() -> getLocale())->
        $categories = Category::paginate(PAGINATION_COUNT);
        return view('Admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id')->translatedIn(app() -> getLocale())->get();
        // return $categories;
        return view('Admin.categories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsCategory $request)
    {
        // try{

       DB::beginTransaction();
            if(isset($request->is_active) && $request->is_active ==1)
            $request->request->add(['is_active' => 1]);
              else
              $request->request->add(['is_active' => 0]);


              if(! isset($request->parent_id) || $request->type ==1)
                $request->request->add(['parent_id' => null]);

            //slug
            $request->request->add(['slug' => \Str::slug($request->slug)]);


            //   return $request->except('_token','type');
            $Category =  Category::create($request->except('_token','type'));


            //save translations
            $Category->name = $request->name;
            $Category->save();

           // return $Category;
           DB::commit();
              return redirect()->route('Category.index')->with(['success' => 'تم ألاضافة بنجاح']);

        // }catch (\Exception $ex) {
        //     DB::rollback();
        //     return redirect()->route('Category.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        // }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        $categories = Category::translatedIn(app() -> getLocale())->get();
        return view('Admin.categories.edit',compact('categories',"category"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsCategory $request,$id)
    {
        try{

            DB::beginTransaction();
        $Category = Category::find($id);
        if(isset($request->is_active) && $request->is_active ==1)
        $request->request->add(['is_active' => 1]);
          else
          $request->request->add(['is_active' => 0]);


          if(! isset($request->parent_id) || $request->type ==1)
            $request->request->add(['parent_id' => null]);

            $request->request->add(['slug' => \Str::slug($request->slug)]);


          // return $request;
          $Category->update($request->all());

        //save translations
        $Category->name = $request->name;
        $Category->save();


        DB::commit();
        return redirect()->route('Category.index')->with(['success' => 'تم التعديل بنجاح']);

  }catch (\Exception $ex) {
      DB::rollback();
      return redirect()->route('Category.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
  }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Category = Category::find($id);
        $Categories = Category::where('parent_id',$Category->id)->get();

       // return $Categories;
     //   return $Categories->count();
     $CategoryNames = CategoryTranslation::where('category_id',$Category->id)->get();
     if($CategoryNames->count() >0){
         foreach ($CategoryNames as  $CategoryName) {
              $CategoryName->delete();
     }
    }

        //delete children
        if($Categories->count() >0){
                foreach ($Categories as  $Categorya) {
                    $Categorya->delete();
            }
        }

        $Category->delete();
        return redirect()->route('Category.index')->with(['success' => 'تم الحذف بنجاح']);
    }
}
