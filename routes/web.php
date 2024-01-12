<?php

use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PhotoController;
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

    // config([' app.timezone' => 'cairo' ]);
    // $appZone = config('app.timezone');
    $appName = config('app.name');
    $environment = App::environment();

    // Artisan::call('users:create --name="Hussein" --email="hts07@gmil.com" --password="123')

    // return view('auth.login', ['appName'=>'appName', 'envApp'=>'environment']);
    return view('auth.login', compact('appName', 'environment'));
    // return view('auth.login', get_defined_vars());
});

Auth::routes();

//Auth::routes(['register' => false]);
Route::group(['middleware' => ['auth']], function () {

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

    Route::get('/status_show/{id}', 'InvoicesController@show')->name('status_show');

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
});


Route::get('/photos', [PhotoController::class, 'index']);
Route::post('/photo/store', [PhotoController::class, 'store'])->name('photos.store');;
// Route::resource('photos', PhotoController::class);
// Route::get('/photo', 'PhotoController@index');
// Route::get('/photo/store', 'PhotoController@store')->name('photo.store');


//Route::get('/{page}', 'AdminController@index');

/* Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/all_user', [UserController::class, 'index']);
    Route::get('/user_role', [UserController::class, 'role']);
}); */

/* Route::prefix('admin')->name('admin.')->controller(AdminController::class)->group(function () {
    Route::get('/all_users', 'index')->name('users);
    Route::get('/user_role', 'role')->name('role');
}); */

/* Route::controller(UserController::class)->middleware(['auth', 'admin'])->group(function () {
    Route::get('/all_users', 'index');
    Route::get('/user_role', 'role');
}); */

/* Route::group(['middleware' => ['auth']], function () {
    // your routes
}); */

/* Route::get('profile', function () {
    // Only authenticated users may enter...
})->middleware('auth'); */

// Route::get('/users',[UserController::class,'index']);

/* Route::get('/user/{id}', function ($id) {
    return 'This is the user number: ' . $id;
}); */

/* Route::get('/user2/{id}', function ($id) {
    return 'This is the user number: ' . $id;
})->where('id', '[1-9]+')->name('user_test'); */

/* // Or use:
    Route::pattern('id', '[1-9]+'); // in RouteServiceProvider
*/

/* Route::get('/user/{id?}', function ($id = 0) {
    return 'This is the user number: ' . $id;
}); */

// Route::view('/login2', 'auth.login', ['appName' => $appName]);

/* Route::fallback(function () {
    return 'this is error';
}); */
