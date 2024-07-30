<?php

use App\Http\Controllers\DataCollectionSetupController;
use App\Http\Controllers\DataFileController;
use App\Http\Controllers\FactoryController;
use App\Http\Controllers\ServiceRepresentativeController;
use App\Http\Controllers\SiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/data/upload', [DataFileController::class, 'upload'])->name('upload');
Route::post('/data/edit', [DataFileController::class, 'edit'])->name('edit');
Route::post('/data/replace', [DataFileController::class, 'replace'])->name('replace');
Route::get('/factories', [FactoryController::class, 'fetch']);
Route::get('/sites', [SiteController::class, 'fetch']);

Route::post('/admin/data-setup/general', [DataCollectionSetupController::class, 'saveGeneralData'])->name('api.data-setup.general');
Route::post('/admin/data-setup/measurement', [DataCollectionSetupController::class, 'saveMeasurementData'])->name('api.data-setup.measurement');
Route::post('/admin/data-setup/demodulation', [DataCollectionSetupController::class, 'saveDemodulationData'])->name('api.data-setup.demodulation');

Route::put('/admin/data-setup/general/{id}', [DataCollectionSetupController::class, 'updateGeneralData'])->name('api.data-setup.general.update');
Route::put('/admin/data-setup/measurement/{id}', [DataCollectionSetupController::class, 'updateMeasurementData'])->name('api.data-setup.measurement.update');
Route::put('/admin/data-setup/demodulation/{id}', [DataCollectionSetupController::class, 'updateDemodulationData'])->name('api.data-setup.demodulation.update');

Route::get('admin/data-setup/{id}/details', [DataCollectionSetupController::class, 'getSetupDetails'])->name('api.data-setup.details');

Route::get('/get-units/{key}', function ($key) {
    return response()->json(['units' => getUnits($key)]);
});

Route::post('/check-email/{email}', [ServiceRepresentativeController::class, 'checkEmail']);
