<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Coll Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function() {
    Route::get('collection','collectTutController@index')->name('collection');
    Route::get('main-offers-each','collectTutController@complexEach')->name('OffersComplexEach');
    Route::get('main-offers-filter','collectTutController@complexFilter')->name('OffersComplexFilter');
    Route::get('main-offers-transform','collectTutController@complexTransform')->name('OfferscomplexTransform');
});
