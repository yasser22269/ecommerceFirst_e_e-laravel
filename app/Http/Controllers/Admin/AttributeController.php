<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Models\AttributeTranslation;
use Illuminate\Support\Facades\DB;

class AttributeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = Attribute::paginate(PAGINATION_COUNT);
        return view('Admin.attributes.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('Admin.attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeRequest $request)
    {
        try {

            DB::beginTransaction();



            $Attribute =  Attribute::create($request->except('_token'));

            //save translations
            //  $Attribute->name = $request->name;
            // $Attribute->save();

            // return $Attribute;
            DB::commit();
            return redirect()->route('Attributes.index')->with(['success' => 'تم ألاضافة بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('Attributes.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attribute  $Attribute
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Attribute = Attribute::findOrFail($id);
        return view('Admin.attributes.edit', compact("Attribute"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attribute  $Attribute
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeRequest $request, $id)
    {
        try {

            DB::beginTransaction();
            $Attribute = Attribute::find($id);

            // return $request;
            $Attribute->update($request->all());

            //save translations
            //  $Attribute->name = $request->name;
            //  $Attribute->save();


            DB::commit();
            return redirect()->route('Attributes.index')->with(['success' => 'تم التعديل بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('Attributes.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attribute  $Attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Attribute = Attribute::find($id);


        if (!$Attribute)
            return redirect()->route('Attributes.index')->with(['error' => 'هذا صفة غير موجود ']);

        $AttributeNames = AttributeTranslation::where('Attribute_id', $Attribute->id)->get();
        if ($AttributeNames->count() > 0) {
            foreach ($AttributeNames as  $AttributeName) {
                $AttributeName->delete();
            }
        }
        $Attribute->delete();
        return redirect()->route('Attributes.index')->with(['success' => 'تم الحذف بنجاح']);
    }
}
