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

use App\Model\Task;
use Illuminate\Http\Request;

Route::get('/styleguide', function () {
    return view('styleguide');
});

Route::get('/', function () {
    return redirect()->route('login');
});
////////////// login
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'ProfileController@index')->name('account.profile');
Route::get('/profile/purchases', 'ProfileController@purchases')->name('account.purchases');
Route::get('/data/{id}', 'DataController@details')->name('details');


Auth::routes();




