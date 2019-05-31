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

Route::get('lang/{lang}', function ($lang) {
    session(['lang' => $lang]);
    App::setLocale(session('lang', config('app.locale')));
    return \Redirect::back();
})->where(['lang' => 'en|es']);

Route::group(['middleware' => ['lang']], function () {

    /* Routes de Users */
    /*Route::get('/users', 'UserController@index')->name('users.index');
    Route::get('/users/{id}', 'UserController@show')->name('users.show');
    Route::get('/users/{id}/edit', 'UserController@edit')->name('users.edit');
    Route::put('/users/{id}', 'UserController@update')->name('users.update');
    Route::delete('/users/{id}', 'UserController@destroy')->name('users.destroy');*/
    /* Fin de Routes de Users */

    /*Routes de Products*/
    Route::resource('products', 'ProductController');
    Route::post('getProducts', 'ProductController@getProducts')->name('products.getProducts');
    /*Fin de Routes de Products*/

    /*Routes de Roles*/
    Route::resource('roles', 'RoleController');
    Route::post('getUsersWithRoles', 'RoleController@getUsersWithRoles')->name('role.getUsersWithRoles');
    Route::post('getPermissionsOfARol', 'RoleController@getPermissionsOfARol')->name('role.getPermissionsOfARol');
    Route::post('addPermissionToARole', 'RoleController@addPermissionToARole')->name('roles.addPermissionToARole');
    Route::get('assing-roles', 'RoleController@assingARol')->name('roles.assing-roles');
    Route::post('getUsersForAssingRole', 'RoleController@getUsersForAssingRole')->name('roles.getUsersForAssingRole');
    /*Fin de Routes de Roles*/

    /*Routes de Finance*/
    Route::resource('finances', 'FinanceController');
    Route::post('getFinancesForUser', 'FinanceController@getFinancesForUser')->name('finances.getFinancesForUser');
    /*Fin de Routes de Finance*/

    Route::get('/', function () {
        return view('welcome');
    });

    /*Routes Auth*/
    Auth::routes(['verify' => true]);

    Route::get('/home', 'HomeController@index')->name('home');
    /*Fin Routes Auth*/

});
