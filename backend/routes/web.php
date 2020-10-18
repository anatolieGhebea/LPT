<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
})->name('app_url');

Route::get('/schemas', [ 'as' =>'schemas.index', 'uses' => 'SchemaController@index']);
Route::get('/schemas/{schema}/edit', [ 'as' => 'schema.edit', 'uses' => 'SchemaController@edit'] );
Route::get('/schemas/{schema}/export', [ 'as' => 'schema.export', 'uses' => 'SchemaController@export'] );

Route::get('/table/{table}/edit', [ 'as' => 'table.edit', 'uses' => 'TableController@edit'] );
