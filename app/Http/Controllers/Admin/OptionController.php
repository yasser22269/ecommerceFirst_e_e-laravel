<?php

namespace App\Http\Controllers\Admin;

use App\Models\Option;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OptionRequest;
use App\Models\Attribute;
use App\Models\OptionTranslation;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OptionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Options = Option::paginate(PAGINATION_COUNT);
        return view('Admin.Options.index', compact('Options'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::translatedIn(app()->getLocale())->get();
        $attrubutes = Attribute::translatedIn(app()->getLocale())->get();
        return view('Admin.Options.create', compact('attrubutes', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OptionRequest $request)
    {
        try {

            DB::beginTransaction();


            //   return $request->except('_token');
            $Option =  Option::create($request->except('_token'));

            //save translations
            // $Option->name = $request->name;
            //  $Option->save();

            // return $Option;
            DB::commit();
            return redirect()->route('Options.index')->with(['success' => 'تم ألاضافة بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('Options.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Option  $Option
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Options = Option::findOrFail($id);
        $products = Product::translatedIn(app()->getLocale())->get();
        $attrubutes = Attribute::translatedIn(app()->getLocale())->get();
        return view('Admin.Options.edit', compact("Options", 'attrubutes', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Option  $Option
     * @return \Illuminate\Http\Response
     */
    public function update(OptionRequest $request, $id)
    {
        try {

            DB::beginTransaction();
            $Option = Option::find($id);


            // return $request;
            $Option->update($request->all());

            //save translations
            // $Option->name = $request->name;
            // $Option->save();


            DB::commit();
            return redirect()->route('Options.index')->with(['success' => 'تم التعديل بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('Options.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Option  $Option
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Option = Option::find($id);


        if (!$Option)
            return redirect()->route('Options.index')->with(['error' => 'هذا الاوبشن غير موجود ']);

        $OptionNames = OptionTranslation::where('option_id', $Option->id)->get();
        if ($OptionNames->count() > 0) {
            foreach ($OptionNames as  $OptionName) {
                $OptionName->delete();
            }
        }
        $Option->delete();
        return redirect()->route('Options.index')->with(['success' => 'تم الحذف بنجاح']);
    }
}
