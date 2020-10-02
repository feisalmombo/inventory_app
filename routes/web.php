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

Route::get('/', function () {
	return view('auth.login');
});
// Auth::routes();
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/change_password',function(){
	return view('auth.passwords.new_user_change_pwd');
});
Route::post('/change_password','ChangePasswordController@updateNewuser');
//Check User Status
Route::group(['middleware'=>'CheckUserStatus'],function(){

Route::resource('/change-password', 'ChangePasswordController');
Route::post('/change-password', 'ChangePasswordController@update');

Route::get('/home', 'HomeController@index')->name('home');

// Dashbord
Route::get('/home', 'HomeController@index')->name('home');

//Get roles of the system
Route::get('/manage-roles/all-roles', 'RolesController@all_roles');

//Get permissions of the system
Route::get('/manage-permissions/all-permissions', 'PermissionController@all_permissions');


// //Get permissions of the system and user for JSON file
// Route::get('/manage-permissions/user-permissions-entrust', 'PermissionController@permissionsJSON');
// Route::get('/manage-permissions/user-permissions-load', 'PermissionController@permission_json');
// Route::get('/manage-permissions/user-permissions', 'PermissionController@user_permissions');


// //View for assign entrust users view
// Route::get('/manage-permissions/permissions-to-entrust_user','PermissionController@assign_entrust_user');

// //View for assign entrust role view
// Route::get('/manage-permissions/permissions-to-entrust_role','PermissionController@assign_entrust_role');

// //Insert user permission data
// Route::post('/manage-permissions/user-permissions-save', 'PermissionController@user_permissions_trust');

//Get permissions of the system and user for JSON file
//Route::get('/manage-permissions/user-permissions-entrust', 'PermissionController@permissionsJSON');
Route::get('/manage-permissions/user-permissions-load', 'PermissionController@permission_json');
Route::get('/manage-products/store-categories-load', 'ManageProductsController@category_fetch');
Route::get('/manage-permissions/role-permissions-load', 'PermissionController@role_permission_json');
Route::get('/manage-users/change-status-load', 'ManageUserController@change_status_json');

Route::get('requestedProduct/loadRequest', function (){
      //$requestData = RequestProduct::where('request_status',0)->get();
      $requestCount = DB::select('SELECT
      COUNT(request_status) as "request_count"
      FROM request_products
      WHERE request_status = ?', [0]);
      return json_encode($requestCount);
   });

Route::get('requestedProduct/loadRequestView', function (){
      //$requestData = RequestProduct::where('request_status',0)->get();
      $requestPro = DB::select('SELECT
      request_products.id,
      products.product_name,
      products.product_model
      FROM request_products
      JOIN products
      ON products.id = request_products.product_id
      WHERE request_status = ?', [0]);
      //dd($requestPro);
      return json_encode($requestPro);
   });


Route::get('/add-product-price/loadPrice', function (){
      $priceCount = DB::select('SELECT COUNT(*) as "addPriceCount" FROM products LEFT JOIN product_prices ON product_prices.product_id = products.id WHERE product_prices.product_id IS null');
      return json_encode($priceCount);
   });

Route::get('/add-product-price/loadRequestView', function (){
      $addPrice = DB::select('SELECT products.id,products.product_name, products.product_model FROM products LEFT JOIN product_prices ON product_prices.product_id = products.id WHERE product_prices.product_id IS null');
      return json_encode($addPrice);
   });

//Route::get('/manage-permissions/user-permissions', 'PermissionController@user_permissions');


//View for assign entrust users view
Route::get('/manage-permissions/permissions-to-entrust_user','PermissionController@assign_entrust_user');


//View for Product History
Route::get('manage-products/product-history/{id}','ManageProductsController@productHistory');

//View for assign entrust role view
Route::get('/manage-permissions/permissions-to-entrust_role','PermissionController@assign_entrust_role');

//Route to entrust permissions to the role
Route::post('/manage-permissions/role-permissions-save','PermissionController@role_permissions_trust');


//Insert user permission data
Route::post('/manage-permissions/user-permissions-save', 'PermissionController@user_permissions_trust');


// Link to all default route for RequestProductController (index, show, update, store, destroy, create and edit)
Route::resource('/request-products', 'RequestProductController');

// Link to all default route for ManageUserController (index, show, update, store, destroy, create and edit)
Route::resource('/manage-users', 'ManageUserController');

//Reset User Password
Route::get('manage-users/reset/{id}','ManageUserController@resetpassword');

// Link to all default route for ManageProductsController (index, show, update, store, destroy, create and edit)
Route::resource('/manage-products', 'ManageProductsController');


// Link to all default route for PermissionController (index, show, update, store, destroy, create and edit)
Route::resource('/manage-permissions', 'PermissionController');

// Link to all default route for CategoriesController (index, show, update, store, destroy, create and edit)
Route::resource('/product-categories', 'CategoriesController');

// Link to all default route for StocksController (index, show, update, store, destroy, create and edit)
Route::resource('/product-store', 'StocksController');

// Link to all default route for RolesController (index, show, update, store, destroy, create and edit)
Route::resource('/manage-roles', 'RolesController');

// Link to all default route for ManagePricesController (index, show, update, store, destroy, create and edit)
Route::resource('/manage-prices', 'ManagePricesController');

// Link to all default route for RequestProductController
Route::resource('/manage-request', 'RequestProductController');
Route::get('/manage-requests/confirmed-requests', 'RequestProductController@getAllConfirmed');


Route::get('/manage-request/single/{id}','RequestProductController@getSingleProduct');
Route::get('/manage-prices/single/{id}','ManagePricesController@getSinglePrice');


//pdf link for ManageUserController
Route::post('/manage-users/pdf/{view_type}', 'ManageUserController@pdf');
Route::post('/manage-users/{id}/pdf/{view_type}', 'ManageUserController@pdf');


//pdf link for ManageProductController
Route::post('/manage-products/pdf/{view_type}', 'ManageProductsController@pdf');
Route::post('/manage-products/{id}/pdf/{view_type}', 'ManageProductsController@pdf');


//pdf link for CategoriesController
Route::post('/product-categories/pdf/{view_type}', 'CategoriesController@pdf');

//pdf link for RequestController
Route::post('/product-request/confirmed-requests/pdf/{view_type}', 'RequestProductController@pdf');

//pdf link for StocksController
Route::post('/product-store/{id}/pdf/{view_type}', 'StocksController@pdf');
Route::post('/product-store/pdf/{view_type}', 'StocksController@pdf');

//pdf link for ManagePricesController
Route::post('/manage-prices/pdf/{view_type}', 'ManagePricesController@pdf');

//pdf link for ManagePricesController
Route::post('/manage-roles/pdfRoles/{view_type}', 'RolesController@pdfRoles');

//pdf link for ManagePricesController
Route::post('/manage-roles/all-roles/pdfAll/{view_type}', 'RolesController@pdfAll');
//pdf link for PermissionController
Route::post('/manage-permissions/all-permissions/pdf/{view_type}', 'PermissionController@pdf');


//Download Excel or CSV
Route::post('/manage-users/excel/download/{type}', 'ManageUserController@getUsersExcel');
Route::post('/manage-users/{id}/excel/download/{type}', 'ManageUserController@getUsersExcel');

Route::post('/product-store/excel/download/{type}', 'StocksController@getStoresExcel');
Route::post('/product-store/{id}/excel/download/{type}', 'StocksController@getStoresExcel');

Route::post('/product-categories/excel/download/{type}', 'CategoriesController@getCategoryExcel');

Route::post('/manage-roles/excel/download-AllRoles/{type}', 'RolesController@getAllRolesExcel');

Route::post('/manage-roles/excel/download/{type}', 'RolesController@getRolesExcel');
Route::post('/manage-permissions/excel/download/{type}', 'PermissionController@getpermissionsExcel');
Route::post('/manage-products/excel/download/{type}', 'ManageProductsController@getProductsExcel');
Route::post('/manage-products/{id}/excel/download/{type}', 'ManageProductsController@getProductsExcel');


Route::post('/manage-prices/excel/download/{type}', 'ManagePricesController@getPriceExcel');
Route::post('/manage-prices/{id}/excel/download/{type}', 'ManagePricesController@getPriceExcel');

});


