<?php

use Illuminate\Support\Facades\Route;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'BerandaController@home')->name('landing');
Route::get('/login', 'HomeController@redirectAdmin')->name('index');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/register', 'BerandaController@register')->name('admin-register');
Route::post('/admin/register/store', 'BerandaController@registerStore')->name('admin-register-store');
Route::post('/generate-snap-token/{id_paket}', 'BerandaController@generateSnapToken')->name('generate-snap-token');
Route::get('/checkout/{id_paket}', 'BerandaController@checkout')->name('checkout');
Route::post('/store-transaction', 'BerandaController@storeTransaction')->name('store-transaction');
Route::get('/sendWhatsAppNotification/{no_wa}/{id_transaksi}', 'BerandaController@sendWhatsAppNotification')->name('sendWhatsAppNotification');
Route::get('/success-payment', 'BerandaController@successPayment')->name('payment-success');
Route::get('/check-auth', function () {
    return response()->json([
        'logged_in' => Auth::guard('admin')->check()
    ]);
});
Route::get('/check-paket', function () {

    if (Auth::guard('admin')->check() != null) {
        $masa_aktif = Auth::guard('admin')->user()->expired_date;
        if(!empty($masa_aktif)){
            if($masa_aktif >= date('Y-m-d')){
                $subs = 'Ya';
            }else{
                $subs = 'Tidak';
            }
        }else{
            $subs = 'Tidak';
        }
    }else{
        $subs = 'Tidak';
    }
    
    return response()->json([
        'is_subs' => $subs
    ]);
});
/**
 * Admin routes
 */
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'Backend\DashboardController@index')->name('admin.dashboard');
    Route::resource('roles', 'Backend\RolesController', ['names' => 'admin.roles']);
    Route::resource('users', 'Backend\UsersController', ['names' => 'admin.users']);
    Route::resource('admins', 'Backend\AdminsController', ['names' => 'admin.admins']);


    Route::group(['prefix' => 'group'], function () {
        Route::get('/', 'Backend\GroupController@index')->name('group');
        Route::get('create', 'Backend\GroupController@create')->name('group.create');
        Route::post('store', 'Backend\GroupController@store')->name('group.store');
        Route::get('edit/{id}', 'Backend\GroupController@edit')->name('group.edit');
        Route::post('update/{id}', 'Backend\GroupController@update')->name('group.update');
        Route::get('destroy/{id}', 'Backend\GroupController@destroy')->name('group.destroy');
    });

    Route::group(['prefix' => 'paket'], function () {
        Route::get('/', 'Backend\PaketController@index')->name('paket');
        Route::get('create', 'Backend\PaketController@create')->name('paket.create');
        Route::post('store', 'Backend\PaketController@store')->name('paket.store');
        Route::get('edit/{id}', 'Backend\PaketController@edit')->name('paket.edit');
        Route::post('update/{id}', 'Backend\PaketController@update')->name('paket.update');
        Route::get('destroy/{id}', 'Backend\PaketController@destroy')->name('paket.destroy');
        Route::get('checkout/{id}', 'Backend\PaketController@checkout')->name('paket.checkout');
        Route::get('payment-success', 'Backend\PaketController@successPage')->name('paket.payment-success');
        Route::get('history', 'Backend\PaketController@history')->name('paket.history');
    });

    // Login Routes
    Route::get('/login', 'Backend\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login/submit', 'Backend\Auth\LoginController@login')->name('admin.login.submit');

    // Logout Routes
    Route::post('/logout/submit', 'Backend\Auth\LoginController@logout')->name('admin.logout.submit');

    // Forget Password Routes
    Route::get('/password/reset', 'Backend\Auth\ForgetPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset/submit', 'Backend\Auth\ForgetPasswordController@reset')->name('admin.password.update');
});
