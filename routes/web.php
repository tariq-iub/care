<?php

use App\Http\Controllers\DataFileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('/users', UserController::class);
Route::get('/users/profile', [UserController::class, 'profile'])->name('users.profile');

Route::resource('/menus', MenuController::class);
Route::resource('/roles', RoleController::class);

Route::controller(DataFileController::class)
    ->as('data.')
    ->group(function () {
        Route::get('/data', 'index')->name('index');
        Route::post('/data/store', 'store')->name('store');
        Route::delete('/data/{data_file}', 'destroy')->name('delete');
        Route::get('/data/{data_file}/download', 'edit')->name('download');
    });
