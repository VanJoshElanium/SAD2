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

Route::get('/home', 'DashboardController@index')->name('dashboard');
Route::get('/profile', 'ProfileController@index')->name('profile');

//SUPPLIER MANAGEMENT
Route::resource('suppliers', 'SupplierController');
Route::get('/suppliers', 'SupplierController@index')->name('suppliers');
Route::get('getSupplier/{id}', 'SupplierController@getSupplier');
Route::get('/searchSuppliers', ['as'=>'searchSuppliers','uses'=>'SupplierController@index']);

//SUPPLY MANAGEMENT
Route::resource('supplies', 'SupplyController');
Route::get('getSupply/{id}', 'SupplyController@getSupply');
Route::get('/searchSupplies', ['as'=>'searchSupplies','uses'=>'SupplyController@index']);
Route::get('supplies/{id}', 'SupplyController@show');

//USER MANAGEMENT
Route::resource('create_users', 'UserController');
Route::get('/usrmgmt', 'UserController@index')->name('usrmgmt');
Route::get('getUser/{id}', 'UserController@getUser');
Route::get('/searchUsers', ['as'=>'searchUsers','uses'=>'UserController@index']);

//Invneotry
Route::resource('inventory', 'InventoryController');
Route::get('/inventory', 'InventoryController@index')->name('inventory');

?>