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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

//Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('sections', 'SectionsController');

Route::resource('products', 'ProductsController');

Route::resource('invoices', 'InvoicesController');

Route::get('/section/{id}', 'InvoicesController@getProducts');

Route::resource('invoiceAttachments', 'InvoiceAttachmentsController');

Route::get('/invoice/{id}', 'InvoicesDetailsController@edit');

Route::get('download/{invoice_number}/{file_name}', 'InvoicesDetailsController@get_file');

Route::get('view_file/{invoice_number}/{file_name}', 'InvoicesDetailsController@open_file');

Route::post('delete_file', 'InvoicesDetailsController@destroy')->name('delete_file');

Route::get('/edit_invoice/{id}', 'InvoicesController@edit');

Route::get('/status_show/{id}', 'InvoicesController@show')->name('Status_show');

Route::post('/status_update/{id}', 'InvoicesController@status_update')->name('status_update');

Route::resource('archive', 'InvoiceAchiveController');

Route::get('invoices_paid', 'InvoicesController@invoices_paid');

Route::get('invoices_unpaid', 'InvoicesController@invoices_unpaid');

Route::get('invoices_partial', 'InvoicesController@invoices_partial');

Route::get('print_invoice/{id}', 'InvoicesController@print_invoice');

Route::get('export_invoices', 'InvoicesController@export');

Route::group(['middleware' => ['auth']], function () {

    Route::resource('roles', 'RoleController');

    Route::resource('users', 'UserController');
});

Route::get('invoices_report', 'Invoices_Report@index');

Route::post('search_invoices', 'Invoices_Report@Search_invoices');

Route::get('customers_report', 'Customers_Report@index')->name("customers_report");

Route::post('search_customers', 'Customers_Report@Search_customers');

Route::get('markAsRead_all', 'InvoicesController@MarkAsRead_all')->name('MarkAsRead_all');

Route::get('unreadNotifications_count', 'InvoicesController@unreadNotifications_count')->name('unreadNotifications_count');

Route::get('unreadNotifications', 'InvoicesController@unreadNotifications')->name('unreadNotifications');

Route::get('/{page}', 'AdminController@index');
