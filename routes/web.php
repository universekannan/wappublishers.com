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

// Route::any('{query}', function() { return view('404'); })->where('query', '.*');

Route::fallback(function () {
    return view("404");
}); 
Route::get('/', function () {
    return view('login');
});


Route::get('/home', 'App\Http\Controllers\AdminController@login');
Route::get('/login', 'App\Http\Controllers\AdminController@login');
Route::post('/checkLogin', 'App\Http\Controllers\AdminController@checkLogin');
Route::get('/logout', 'App\Http\Controllers\AdminController@logout');

Route::get('/not_allowed', 'App\Http\Controllers\CommonController@notAllowed');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@dashboard');
    Route::post('/add_roles', 'App\Http\Controllers\RolesController@addManageRolesAction');
    Route::get('/permissions/{id}', 'App\Http\Controllers\RolesController@managePermissions');
    
    Route::get('/users', 'App\Http\Controllers\UsersController@manageUsers');
    Route::post('/add_user', 'App\Http\Controllers\UsersController@addUser');
    Route::post('/edit_user', 'App\Http\Controllers\UsersController@editUser');
    Route::post('/delete_user', 'App\Http\Controllers\UsersController@deleteUser');
    Route::post('/checkemail', 'App\Http\Controllers\UsersController@checkemail');
    
    Route::get('/users/attendance/{id}', 'App\Http\Controllers\UsersController@usersAttendance');

    Route::get('/users/permissions', 'App\Http\Controllers\PermissionsController@manageusers');
    Route::get('/userrole', 'App\Http\Controllers\PermissionsController@userrole');
    Route::post('/roles', 'App\Http\Controllers\PermissionsController@roles');
    Route::post('/addroles', 'App\Http\Controllers\PermissionsController@addRoles');

    Route::get('/customer', 'App\Http\Controllers\CustomerController@manageCustomers');
    Route::post('/add_customer', 'App\Http\Controllers\CustomerController@addCustomer');
    Route::post('/assignadmin', 'App\Http\Controllers\CustomerController@Assignadmin');
    Route::post('/assignstaff', 'App\Http\Controllers\CustomerController@Assignstaff');
    Route::post('/progress', 'App\Http\Controllers\CustomerController@Progress');


});


