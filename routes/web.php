<?php

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

Auth::routes();

Route::get('/', function () {return view('auth.login');});

Route::post('/changePassword/{id}','UserController@changePassword');

Route::get('/home', 'DashboardController@index')->name('dashboard');
Route::get('/profile', 'ProfileController@index')->name('profile');

//SUPPLIER MANAGEMENT
Route::resource('suppliers', 'SupplierController');
Route::get('/suppliers', 'SupplierController@index')->name('suppliers');
Route::get('getSupplier/{id}', 'SupplierController@getSupplier');
Route::get('/searchSuppliers', ['as'=>'searchSuppliers','uses'=>'SupplierController@index']);

//SUPPLY MANAGEMENT
Route::resource('supplies', 'SupplyController');
Route::get('supplies/{id}', 'SupplyController@show');
Route::get('getSupply/{id}', 'SupplyController@getSupply');
Route::get('/searchSupplies', ['as'=>'searchSupplies','uses'=>'SupplyController@index']);

//USER MANAGEMENT
Route::resource('create_users', 'UserController');
Route::get('/usrmgmt', 'UserController@index')->name('usrmgmt');
Route::get('getUser/{id}', 'UserController@getUser');
Route::get('/searchUsers', ['as'=>'searchUsers','uses'=>'UserController@index']);


//INVENTORY
Route::resource('inventory', 'InventoryController');
Route::get('getItem/{id}', 'InventoryController@getItem');
Route::get('/searchItems', ['as'=>'searchItems','uses'=>'InventoryController@index']);
Route::get('items/{id}', 'InventoryController@show');
Route::get('/inventory', 'InventoryController@index')->name('inventory');
