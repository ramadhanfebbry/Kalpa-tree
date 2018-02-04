<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/', 'WebController@index');
Route::get('appetizer', 'WebController@appetizer');
Route::get('main-dishes', 'WebController@maindishes');
Route::get('desserts', 'WebController@desserts');
Route::get('drinks', 'WebController@drinks');
Route::post('sendcontact', 'WebController@sendcontact');

Route::get('/admin', function () {
    return redirect('login');
});

Auth::routes();

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/admin/dashboard', 'HomeController@index')->name('admin.home');
Route::get('/profil/{id}/edit', 'HomeController@edit')->name('profil.edit');
	
Route::group(['prefix' => 'root', 'middleware' => 'auth'], function () {
	Route::get('/dashboard', 'HomeController@index')->name('root.home');
	
	Route::get('/user/data', ['as' => 'user.data', 'uses' => 'Root\\UserController@anyData']);
	Route::resource('/user', 'Root\\UserController', [
		'names' => [
			'index' => 'user',
			'create' => 'user.new',
			'edit' => 'user.edit',
			'show' => 'user.show'
		]
	]);
	
	Route::get('/slider/data', ['as' => 'slider.data', 'uses' => 'Root\\SliderController@anyData']);
	Route::resource('/slider', 'Root\\SliderController', [
		'names' => [
			'index' => 'slider',
			'create' => 'slider.new',
			'edit' => 'slider.edit',
			'show' => 'slider.show'
		]
	]);
	
	Route::get('/gallery/data', ['as' => 'gallery.data', 'uses' => 'Root\\GalleryController@anyData']);
	Route::resource('/gallery', 'Root\\GalleryController', [
		'names' => [
			'index' => 'gallery',
			'create' => 'gallery.new',
			'edit' => 'gallery.edit',
			'show' => 'gallery.show'
		]
	]);
	
	Route::get('/coffee/data', ['as' => 'coffee.data', 'uses' => 'Root\\CoffeeController@anyData']);
	Route::resource('/coffee', 'Root\\CoffeeController', [
		'names' => [
			'index' => 'coffee',
			'create' => 'coffee.new',
			'edit' => 'coffee.edit',
			'show' => 'coffee.show'
		]
	]);
	
	Route::get('/restaurant/data', ['as' => 'restaurant.data', 'uses' => 'Root\\RestaurantController@anyData']);
	Route::resource('/restaurant', 'Root\\RestaurantController', [
		'names' => [
			'index' => 'restaurant',
			'create' => 'restaurant.new',
			'edit' => 'restaurant.edit',
			'show' => 'restaurant.show'
		]
	]);
	
	Route::get('/bar-lounge/data', ['as' => 'bar-lounge.data', 'uses' => 'Root\\BarLoungeController@anyData']);
	Route::resource('/bar-lounge', 'Root\\BarLoungeController', [
		'names' => [
			'index' => 'bar-lounge',
			'create' => 'bar-lounge.new',
			'edit' => 'bar-lounge.edit',
			'show' => 'bar-lounge.show'
		]
	]);
	
	Route::get('/career/data', ['as' => 'career.data', 'uses' => 'Root\\CareerController@anyData']);
	Route::resource('/career', 'Root\\CareerController', [
		'names' => [
			'index' => 'career',
			'create' => 'career.new',
			'edit' => 'career.edit',
			'show' => 'career.show'
		]
	]);
	
	Route::get('/event/data', ['as' => 'event.data', 'uses' => 'Root\\EventController@anyData']);
	Route::resource('/event', 'Root\\EventController', [
		'names' => [
			'index' => 'event',
			'create' => 'event.new',
			'edit' => 'event.edit',
			'show' => 'event.show'
		]
	]);
	
	Route::get('/about/data', ['as' => 'about.data', 'uses' => 'Root\\AboutController@anyData']);
	Route::resource('/about', 'Root\\AboutController', [
		'names' => [
			'index' => 'about',
			'create' => 'about.new',
			'edit' => 'about.edit',
			'show' => 'about.show'
		]
	]);
	
	Route::get('/menus/data', ['as' => 'menus.data', 'uses' => 'Root\\MenusController@anyData']);
	Route::resource('/menus', 'Root\\MenusController', [
		'names' => [
			'index' => 'menus',
			'create' => 'menus.new',
			'edit' => 'menus.edit',
			'show' => 'menus.show'
		]
	]);
	
	Route::get('/appetizer/data', ['as' => 'appetizer.data', 'uses' => 'Root\\AppetizerController@anyData']);
	Route::resource('/appetizer', 'Root\\AppetizerController', [
		'names' => [
			'index' => 'appetizer',
			'create' => 'appetizer.new',
			'edit' => 'appetizer.edit',
			'show' => 'appetizer.show'
		]
	]);
    
    Route::get('/appetizer-addons/{id}/add','Root\\AppetizerController@addaddons');
    Route::post('/appetizer-addons/{id}/save','Root\\AppetizerController@saveaddons');
    Route::get('/appetizer-addons/{id}/edit','Root\\AppetizerController@editaddons');
    Route::post('/appetizer-addons/{id}/update','Root\\AppetizerController@updateaddons');
    Route::get('/appetizer-addons/{id}/delete','Root\\AppetizerController@deleteaddons');
	
	Route::get('/main-dishes/data', ['as' => 'main-dishes.data', 'uses' => 'Root\\MainDishesController@anyData']);
	Route::resource('/main-dishes', 'Root\\MainDishesController', [
		'names' => [
			'index' => 'main-dishes',
			'create' => 'main-dishes.new',
			'edit' => 'main-dishes.edit',
			'show' => 'main-dishes.show'
		]
	]);
    
    Route::get('/main-dishes-addons/{id}/add','Root\\MainDishesController@addaddons');
    Route::post('/main-dishes-addons/{id}/save','Root\\MainDishesController@saveaddons');
    Route::get('/main-dishes-addons/{id}/edit','Root\\MainDishesController@editaddons');
    Route::post('/main-dishes-addons/{id}/update','Root\\MainDishesController@updateaddons');
    Route::get('/main-dishes-addons/{id}/delete','Root\\MainDishesController@deleteaddons');
	
	Route::get('/desserts/data', ['as' => 'desserts.data', 'uses' => 'Root\\DessertsController@anyData']);
	Route::resource('/desserts', 'Root\\DessertsController', [
		'names' => [
			'index' => 'desserts',
			'create' => 'desserts.new',
			'edit' => 'desserts.edit',
			'show' => 'desserts.show'
		]
	]);
    
    Route::get('/desserts-addons/{id}/add','Root\\DessertsController@addaddons');
    Route::post('/desserts-addons/{id}/save','Root\\DessertsController@saveaddons');
    Route::get('/desserts-addons/{id}/edit','Root\\DessertsController@editaddons');
    Route::post('/desserts-addons/{id}/update','Root\\DessertsController@updateaddons');
    Route::get('/desserts-addons/{id}/delete','Root\\DessertsController@deleteaddons');
	
	Route::get('/drinks/data', ['as' => 'drinks.data', 'uses' => 'Root\\DrinksController@anyData']);
	Route::resource('/drinks', 'Root\\DrinksController', [
		'names' => [
			'index' => 'drinks',
			'create' => 'drinks.new',
			'edit' => 'drinks.edit',
			'show' => 'drinks.show'
		]
	]);
    
    Route::get('/drinks-addons/{id}/add','Root\\DrinksController@addaddons');
    Route::post('/drinks-addons/{id}/save','Root\\DrinksController@saveaddons');
    Route::get('/drinks-addons/{id}/edit','Root\\DrinksController@editaddons');
    Route::post('/drinks-addons/{id}/update','Root\\DrinksController@updateaddons');
    Route::get('/drinks-addons/{id}/delete','Root\\DrinksController@deleteaddons');
    
	Route::get('/location/data', ['as' => 'location.data', 'uses' => 'Root\\LocationController@anyData']);
	Route::resource('/location', 'Root\\LocationController', [
		'names' => [
			'index' => 'location',
			'create' => 'location.new',
			'edit' => 'location.edit',
			'show' => 'location.show'
		]
	]);
    
	Route::get('/contact/data', ['as' => 'contact.data', 'uses' => 'Root\\ContactController@anyData']);
	Route::resource('/contact', 'Root\\ContactController', [
		'names' => [
			'index' => 'contact',
			'create' => 'contact.new',
			'edit' => 'contact.edit',
			'show' => 'contact.show'
		]
	]);
});