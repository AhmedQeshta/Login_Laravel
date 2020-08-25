<?php

use Illuminate\Support\Facades\Route;

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



Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function() {
    Auth::routes(['verify' => true]);
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/home', 'HomeController@index')->name('home');
    Route::group(['prefix' => 'offers'],function (){
        Route::get('/', 'CrudController@index')->name('offers.index');
        Route::get('create', 'CrudController@create')->name('offers.create');
        Route::post('store', 'CrudController@store')->name('offers.store');
        Route::get('edit/{id}', 'CrudController@edit')->name('offers.edit');
        Route::put('update/{id}', 'CrudController@update')->name('offers.update');
        Route::get('destroy/{id?}', 'CrudController@destroy')->name('offers.destroy');
    });

    // ajax
    Route::group(['prefix' => 'ajax-offer'],function (){
        Route::get('/', 'OfferAjaxController@index')->name('ajax-offer.index');
        Route::get('create', 'OfferAjaxController@create')->name('ajax-offer.create');
        Route::post('store', 'OfferAjaxController@store')->name('ajax-offer.store');
        Route::get('edit/{id}', 'OfferAjaxController@edit')->name('ajax-offer.edit');
        Route::put('update', 'OfferAjaxController@update')->name('ajax-offer.update');
        Route::post('destroy', 'OfferAjaxController@destroy')->name('ajax-offer.destroy');
    });

//  #################### Gard and mult auth #####################

    Route::group(['prefix' => 'adults','namespace'=>'Auth','middleware'=>['CheckAge','auth']],function (){
        Route::get('/','CustomAuthController@adult')->name('adult');
    });

//    ########################End#####################
//  #################### Gard and auth #####################

    Route::group(['prefix' => 'auth','namespace'=>'Auth'],function (){
        Route::get('site','CustomAuthController@sitePage')->middleware('auth:web','CheckAge')->name('auth.site');
        Route::get('admin','CustomAuthController@adminPage')->middleware('auth:admin' , 'CheckAge')->name('auth.admin');
        Route::get('admin/login','CustomAuthController@adminLogin')->name('auth.admin.login');
        Route::post('admin/login','CustomAuthController@saveAdminLogin')->name('auth.save.admin.login');
//        Route::get('/admin/logout','CustomAuthController@adminLogout')->name('auth.admin.logout');
    });

//    ########################End#####################

//    event listener
    Route::get('youtube','CrudController@getVideo')->name('youtube.video');
    Route::get('youtube/{id}','CrudController@getVideoOne')->name('youtube.videoOne');
//    login facebook
    Route::get('/redirect', 'SocialAuthFacebookController@redirect');
    Route::get('/callback', 'SocialAuthFacebookController@callback');
});



