<?php
use Illuminate\Support\Facades\Auth;

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

Route::get('/demo', function () {
    return view('demo', [
        'user' => Auth::user(),
    ]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/setting', 'HomeController@showSet')->name('setting');
Route::post('/setting', 'HomeController@set');
Route::post('/setting/testuser', 'HomeController@setForTestUser');
Route::get('/check/{customer}', 'VisitDataController@check')->name('check');
Route::get('/customer/{customer}/data', 'AppController@data')->name('data');
Route::get('/customer/list', 'AppController@list')->name('customer.list');
Route::get('/customer/list/deleted', 'AppController@deleted')->name('customer.list.deleted');
Route::get('/customer/add', 'AppController@showAdd')->name('customer.add');
Route::post('/customer/add', 'AppController@add');
Route::post('/customer/{customer}/delete', 'AppController@delete')->name(('customer.delete'));
Route::post('/customer/{id}/restore', 'AppController@restore')->name(('customer.restore'));
Route::post('/customer/{id}/forceDelete', 'AppController@forceDelete')->name(('customer.forceDelete'));
Route::get('/customer/{customer}/edit', 'AppController@showEdit')->name('customer.edit');
Route::post('/customer/{customer}/edit', 'AppController@edit');
Route::get('/customer/{customer}', 'AppController@detail')->name('detail');
Route::post('/visitdata/{id}/add', 'VisitDataController@add')->name('visitdata.add');
Route::get('/visitdata/{visitData}/edit', 'VisitDataController@showEdit')->name('visitdata.showEdit');
Route::post('/visitdata/{visitData}/edit', 'VisitDataController@edit')->name('visitdata.edit');
Route::post('/visitdata/{visitData}/delete', 'VisitDataController@delete')->name('visitdata.delete');

