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

use Illuminate\Support\Facades\DB;
use App\Http\Controllers;
use App\Http\Controllers\Query;
use Illuminate\Support\Facades\Auth;

Route::get('/',function(){
  return view('welcome');
});

Route::get('/admin','AdminController@index');
Route::get('/profile','APIController@profile');
Route::post('/activate','APIController@activate')->name('activate');
Route::get('/trylogin','APIController@tryLogin')->name('login');
Route::get('/add/user','APIController@showUForm');
Route::get('/add/driver','APIController@showDForm');
Route::post('/add/user','APIController@addUser')->name('addUser');
Route::post('/add/driver','APIController@addDriver')->name('addDriver');
Route::get('/delete','APIController@deleteAccount')->name('deleteAccount');
Route::get('/books','APIController@showBooks')->name('books');

Route::get('/settings','SettingsController@index');

Route::get('/settings/change/name','SettingsController@showNameForm');
Route::post('/settings/change/name','SettingsController@changeName')->name('change_name');

Route::get('/settings/change/password','SettingsController@showPasswordForm');
Route::post('/settings/change/password','SettingsController@changePassword')->name('change_password');

Route::get('/settings/change/2fa','SettingsController@show2faForm');
Route::post('/settings/change/2fa','SettingsController@change2fa')->name('change_2fa');
Route::post('/settings/change/complete-enable-2fa','SettingsController@customAddSecretKey')->name('insert_2fa_key');

// sysadmin
Route::get('/sysadmin/settings/{uid?}','SettingsController@index')->middleware('sysadmin');

Route::get('/sysadmin/settings/change/name/{uid?}','SettingsController@showNameForm')->middleware('sysadmin');
Route::post('/sysadmin/settings/change/name/{uid?}','SettingsController@changeName')->name('change_name')->middleware('sysadmin');

Route::get('/sysadmin/settings/change/password/{uid?}','SettingsController@showPasswordForm')->middleware('sysadmin');
Route::post('/sysadmin/settings/change/password/{uid?}','SettingsController@changePassword')->name('change_password')->middleware('sysadmin');

Route::get('/sysadmin/settings/change/2fa/{uid?}','SettingsController@show2faForm')->middleware('sysadmin');
Route::post('/sysadmin/settings/change/2fa/{uid?}','SettingsController@change2fa')->name('change_2fa')->middleware('sysadmin');
Route::post('/sysadmin/settings/change/complete-enable-2fa/{uid?}','SettingsController@customAddSecretKey')->name('insert_2fa_key')->middleware('sysadmin');


Route::get('/tb',function(){
  $query = new Query();
  $tickets = $query->retrieveAll('incident');
  return view('table',['tickets'=> $tickets]);
});

Route::get('/sysadmin','SysAdminController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/complete-registration', 'Auth\RegisterController@completeRegistration');

Route::post('/2fa','Auth\twofactorsController@AuthLogin')->name('2fa')->middleware('2fa');
