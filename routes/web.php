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

Route::get('/','InvoiceController@index');

Route::get('invoices/{invoice}/print','InvoiceController@print')->name('invoices.print');
Route::get('invoices/{invoice}/pdf','InvoiceController@pdf')->name('invoices.pdf');
Route::get('invoices/{invoice}/email','InvoiceController@email')->name('invoices.email');

Route::resource('invoices', 'InvoiceController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
