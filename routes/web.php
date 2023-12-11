<?php

use Illuminate\Support\Facades\Route; // Pastikan mengimpor Route
use Illuminate\Support\Facades\Auth; // Pastikan mengimpor Auth

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
    return redirect(route('login'));
});
Route::get('/starter', function () {
    return view('starter');
});

// Auth::routes(['verify' => false, 'reset' => false]);


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('adminDashboard');
});



Route::get('/admin/pemesanan', 'PemesananController@index')->name('daftarPemesanan');
Route::get('/admin/pemesanan/{tbl_pembelian}/delete', 'PemesananController@destroy')->name('deletePemesanan');


Route::get('/admin/user', 'UserController@index')->name('daftarUser');

Route::get('/admin/pembelian', 'PembelianController@index')->name('daftarPembelian');
Route::get('/admin/pembelian/add', 'PembelianController@create')->name('addPembelian');
Route::post('/admin/pembelian/add', 'PembelianController@store')->name('storePembelian');
Route::get('/admin/pembelian/{id_pembelian}/edit', 'PembelianController@edit')->name('editPembelian');
// route untuk menyimpan perubahan jurusan, perhatikan bahwa fungsi routenya adalah post
Route::post('/admin/pembelian/{id_pembelian}/edit', 'PembelianController@update')->name('updatePembelian');
Route::get('/admin/pembelian/{id_pembelian}/delete', 'PembelianController@destroy')->name('deletePembelian');

Route::middleware(['auth', 'manager'])->group(function () {
    Route::get('/manager/dashboard', function () {
        return view('manager.dashboard');
    })->name('managerDashboard');
});

Route::middleware(['auth', 'employee'])->group(function () {
    Route::get('/employee/dashboard', function () {
        return view('employee.dashboard');
    })->name('employeeDashboard');
});


// Route::group(['middleware' => 'employee'], function () {
//     Route::get('employee.dashboard', 'EmployeeController@dashboard')->name('EmployeeDashboard');
// });

// Route::group(['middleware' => 'manager'], function () {
//     Route::get('manager.dashboard', 'ManagerController@index')->name('ManagerDashboard');
// });

// Route::group(['middleware' => 'admin'], function () {
//     Route::get('admin.dashboard', 'AdminController@index')->name('AdminDashboard');
// });

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware('my-login');

//menu
Route::middleware(['auth'])->group(function () {
Route::get('/admin/menu', 'MenuController@index')->name('daftarMenu');

Route::get('/admin/menu/create', 'MenuController@create')->name('createMenu');
Route::post('/admin/menu/create', 'MenuController@store')->name('storeMenu');
//route untuk menampilkan view edit Menu
Route::get('/admin/menu/{menu}/edit', 'MenuController@edit')->name('editMenu');
//route untuk menyimpan perubahan Menu, perhatikan bahwa fungsi routenya adalah post
Route::post('/admin/menu/{menu}/edit', 'MenuController@update')->name('updateMenu');
//route untuk menghapus menu
Route::get('menu/{menu}/delete', 'MenuController@destroy')->name('deleteMenu');
});