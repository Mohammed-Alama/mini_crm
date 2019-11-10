<?php
declare(strict_types=1);

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('companies', 'CompanyController');

Route::post('employees/{company}','EmployeeController@store')->name('employees.store');
Route::get('employees/{company}','EmployeeController@index')->name('employees.index');
Route::get('employees/{company}/create','EmployeeController@create')->name('employees.create');
Route::delete('employees/{company}/{employee}','EmployeeController@destroy')->name('employees.destroy');
Route::put('employees/{company}/{employee}','EmployeeController@update')->name('employees.update');
Route::get('employees/{company}/{employee}','EmployeeController@show')->name('employees.show');
Route::get('employees/{company}/{employee}/edit','EmployeeController@edit')->name('employees.edit');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
