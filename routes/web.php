<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\DataFileController;
use App\Http\Controllers\FactoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\SensorDataController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\ServiceRepresentativeController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\DataCollectionSetupController;

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

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('/users', UserController::class);
    Route::get('/users/profile', [UserController::class, 'profile'])->name('users.profile');
    Route::put('/users/status/{user}', [UserController::class, 'statusToggle'])->name('users.status');

    Route::resource('/menus', MenuController::class)->except(['show']);
    Route::resource('/roles', RoleController::class)->except(['show']);
    Route::resource('/inspections', InspectionController::class);
    Route::resource('/sensor_data', SensorDataController::class);
    Route::resource('/service-reps', ServiceRepresentativeController::class);
    Route::resource('/company', CompanyController::class)->except(['destroy', 'update', 'store']);

    Route::controller(DataFileController::class)
        ->as('data.')
        ->group(function () {
            Route::get('/data', 'index')->name('index');
            Route::get('/data/{data_file}/edit', 'edit')->name('edit');
            Route::put('/data/{data_file}', 'update')->name('update');
            Route::delete('/data/{data_file}', 'destroy')->name('delete');
            Route::get('/data/download/{data_file}', 'download')->name('download');
        });

    Route::get('/data-setup', [DataCollectionSetupController::class, 'index'])->name('setup.index');
    Route::get('/data-setup/create', [DataCollectionSetupController::class, 'create'])->name('setup.create');
    Route::get('/data-setup/{data_collection_setup}/edit', [DataCollectionSetupController::class, 'edit'])->name('setup.edit');
    Route::get('/data-setup/{data_collection_setup}/show', [DataCollectionSetupController::class, 'show'])->name('setup.show');
    Route::post('/data-setup/complete', [DataCollectionSetupController::class, 'complete'])->name('setup.complete');

    Route::get('/plant/{company}', [PlantController::class, 'index'])->name('plant.index');
    Route::get('/plant/create-plant/{id}', [PlantController::class, 'create'])->name('plant.create');
    Route::get('/plant/{plant}/edit-plant', [PlantController::class, 'edit'])->name('plant.edit');

    Route::get('/area/create', [AreaController::class, 'create'])->name('area.create');

    Route::get('/company/manage-users/{id}', [CompanyController::class, 'manageUsersIndex'])->name('company.manage_users');
    Route::post('/company/create-users', [CompanyController::class, 'storeUser'])->name('company.store_user');
    Route::put('/company/status/{user}', [CompanyController::class, 'statusToggle'])->name('company_users.status');

    Route::get('/mid-setups', function (){
        return view('admin.mid_setup.index');
    });
    Route::get('/mid-setups/create', function (){
        return view('admin.mid_setup.create');
    });
});
