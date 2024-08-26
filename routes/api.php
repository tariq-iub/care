<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\DataCollectionSetupController;
use App\Http\Controllers\DataFileController;
use App\Http\Controllers\FactoryController;
use App\Http\Controllers\MidSetupController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ServiceRepresentativeController;
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

Route::post('/company/save-company-info', [CompanyController::class, 'saveCompanyInfo']);
Route::post('/plant/save-plant-info', [PlantController::class, 'savePlantInfo']);
Route::post('/note/save-note', [NoteController::class, 'saveNotesPictures']);
Route::post('/service-rep/save-service-representative', [ServiceRepresentativeController::class, 'saveServiceRepresentative']);

Route::post('/company/update-company-info', [CompanyController::class, 'updateCompanyInfo']);
Route::post('/plant/update-plant-info', [PlantController::class, 'updatePlantInfo']);
Route::post('/note/update-note', [NoteController::class, 'updateNotesPictures']);
Route::post('/service-rep/update-service-representative', [ServiceRepresentativeController::class, 'updateServiceRepresentative']);

Route::get('/company/fetch-company/{id}', [CompanyController::class, 'fetchCompanies']);
Route::get('/company/users/{id}', [CompanyController::class, 'fetchUser']);
Route::post('/company/update-user', [CompanyController::class, 'updateUser'])->name('company.update_user');

Route::post('/area/store', [AreaController::class, 'store']);
Route::post('/area/update', [AreaController::class, 'update']);
Route::get('/area/fetch-area/{id}', [AreaController::class, 'fetch']);

Route::get('/plant/fetch-plants/{id}', [PlantController::class, 'showPlants']);
Route::get('/plant/fetch-plant/{id}', [PlantController::class, 'showPlant']);

Route::get('/service-rep/fetch-service-representative/{id}', [ServiceRepresentativeController::class, 'fetchServiceRepresentative']);
Route::get('/plant/fetch-plant-service-rep/{id}', [ServiceRepresentativeController::class, 'fetchPlantServiceRepresentative']);
Route::post('/service-rep/link-service-rep', [ServiceRepresentativeController::class, 'linkServiceRepresentative']);

Route::get('/questions/fetch-question/{id}', [QuestionController::class, 'fetchQuestion']);

Route::post('/mid-setup/save', [MidSetupController::class, 'saveMidSetup']);
Route::post('/mid-setup/update/{id}', [MidSetupController::class, 'updateMidSetup']);
