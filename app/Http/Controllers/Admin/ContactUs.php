<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUS as Contactuss;
use Illuminate\Http\Request;

class ContactUs extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ContactUS = Contactuss::paginate(PAGINATION_COUNT);
        // translatedIn(app() -> getLocale())->
        // return Request::has('brands');
        return view('Admin.contactus.index', compact('ContactUS'));
    }

    public function show($id)
    {
        $ContactUS = Contactuss::find($id);
        // translatedIn(app() -> getLocale())->
        // return Request::has('brands');
        return view('Admin.contactus.show', compact('ContactUS'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $Brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ContactUS = Contactuss::find($id);
        if (!$ContactUS)
            return redirect()->route('Contact.index')->with(['error' => 'هذا الماركة غير موجود ']);

        $ContactUS->delete();
        return redirect()->route('Contact.index')->with(['success' => 'تم الحذف بنجاح']);
    }
}
