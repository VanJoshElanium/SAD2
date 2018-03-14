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
	Route::get('getSupplyDamaged/{id}', 'InventoryController@getSupplyDamaged');
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
	Route::get('getTermDetails/{id}', 'TermsProfileController@getTermDetails');

	//T-WORKERS
	Route::resource('workers', 'WorkerController');
	Route::get('getWorker/{id}', 'WorkerController@getWorker');

	//T-EXPENSES
	Route::resource('expenses', 'ExpenseController');
	Route::get('getExpense/{id}', 'ExpenseController@getExpense');

	//T-SALES
	Route::resource('sales', 'SaleController');
	Route::get('getSale/{id}', 'SaleController@getSale');
	Route::post('/printSales/{id}', 'TermsProfileController@printSales');

	//T-ITEMS
	Route::resource('term_items', 'Term_ItemController');
	Route::get('getTermItem/{id}', 'Term_ItemController@getTermItem');
	Route::post('/printItems/{id}', 'Term_ItemController@printItems');

	//T-CUSTOMERS, ORDERS, CUSTOMER_ORDER
	Route::resource('customers', 'CustomerController');
	Route::resource('orders', 'OrderController');
	Route::resource('customer_orders', 'Customer_OrderController');

	Route::get('getCustomerOrder', 'CustomerController@getCustomerOrder');

	
	//LOGS 
	Route::resource('logs', 'LogController');
	Route::get('/logs', 'LogController@index')->name('logs');
	Route::get('getLog/{id}', 'LogController@getLog');

	//STOCKS
	Route::resource('stockouts', 'StockOutController');
	Route::resource('stockins', 'StockInController');

	Route::get('/stockouts', 'StockOutController@index')->name('stockouts');
	Route::get('/stockins', 'StockInController@index')->name('stockins');

	Route::get('getSI', 'StockInController@getSI');
	Route::get('getSO', 'StockOutController@getSO');
	

?>
