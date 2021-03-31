<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath',

    // My middlewares
    'globaldata'

    ]
], function () {




        Auth::routes();

        // Route::get('/', 'Site\HomeController@index');

        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/logoutWeb', 'Auth\LoginController@logoutWeb')->name('logoutWeb');


        //________________________________SocialController_________________________________________________
        Route::get('/auth/redirect/{driver}', 'Auth\LoginController@redirectToProvider')->name('social.oauth');
        Route::get('/auth/{driver}/callback', 'Auth\LoginController@handleProviderCallback')->name('social.callback');

        //________________________________SocialController_________________________________________________


        Route::group(['namespace' => 'Site' ],function () {

          // ------------------------------Start Contacts--------------------------------------------
              Route::get('Contacts', 'HomeController@Contacts')->name('Contacts');
              Route::post('Contacts', 'HomeController@UpdateContacts')->name('UpdatepContacts');
          // ------------------------------End Contacts--------------------------------------------

          Route::get('Wishlists', 'WishlistController@index')->name('Wishlists.index');
          Route::post('Wishlists', 'WishlistController@store')->name('Wishlists.store');

           // ------------------------------Start products--------------------------------------------

           Route::get('products/{slug}', 'ProductController@index')->name('products.index');
           Route::get('product/{slug}', 'ProductController@show')->name('product.show');
           Route::post('product/Search', 'ProductController@search')->name('product.search');

       // ------------------------------End products--------------------------------------------

        // ------------------------------Start cart--------------------------------------------

            Route::get('cart', 'CartController@Index')->name('site.cart.index');
            Route::post('cart/store/{id}', 'CartController@store')->name('site.cart.store');
            Route::get('cart/delete/{id}', 'CartController@delete')->name('site.cart.delete');
            // Route::post('cart/update', 'CartController@update')->name('site.cart.update');


        // ------------------------------End Contacts--------------------------------------------


        // ------------------------------Start cart--------------------------------------------

        Route::post('comment', 'CommentController@store')->name('storeComment');
        // ------------------------------End Contacts--------------------------------------------



            });

        Route::group(['namespace' => 'Site','middleware' =>['auth:web'] ],function () {


            // ------------------------------Start profile--------------------------------------------

               Route::get('profile', 'HomeController@profile')->name('profile');
               Route::post('profile', 'HomeController@Updateprofile')->name('Updateprofile');

            // ------------------------------Start profile--------------------------------------------



             // ------------------------------Start Options--------------------------------------------

             Route::resource('Order', 'OrderController');
             Route::post('coupon', 'OrderController@coupon')->name('couponorder');

             Route::get('/payment', ['as' => 'payment', 'uses' => 'PaymentController@payWithpaypal']);
             Route::get('/payment/status',['as' => 'payment.status', 'uses' => 'PaymentController@getPaymentStatus']);

             // ------------------------------End Options--------------------------------------------


         });



});//



