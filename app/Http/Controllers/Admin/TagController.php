<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Tag ;
use App\Models\TagTranslation;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::paginate(PAGINATION_COUNT);
        return view('Admin.tags.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('Admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        try{

       DB::beginTransaction();
            if(isset($request->is_active) && $request->is_active ==1)
            $request->request->add(['is_active' => 1]);
              else
              $request->request->add(['is_active' => 0]);

              $request->request->add(['slug' => \Str::slug($request->slug)]);

             // return $request->except('_token','type');
            $Tag =  Tag::create($request->except('_token'));

            //save translations
           // $Tag->name = $request->name;
           // $Tag->save();

           // return $Tag;
           DB::commit();
              return redirect()->route('Tag.index')->with(['success' => 'تم ألاضافة بنجاح']);

        }catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('Tag.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $Tag
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('Admin.tags.edit',compact("tag"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $Tag
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request,$id)
    {
        try{

            DB::beginTransaction();
        $Tag = Tag::find($id);
        if(isset($request->is_active) && $request->is_active ==1)
        $request->request->add(['is_active' => 1]);
          else
          $request->request->add(['is_active' => 0]);

          $request->request->add(['slug' => \Str::slug($request->slug)]);


          // return $request;
          $Tag->update($request->all());

        //save translations
        //$Tag->name = $request->name;
       // $Tag->save();


        DB::commit();
        return redirect()->route('Tag.index')->with(['success' => 'تم التعديل بنجاح']);

  }catch (\Exception $ex) {
      DB::rollback();
      return redirect()->route('Tag.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
  }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $Tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Tag = Tag::find($id);


        if (!$Tag)
        return redirect()->route('Tag.index')->with(['error' => 'هذا الماركة غير موجود ']);

        $TagNames = TagTranslation::where('tag_id',$Tag->id)->get();
        if($TagNames->count() >0){
            foreach ($TagNames as  $TagName) {
                 $TagName->delete();
        }
    }
        $Tag->delete();
        return redirect()->route('Tag.index')->with(['success' => 'تم الحذف بنجاح']);
    }
}
