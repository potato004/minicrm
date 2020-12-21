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

Route::get('/', 'HomeController@index')->name('home');

Route::prefix('company')->group(function() {
    Route::get('/', 'CompanyController@index');
    Route::get('/create', 'CompanyController@create');
    Route::get('/{id}', 'CompanyController@show');
    Route::get('/edit/{id}', 'CompanyController@edit');

    Route::post('/create', 'CompanyController@store');
    Route::post('/edit/{id}', 'CompanyController@update');
    Route::get('/delete/{id}','CompanyController@disable');
});

Route::prefix('employee')->group(function() {
    Route::get('/', 'EmployeeController@index');
    Route::get('/create', 'EmployeeController@create');
    Route::get('/{id}', 'EmployeeController@show');
    Route::get('/edit/{id}', 'EmployeeController@edit');

    Route::post('/create', 'EmployeeController@store');
    Route::post('/edit/{id}', 'EmployeeController@update');
    Route::get('/delete/{id}','EmployeeController@disable');
});

Auth::routes(['register' => false, 'reset' => false]);
