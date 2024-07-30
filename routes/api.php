<?php

use App\Http\Controllers\DataFileController;
use App\Http\Controllers\FactoryController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\CompanyController;
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
Route::get('/factories', [FactoryController::class, 'fetch']);
Route::get('/sites', [SiteController::class, 'fetch']);


Route::post('/plant-setup/save-company-info', [CompanyController::class, 'saveCompanyInfo']);
Route::post('/plant-setup/save-plant-info', [PlantController::class, 'savePlantInfo']);
Route::post('/plant-setup/save-note', [NoteController::class, 'saveNotesPictures']);
Route::post('/plant-setup/save-service-representative', [ServiceRepresentativeController::class, 'saveServiceRepresentative']);

Route::post('/plant-setup/update-company-info', [CompanyController::class, 'updateCompanyInfo']);
Route::post('/plant-setup/update-plant-info', [PlantController::class, 'updatePlantInfo']);
Route::post('/plant-setup/update-note', [NoteController::class, 'updateNotesPictures']);
Route::post('/plant-setup/update-service-representative', [ServiceRepresentativeController::class, 'updateServiceRepresentative']);


Route::get('/plant-setup/fetch-plants/{id}', [PlantController::class, 'showPlants']);

Route::get('/plant-setup/fetch-service-representative/{id}', [ServiceRepresentativeController::class, 'fetchServiceRepresentative']);
Route::get('/plant-setup/fetch-plant-service-rep/{id}', [ServiceRepresentativeController::class, 'fetchPlantServiceRepresentative']);
Route::post('/plant-setup/link-service-rep', [ServiceRepresentativeController::class, 'linkServiceRepresentative']);
