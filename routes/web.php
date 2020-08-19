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
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/logout', function () {
   return view('auth.login');
});


Route::get('/contacto','contactoController@index')->name('contacto');

Route::post('/contacto/send','contactoController@sendContactUser')->name('contacto.send');


Route::get('/contacto/admin','contactAdminController@index')->name('contacto.admin');
Route::get('/contacto/admin/pdf','contactAdminController@pdf')->name('contacto.admin.pdf');
Route::get('/contacto/admin/xls','contactAdminController@xls')->name('contacto.admin.xls');
Route::get('/contacto/admin/totals','contactAdminController@totals')->name('contacto.admin.totals');
