<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::group(['namespace' => 'Admin', 'middleware' => 'auth:admin', 'prefix' => 'Admin'], function () {
             Route::get('/', 'AdminController@index')->name('Admin');
             Route::get('/logout', 'LoginController@logout')->name('admin.logout');

        // ------------------------------Start Categories--------------------------------------------

            Route::resource('Category', 'CategoryController');

        // ------------------------------End Categories--------------------------------------------

          // ------------------------------Start Brands--------------------------------------------

         Route::resource('Brand', 'BrandController');

         // ------------------------------End Brands--------------------------------------------

         // ------------------------------Start Tags--------------------------------------------

         Route::resource('Tag', 'TagController');

         // ------------------------------End Tags--------------------------------------------


         // ------------------------------Start Settings--------------------------------------------

        //  Route::resource('Settings', 'SettingController');
         Route::get('shipping-methods/{type}', 'SettingController@editShippingMethods')->name('edit.shippings.methods');
         Route::put('shipping-methods/{id}', 'SettingController@updateShippingMethods')->name('update.shippings.methods');

         // ------------------------------End Settings--------------------------------------------



             // ------------------------------Start Users--------------------------------------------

             Route::resource('Users', 'UserController');

             // ------------------------------End Users--------------------------------------------


             // ------------------------------Start Admins--------------------------------------------

                //  Route::resource('Admins', 'AdminController');

                Route::get('profile', 'AdminController@profile')->name('admin.profile');
                Route::put('profile/{id}', 'AdminController@updateprofile')->name('admin.update.profile');

             // ------------------------------End Admins--------------------------------------------



             // ------------------------------Start Products--------------------------------------------

             Route::resource('Products', 'ProductController');
             Route::put('Products/Priceupdate/{id}', 'ProductController@Priceupdate')->name('Products.Priceupdate');
             Route::post('Products/stockupdate/{id}', 'ProductController@stockupdate')->name('Products.stockupdate');

             Route::post('Products/imageupdate', 'ProductController@imageupdate')->name('Products.imageupdate');
             Route::post('Products/imageupdate/{id}', 'ProductController@imageupdateDB')->name('Products.imageupdate.db');
             Route::post('Products/imagedelete', 'ProductController@imagedelete')
             ->name('admin.products.images.delete');

             Route::post('Products/imagedelete/{id}', 'ProductController@imagedeleteId')
             ->name('admin.products.imagedeleteId');
             // ------------------------------End Products--------------------------------------------

            // ------------------------------Start Attribute--------------------------------------------

            Route::resource('Attributes', 'AttributeController');

            // ------------------------------End Attribute--------------------------------------------




             // ------------------------------Start Options----------------------------------------

             Route::resource('Options', 'OptionController');

             // ------------------------------End Options-----------------------------------------

            // ------------------------------Start Contacts-----------------------------------------

                Route::resource('Contact', 'ContactUs')->only(['index','destroy','show']);

            // ------------------------------End Contacts--------------------------------------------


              // ------------------------------Start Contacts--------------------------------------

              Route::resource('OrderAdmin', 'OrderController');

              // ------------------------------End Contacts--------------------------------------

            // ------------------------------Start Slider--------------------------------------------

            Route::resource('Slider', 'SliderImagesController');

            // ------------------------------End Slider--------------------------------------------

                    // ------------------------------Start Contacts--------------------------------

                    Route::resource('coupon', 'CouponController');

                    // ------------------------------End Contacts----------------------------------


    });

});//

Route::group(['namespace' => 'Admin', 'middleware' => 'guest:admin', 'prefix' => 'Admin'], function () {

    Route::get('login', 'LoginController@login')->name('admin.login');
    Route::post('login', 'LoginController@postLogin')->name('admin.post.login');

});
