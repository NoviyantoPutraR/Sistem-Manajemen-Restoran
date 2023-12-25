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
    Route::get('/admin/dashboard', 'AdminController@index')->name('adminDashboard');
});

Route::get('/api/months', 'DropdownController@getMonths');


Route::get('/pembelian', 'PembelianController@index')->name('daftarPembelian');
Route::get('/pemesanan', 'PemesananController@index')->name('daftarPemesanan');
Route::get('/pemesanan/{tbl_pembelian}/delete', 'PemesananController@destroy')->name('deletePemesanan');


Route::get('/user', 'UserController@index')->name('daftarUser');
Route::get('/user/add', 'UserController@create')->name('addUser');
Route::post('/user/add', 'UserController@store')->name('storeUser');

// Menampilkan formulir edit
Route::get('/user/{tbl_users}/edit', 'UserController@edit')->name('editUser');

// Menangani pembaruan pengguna
Route::post('/user/{tbl_users}/edit', 'UserController@update')->name('updateUser');

// Pembatalan edit
Route::get('/user/cancel-edit', 'UserController@cancelEdit')->name('cancelEdit');

// Menangani penghapusan pengguna
Route::get('/user/{tbl_users}/delete', 'UserController@destroy')->name('deleteUser');



Route::get('/pembelian/add', 'PembelianController@create')->name('addPembelian');
Route::post('/pembelian/add', 'PembelianController@store')->name('storePembelian');
Route::get('/pembelian/{tbl_pembelians}/edit', 'PembelianController@edit')->name('editPembelian');
// route untuk menyimpan perubahan jurusan, perhatikan bahwa fungsi routenya adalah post
Route::post('/pembelian/{tbl_pembelians}/edit', 'PembelianController@update')->name('updatePembelian');
Route::get('/pembelian/{tbl_pembelians}/delete', 'PembelianController@destroy')->name('deletePembelian');

Route::middleware(['auth', 'manager'])->group(function () {
    Route::get('/manager/dashboard', 'ManagerController@index')->name('managerDashboard');
});

Route::middleware(['auth', 'employee'])->group(function () {
    Route::get('/employee/dashboard', 'EmployeeController@index')->name('employeeDashboard');
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
    Route::get('/menu', 'MenuController@index')->name('daftarMenu');

    Route::get('/menu/create', 'MenuController@create')->name('createMenu');
    Route::post('/menu/create', 'MenuController@store')->name('storeMenu');
    //route untuk menampilkan view edit Menu
    Route::get('/menu/{menu}/edit', 'MenuController@edit')->name('editMenu');
    //route untuk menyimpan perubahan Menu, perhatikan bahwa fungsi routenya adalah post
    Route::post('/menu/{menu}/edit', 'MenuController@update')->name('updateMenu');
    //route untuk menghapus menu
    Route::get('menu/{menu}/delete', 'MenuController@destroy')->name('deleteMenu');
});

//meja
Route::get('/meja', 'MejaController@index')->name('daftarMeja');
// monitor
Route::get('/mejam', 'MejaController@indexM')->name('daftarMejam');
Route::post('/mejam/{meja}/update', 'MejaController@updateM')->name('updateMejam');
// monitor
Route::get('/meja/create', 'MejaController@create')->name('createMeja');
Route::post('/meja/create', 'MejaController@store')->name('storeMeja');
//route untuk menampilkan view edit 
Route::get('/meja/{meja}/edit', 'MejaController@edit')->name('editMeja');
//route untuk menyimpan perubahan , perhatikan bahwa fungsi routenya adalah post
Route::post('/meja/{meja}/edit', 'MejaController@update')->name('updateMeja');
//route untuk menghapus meja
Route::get('meja/{meja}/delete', 'MejaController@destroy')->name('deleteMeja');

// pengeluaran
Route::get('/pengeluaran', 'PengeluaranController@index')->name('daftarPengeluaran');
Route::get('/laporan', 'PengeluaranController@laporan')->name('laporan');
Route::get('/Pengeluaran/add', 'PengeluaranController@create')->name('addPengeluaran');
Route::post('/Pengeluaran/add', 'PengeluaranController@store')->name('storePengeluaran');
Route::get('/Pengeluaran/{tbl_pengeluarans}/edit', 'PengeluaranController@edit')->name('editPengeluaran');
Route::post('/Pengeluaran/{tbl_pengeluarans}/edit', 'PengeluaranController@update')->name('updatePengeluaran');
Route::get('/Pengeluaran/{tbl_pengeluarans}/delete', 'PengeluaranController@destroy')->name('deletePengeluaran');

// pesanan(Dine In)
Route::get('/pesanan', 'PesananController@index')->name('daftarPesanan');
Route::get('/pesanan/pembayaran', 'PesananController@pembayaran')->name('pembayaranPesanan');
Route::post('/Pesanan/{pesanan}/update', 'PesananController@pembayaranupdate')->name('updatePembayaran');
Route::get('/Pesanan/create', 'PesananController@create')->name('createPesanan');
Route::post('/Pesanan/create', 'PesananController@store')->name('storePesanan');
Route::get('/Pesanan/{pesanan}/edit', 'PesananController@edit')->name('editPesanan');
Route::post('/Pesanan/{pesanan}/update', 'PesananController@update')->name('updatePesanan');
Route::get('/Pesanan/{pesanan}/delete', 'PesananController@destroy')->name('deletePesanan');


//Meja
Route::get('/menotoring', 'MenotoringController@index')->name('daftarMenotoring');
Route::post('/menotoring/{tbl_mejas}/edit', 'MejaController@update2')->name('updateMenotoring');
