<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Models\BrandTranslation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::paginate(PAGINATION_COUNT);
        // translatedIn(app() -> getLocale())->
        //return $brands;
        return view('Admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return $brands;
        return view('Admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        //return $request;
        try {

            DB::beginTransaction();
            if (isset($request->is_active) && $request->is_active == 1)
                $request->request->add(['is_active' => 1]);
            else
                $request->request->add(['is_active' => 0]);

            $fileName = "";
            if ($request->has('photo')) {

                $fileName = uploadImage('brands', $request->photo);
            } else
                $fileName = "defualt.png";

            //return $request->all();
            $Brand =  Brand::create($request->except('_token', 'photo'));

            //save translations
            //  $Brand->name = $request->name;
            $Brand->photo = $fileName;
            $Brand->save();

            //  return $Brand;
            DB::commit();
            return redirect()->route('Brand.index')->with(['success' => 'تم ألاضافة بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('Brand.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $Brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Brand = Brand::findOrFail($id);
        //  return $Brand;

        return view('Admin.brands.edit', compact("Brand"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $Brand
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, $id)
    {
        try {

            DB::beginTransaction();
            $Brand = Brand::find($id);
            if (isset($request->is_active) && $request->is_active == 1)
                $request->request->add(['is_active' => 1]);
            else
                $request->request->add(['is_active' => 0]);

            if ($request->has('photo')) {
                // $image_path = public_path("\\"). $Brand->photo;
                // if(File::exists($image_path) && $Brand->photo != "images/brands/defualt.png") {
                //     File::delete($image_path);
                // }

                $fileName = uploadImage('brands', $request->photo);
                Brand::where('id', $id)
                    ->update([
                        'photo' => $fileName,
                    ]);
            }
            // return $request;
            // return $request;منتج1
            $Brand->update($request->except('_token', 'id', 'photo'));

            //save translations
            // $Brand->name = $request->name;
            $Brand->save();


            DB::commit();
            return redirect()->route('Brand.index')->with(['success' => 'تم التعديل بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('Brand.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $Brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Brand = Brand::find($id);
        if (!$Brand)
            return redirect()->route('Brand.index')->with(['error' => 'هذا الماركة غير موجود ']);

        $BrandNames = BrandTranslation::where('brand_id', $Brand->id)->get();
        if ($BrandNames->count() > 0) {
            foreach ($BrandNames as  $BrandName) {
                $BrandName->delete();
            }
        }

        // $image_path = public_path("\\"). $Brand->photo;
        //  return  $Brand->photo;
        // Value is not URL but directory file path
        if (File::exists($Brand->photo) && $Brand->photo != "images/brands/defualt.png") {
            File::delete($Brand->photo);
        }
        // return  $BrandNames;
        $Brand->delete();
        return redirect()->route('Brand.index')->with(['success' => 'تم الحذف بنجاح']);
    }
}
