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
Route::get('getSuppliedItem/{id}', 'SupplyController@getSuppliedItem');
Route::get('/searchSupplies', ['as'=>'searchSupplies','uses'=>'SupplyController@index']);

//USER MANAGEMENT
Route::resource('create_users', 'UserController');
Route::get('/usrmgmt', 'UserController@index')->name('usrmgmt');
Route::get('getUser/{id}', 'UserController@getUser');
Route::get('/searchUsers', ['as'=>'searchUsers','uses'=>'UserController@index']);
Route::post('changePassword/{id}','UserController@changePassword');


//INVENTORY
Route::resource('inventory', 'InventoryController');
Route::get('getItem/{id}', 'InventoryController@getItem');
Route::get('getSupply/{id}', 'InventoryController@getSupply');
Route::get('/searchItems', ['as'=>'searchItems','uses'=>'InventoryController@index']);
Route::get('/inventory', 'InventoryController@index')->name('inventory');

//REPAIRS
Route::resource('repair', 'RepairController');
Route::get('getRepair/{id}', 'RepairController@getRepair');

//TERM MANAGEMENT
Route::resource('terms', 'TermsController');
Route::get('/terms', 'TermsController@index')->name('terms');

//T-PROFILE
Route::resource('termsprofile', 'TermsProfileController');
Route::get('/termsprofile', 'TermsProfileController@index')->name('termsprofile');

//T-WORKERS
Route::resource('workers', 'WorkerController');

//T-EXPENSES
Route::resource('expense', 'ExpenseController');

//T-SALES
Route::resource('sales', 'SaleController');

//T-Items
Route::resource('term_items', 'Term_ItemController');

//LOGS 
Route::resource('logs', 'LogsController');
Route::get('/logs', 'LogsController@index')->name('logs');


?>
