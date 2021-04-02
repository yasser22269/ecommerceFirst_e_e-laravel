<?php

namespace App\Http\Controllers\Admin;

use App\Models\SliderImages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SliderImagesTranslation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SliderImagesRequest;

class SliderImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $SliderImages = SliderImages::paginate(PAGINATION_COUNT);
        // translatedIn(app() -> getLocale())->
        // return Request::has('SliderImagess');
        return view('Admin.sliderimages.index', compact('SliderImages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return $SliderImagess;
        $categories = Category::translatedIn(app()->getLocale())->get();

        return view('Admin.sliderimages.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderImagesRequest $request)
    {
        //    return $request;
        try {

            DB::beginTransaction();

            $fileName = "";
            if ($request->has('photo')) {

                $fileName = uploadImage('SliderImages', $request->photo);
                $request->photo = $fileName;
            }

            //   return $fileName;
            //   return $request->all();
            $SliderImages =  SliderImages::create($request->except('_token', 'name'));

            //save translations
            // $SliderImages->title = $request->name;
            $SliderImages->photo = $fileName;
            $SliderImages->save();

            //  return $SliderImages;
            DB::commit();
            return redirect()->route('Slider.index')->with(['success' => 'تم ألاضافة بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('Slider.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SliderImages  $SliderImages
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Slider = SliderImages::findOrFail($id);
        $categories = Category::translatedIn(app()->getLocale())->get();

        return view('Admin.sliderimages.edit', compact("Slider", "categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SliderImages  $SliderImages
     * @return \Illuminate\Http\Response
     */
    public function update(SliderImagesRequest $request, $id)
    {
        //   return $request->photo;
        try {


            DB::beginTransaction();
            $SliderImages = SliderImages::find($id);
            if ($request->has('photo')) {

                $photo = str_replace('http://localhost:8000/', '',  $SliderImages->photo);
                if (File::exists($photo)) {
                    File::delete($photo);
                }

                $fileName = uploadImage('SliderImages', $request->photo);
                SliderImages::where('id', $id)
                    ->update([
                        'photo' => $fileName,
                    ]);
            }
            // return $request;
            // return $request;منتج1
            $SliderImages->update($request->except('_token', 'id', 'photo', '_method', 'name'));

            //save translations
            // $SliderImages->title = $request->name;
            // $SliderImages->save();


            DB::commit();
            return redirect()->route('Slider.index')->with(['success' => 'تم التعديل بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('Slider.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SliderImages  $SliderImages
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $SliderImages = SliderImages::find($id);
        if (!$SliderImages)
            return redirect()->route('Slider.index')->with(['error' => 'هذا الماركة غير موجود ']);

        $SliderImagesNames = SliderImagesTranslation::where('slider_images_id', $SliderImages->id)->get();
        if ($SliderImagesNames->count() > 0) {
            foreach ($SliderImagesNames as  $SliderImagesName) {
                $SliderImagesName->delete();
            }
        }
        $photo = str_replace('http://localhost:8000/', '',  $SliderImages->photo);
        if (File::exists($photo)) {
            File::delete($photo);
        }
        // return  $SliderImagesNames;
        $SliderImages->delete();
        return redirect()->route('Slider.index')->with(['success' => 'تم الحذف بنجاح']);
    }
}
