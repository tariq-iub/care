<?php

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
    return view('admin.dashboard');
})->name('dashboard');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/users/profile', [UserController::class, 'profile'])->name('users.profile');
Route::resource('/users', UserController::class);
Route::resource('/menus', MenuController::class);
Route::resource('/roles', RoleController::class);
