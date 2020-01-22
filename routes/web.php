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

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/error404', function (){
    return view('error404');
})->name('error404');



Route::middleware(['auth','userstate'])->group(function () {

    Route::get('/mobile/app','MobileController@mobilePage')->name('mobile');
    Route::get('/device/gps','DeviceController@GPSPage')->name('device');
    Route::post('/mobile/app','MobileController@getJourneyDetails')->name('getJourney');
    Route::post('/mobile/refresh','MobileController@refresh')->name('refresh');

    Route::post('/device/refresh','DeviceController@refresh')->name('refreshGPS');
    Route::post('/device/gps','DeviceController@getJourneyData')->name('getJourneyGPS');

    Route::middleware(['superuser'])->group(function () {

        Route::get('/admin/add', 'Auth\RegisterController@showAddAdminForm')->name('addAdminPage');
        Route::post('/admin/add', 'Auth\RegisterController@registerAdmin')->name('addAdmin');
        Route::get('/admin/users', 'Auth\AccountController@viewUserForm')->name('viewUserForm');
        Route::get('/admin/users/activate/{inactive_user_id}', 'Auth\AccountController@activateUser')->name('activateUser');
        Route::get('/admin/users/suspend/{active_user_id}', 'Auth\AccountController@suspendUser')->name('suspendUser');

    });

    Route::get('/account/update_pass','Auth\UpdatePassController@getUpdatePasswordForm')->name('updatePasswordForm');
    Route::post('/account/update_pass','Auth\UpdatePassController@updatePassword')->name('updatePassword');

    Route::get('/account/update_account','Auth\UpdateAccountController@getUpdateAccountForm')->name('updateAccountForm');
    Route::post('/account/update_account','Auth\UpdateAccountController@updateAccount')->name('updateAccount');
});
