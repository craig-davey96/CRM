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

Route::get('/', 'DashboardController@index');

/**
 *  --------- SALES ROUTES ---------
 */

Route::get('/sales/proposals', 'SalesController@proposals');
Route::get('/sales/estimates', 'SalesController@estimates');
Route::get('/sales/invoices', 'SalesController@invoices');
Route::get('/sales/items', 'SalesController@items');

Route::get('sales/items/getdata', 'SalesController@itemsDT');

Route::post('sales/items/post', 'SalesController@createItem');

/**
 *  --------- TASKS ROUTES ---------
 */

Route::get('tasks', 'TasksController@index');
Route::post('tasks/updatetype', 'TasksController@updateTaskType');


