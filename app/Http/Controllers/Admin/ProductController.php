<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductSpecialPriceRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductSpecialImageRequest;
use App\Http\Requests\ProductSpecialStockRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ImageProduct;
use App\Models\ManageStock;
use App\Models\Offer;
use App\Models\ProductTranslation;
use App\Models\Tag;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::paginate(PAGINATION_COUNT);
        return view('Admin.products.index', compact('products'));
    }


    public function create()
    {
        // where('name','!=', null)->
        $categories = Category::translatedIn(app()->getLocale())->get();
        $tags = Tag::translatedIn(app()->getLocale())->get();
        $brands = Brand::translatedIn(app()->getLocale())->get();
        // return $categories ;
        return view('Admin.products.create', compact('categories', 'tags', 'brands'));
    }

    public function store(ProductRequest $request)
    {
        try {

            DB::beginTransaction();


            if (isset($request->is_active) && $request->is_active == 1)
                $request->request->add(['is_active' => 1]);
            else
                $request->request->add(['is_active' => 0]);

            $request->request->add(['slug' => \Str::slug($request->slug)]);

            // return $request->except('_token','type');
            $Product =  Product::create($request->except('_token', 'photo'));

            // Relations
            $Product->category()->attach($request->categories);
            $Product->tags()->attach($request->tags);

            ManageStock::create([
                'qty' => Null,
                'in_stock' => 0,
                'sku' => Null,
                'manage_stock' => 0,
                'product_id' => $Product->id,
            ]);
            Offer::create([
                'special_price_type' => Null,
                'special_price_start' => Null,
                'special_price_end' => Null,
                'special_price' => Null,
                'product_id' => $Product->id,
            ]);



            $fileName = uploadImage('products', $request->photo);
            ImageProduct::create([
                'product_id' => $Product->id,
                'photo' => $fileName,
            ]);

            //save translations
            // $Product->name = $request->name;
            // $Product->short_description = $request->short_description;
            // $Product->description = $request->description;
            $Product->save();

            // return $Product;
            DB::commit();
            return redirect()->route('Products.edit', $Product->id)->with(['success' => ' تم ألاضافة بنجاح يجب اضافه باقى الخصائص']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('Products.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function edit($id)
    {
        $Products = Product::with('category:id', 'tags:id')->findOrFail($id);
        $offer = Offer::where('product_id', $Products->id)->first();
        $ManageStock = ManageStock::where('product_id', $Products->id)->first();
        //return $offers;

        $categories = Category::translatedIn(app()->getLocale())->get();
        $tags = Tag::translatedIn(app()->getLocale())->get();
        $brands = Brand::translatedIn(app()->getLocale())->get();

        //   return date_format($Products->special_price_start ,'Y-m-d') ;
        return view('Admin.products.edit', compact('categories', 'tags', 'brands', "Products", 'offer', "ManageStock"));
    }


    public function update(ProductRequest $request, $id)
    {
        try {

            DB::beginTransaction();
            $Product = Product::find($id);
            if (isset($request->is_active) && $request->is_active == 1)
                $request->request->add(['is_active' => 1]);
            else
                $request->request->add(['is_active' => 0]);

            $request->request->add(['slug' => \Str::slug($request->slug)]);

            //  return $request->except('_token');
            $Product->update($request->except('_token'));

            // Relations
            $Product->category()->sync($request->categories);
            $Product->tags()->sync($request->tags);

            //save translations
            // $Product->name = $request->name;
            // $Product->short_description = $request->short_description;
            // $Product->description = $request->description;
            // $Product->save();


            DB::commit();
            return redirect()->route('Products.edit', $Product->id)->with(['success' => 'تم التعديل بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('Products.edit', $Product->id)->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    // ProductPriceRequest  Request

    public function Priceupdate(ProductSpecialPriceRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $offer = Offer::where('product_id', $id)->first();
            //  return $offer;
            $offer->update($request->except('_method', "_token"));

            DB::commit();
            return redirect()->route('Products.edit', $id)->with(['success' => 'تم التعديل بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('Products.edit', $id)->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function stockupdate(ProductSpecialStockRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $ManageStock = ManageStock::where('product_id', $id)->first();
            $ManageStock->update($request->except('_method', "_token"));

            DB::commit();
            return redirect()->route('Products.edit', $id)->with(['success' => 'تم التعديل بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('Products.edit', $id)->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
    // ProductSpecialStockRequest
    //to save images to folder only
    public function imageupdate(Request $request)
    {

        $file = $request->file('dzfile');
        $filename = uploadImage('products', $file);

        return response()->json([
            'name' => $filename,
            // 'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function imageupdateDB(ProductSpecialImageRequest $request, $id)
    {

        try {
            $Product = Product::find($id);

            // save dropzone images
            if ($request->has('document') && count($request->document) > 0) {
                foreach ($request->document as $image) {
                    // $fileName = "";
                    // $fileName = uploadImage('products', $image);
                    ImageProduct::create([
                        'product_id' => $request->product_id,
                        'photo' => $image,
                    ]);
                }
            }

            return redirect()->route('Products.edit', $Product->id)->with(['success' => 'تم التعديل بنجاح']);
        } catch (\Exception $ex) {
        }
    }


    public function imagedeleteId(Request $request, $id)
    {

        $ImageProduct = ImageProduct::find($id);
        //  return $ImageProduct;


        $photo = str_replace('http://localhost:8000/', '',  $ImageProduct->photo);
        if (File::exists($photo)) {
            File::delete($photo);
        }

        $ImageProduct->delete();
        return redirect()->route('Products.edit', $ImageProduct->product_id)->with(['success' => 'تم التعديل بنجاح']);
    }

    public function destroy($id)
    {
        $Product = Product::find($id);
        $ImageProducts = ImageProduct::where('product_id', $id)->get();
        foreach ($ImageProducts as $ImageProduct) {
            $photo = str_replace('http://localhost:8000/', '',  $ImageProduct->photo);
            if (File::exists($photo)) {
                File::delete($photo);
            }
            $ImageProduct->delete();
        }
        if (!$Product)
            return redirect()->route('Products.index')->with(['error' => 'هذا الماركة غير موجود ']);

        $ProductNames = ProductTranslation::where('Product_id', $Product->id)->get();
        if ($ProductNames->count() > 0) {
            foreach ($ProductNames as  $ProductName) {
                $ProductName->delete();
            }
        }
        $Product->delete();
        return redirect()->route('Products.index')->with(['success' => 'تم الحذف بنجاح']);
    }
}
