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
    return view('login');
});

////////////// login routes
Route::get('', 'MainController@index');
Route::get('/home', 'MainController@index');
Route::post('/main/checklogin', 'MainController@checklogin');
Route::get('main/userindex', 'MainController@userindex');
Route::get('main/logout', 'MainController@logout');
Route::get('/user/index', 'MainController@userindex');

/////////////// Deposit
Route::get('/user/deposit', 'AccountTypeController@deposit'); // show accounttype list in deposit page
Route::post('/transaction/deposit', 'TransactionController@deposit'); //make deposit

/////////////// Withdraw
Route::get('/user/withdraw', 'AccountTypeController@withdraw'); // show accounttype list in withdraw page
Route::post('/transaction/withdraw', 'TransactionController@withdraw'); //make withdraw

/////////////// Transfer
Route::get('/user/transfer', 'AccountTypeController@transfer'); // show accounttypes list in transfer page
Route::post('/transaction/transfer', 'TransactionController@transfer'); //make transfer
Route::post('/transfer/fetch', 'AccountTypeController@fetch')->name('transfer.fetch'); // get dependent select account

