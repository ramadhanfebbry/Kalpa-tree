<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1', 'middleware' => ['requiredParameterJson']], function () {
	Route::group(['prefix' => 'auth'], function () {
		Route::post('/login', 'Api\AuthController@login');
		Route::post('/register', 'Api\AuthController@register');
		Route::post('/forgot-password', 'Api\AuthController@forgotPassword');
		Route::post('/email-verification', 'Api\AuthController@emailVerification');
		
		Route::group(['middleware' => ['jwt.auth']], function() {
			Route::post('/logout', 'Api\AuthController@logout');
			Route::post('/change-password/{id}', 'Api\AuthController@changePassword');
			Route::post('/update-profile/{id}', 'Api\UserController@updateProfile');
		});
	});
	
	Route::group(['middleware' => ['jwt.auth']], function() {
		Route::get('/user/{id}', 'Api\UserController@show');
		
		Route::post('/merchant-reviews/save', 'Api\MerchantController@saveMerchantReview');
		Route::post('/merchant-reviews/check-availability', 'Api\MerchantController@merchantReviewCheckAvailability');
	});
	
	Route::get('/banks', 'Api\BankController@index');
	Route::get('/bank/{id}', 'Api\BankController@show');
	
	Route::get('/categories', 'Api\CategoryController@index');
	Route::get('/category/{id}', 'Api\CategoryController@show');
	
	Route::get('/merchants', 'Api\MerchantController@index');
	Route::get('/merchant/{id}', 'Api\MerchantController@show');
	Route::get('/merchant-reviews/get-by-merchant/{id}', 'Api\MerchantController@merchantReviewByMerchantId');
	Route::get('/merchant-reviews/average/{id}', 'Api\MerchantController@merchantReviewAverageByMerchantId');
	Route::patch('/merchant/save-most-view/{id}', 'Api\MerchantController@saveMostViewCounter');
	
	Route::get('/promo-types', 'Api\PromoTypeController@index');
	Route::get('/promo-type/{id}', 'Api\PromoTypeController@show');
	
	Route::get('/promos', 'Api\PromoController@index');
	Route::get('/promo/{id}', 'Api\PromoController@show');
	Route::get('/promos/get-by-merchant/{id}', 'Api\PromoController@showPromoByMerchant');
	Route::get('/promo/similiar-promos/{id}', 'Api\PromoController@listSimiliarPromos');
	
});