<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function ()
{
    return view('app');
});
/*
 | --------------------------------------------------------------
 | Routes for module client CRUD - RESTFUL
 | --------------------------------------------------------------
 | GET to list all client
 | GET to get data of the a specific client
 | POST to create a new client
 | PUT to update a client exists
 | DELETE to remove a client exists
 */
Route::group(['prefix' => 'client', 'middleware' => ['auth','permission:client']], function()
{
    Route::get('', 'ClientController@index');
    Route::post('', 'ClientController@create');
    Route::get('{client}', 'ClientController@loadId');
    Route::put('{client}', 'ClientController@update');
    Route::delete('{client}', 'ClientController@destroy');
});
/*
 | --------------------------------------------------------------
 | Routes for module company CRUD
 | --------------------------------------------------------------
 | GET to list all company
 | DELETE to remove a company exists
 | POST to create a new company
 | PUT to update a company exists
 | DELETE to remove a company exists
 */
Route::group(['prefix' => 'company', 'middleware' => ['auth', 'permission:company']], function()
{
    Route::get('', 'CompanyController@index');
    Route::post('', 'CompanyController@create');
    Route::get('{company}', 'CompanyController@loadId');
    Route::put('{company}', 'CompanyController@update');
    Route::delete('{company}', 'CompanyController@destroy');
});
/*
 | --------------------------------------------------------------
 | Routes for module deliveryman CRUD
 | --------------------------------------------------------------
 | GET to list all deliveryman
 | DELETE to remove a deliveryman exists
 | POST to create a new deliveryman
 | PUT to update a deliveryman exists
 | DELETE to remove a deliveryman exists
 */
Route::group(['prefix' => 'deliveryman', 'middleware' => ['auth', 'permission:deliveryman']], function()
{
    Route::get('', 'DeliverymanController@index');
    Route::post('', 'DeliverymanController@create');
    Route::get('{deliveryman}', 'DeliverymanController@loadId');
    Route::put('{deliveryman}', 'DeliverymanController@update');
    Route::delete('{deliveryman}', 'DeliverymanController@destroy');
});
/*
 | --------------------------------------------------------------
 | Routes for module product CRUD
 | --------------------------------------------------------------
 | GET to list all product
 | DELETE to remove a product exists
 | POST to create a new product
 | PUT to update a product exists
 | DELETE to remove a product exists
 */
Route::group(['prefix' => 'product', 'middleware' => ['auth', 'permission:product']], function()
{
    Route::get('', 'ProductController@index');
    Route::post('', 'ProductController@create');
    Route::get('{product}', 'ProductController@loadId');
    Route::put('{product}', 'ProductController@update');
    Route::delete('{product}', 'ProductController@destroy');
});
/*
 | --------------------------------------------------------------
 | Routes for module request CRUD
 | --------------------------------------------------------------
 | GET to list all request
 | DELETE to remove a request exists
 | POST to create a new request
 | PUT to update a request exists
 | DELETE to remove a request exists
 */
Route::group(['prefix' => 'request', 'middleware' => ['auth', 'permission:request']], function()
{
    Route::get('', 'RequestController@index');
    Route::get('{request}', 'RequestController@loadId');
    Route::post('', 'RequestController@create');
    Route::put('/{request}', 'RequestController@update');
    Route::delete('/{request}', 'RequestController@destroy');
});

/*
 | --------------------------------------------------------------
 | Routes for module request CRUD
 | --------------------------------------------------------------
 | GET to list all request
 | DELETE to remove a request exists
 | POST to create a new request
 | PUT to update a request exists
 | DELETE to remove a request exists
 */
Route::group(['prefix' => 'user', 'middleware' => ['auth', 'permission:user']], function()
{
    Route::get('', 'UserController@index');
    Route::get('{user}', 'UserController@loadId');
    Route::put('{user}', 'UserController@update');
    Route::delete('{user}', 'UserController@destroy');
});
/*
 | --------------------------------------------------------------
 | API Request
 | --------------------------------------------------------------
 |
 */
Route::group(['prefix' => 'api'], function()
{
    Route::get('company/active', 'CompanyController@active');
    Route::get('product/active', 'ProductController@active');
    Route::get('client/active', 'ClientController@active');
    Route::get('deliveryman/active', 'DeliverymanController@active');
    Route::get('corporateRegister/active', 'CorporateRegisterController@active');

    Route::get('request/productInfo', 'RequestController@productInfo');
    Route::get('request/recent', 'RequestController@recent');

    Route::get('getPermission', 'UserController@getPermission');
    Route::get('getEmployees', 'UserController@getEmployees');
});
/*
 | -----------------------------------------------------------
 | Authentication routes...
 | -----------------------------------------------------------
 |
 */
Route::post('user', 'UserController@save');
Route::get('signin', 'Auth\AuthController@getLogin');
Route::post('signin', [ 'middleware' => 'check.login:signin', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('logout', ['middleware' =>'auth', 'uses'=> 'Auth\AuthController@getLogout']);
/*
 | ---------------------------------------------------------------
 | Password reset link request routes and Password reset routes
 | ---------------------------------------------------------------
 |
 */
Route::group(['prefix' => 'password'], function(){
    if( !(Auth::check()) )
    {
        Route::get('email', 'Auth\PasswordController@getEmail');
        Route::post('email', ['middleware' => 'check.login:password/email', 'uses' => 'Auth\PasswordController@postEmail']);
        Route::get('reset/{token}', 'Auth\PasswordController@getReset');
        Route::post('reset', 'Auth\PasswordController@postReset');
    }
});