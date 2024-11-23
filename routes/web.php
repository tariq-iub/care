<?php

use App\Http\Controllers\Auth\SetPasswordController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DataFileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\FactoryController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\MidSetupController;
use App\Http\Controllers\NewMidController;
use App\Http\Controllers\PricingPlansController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\SensorDataController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\ServiceRepresentativeController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRegistrationController;
use Illuminate\Support\Facades\Auth;
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

Route::resource('sites', SiteController::class);


Route::get('/', function () {
    return view('welcome');
});

// Route for custom redirection after registration
Route::get('/user_registered', function () {
    return view('auth.user_registered'); // Replace with the actual view you want to show
})->name('auth.user_registered');

// Route for pricing plans view, since anyone can view pricing, it's not protected by any middleware.
Route::get('/pricing-plans', [PricingPlansController::class, 'showPricingPlans'])->name('pricing.plans');

Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');

Route::post('/subscribe', [SubscriptionController::class, 'createSubscription'])->name('subscribe');
Route::post('/subscription/cancel', [SubscriptionController::class, 'cancelSubscription'])->name('subscription.cancel');
Route::post('/subscription/resume', [SubscriptionController::class, 'resumeSubscription'])->name('subscription.resume');
Route::post('/subscription/swap', [SubscriptionController::class, 'swapSubscription'])->name('subscription.swap');
Route::get('/subscription/status', [SubscriptionController::class, 'getSubscriptionStatus'])->name('subscription.status');

Auth::routes(['verify' => true]);

Route::get('/enter-new-password', [SetPasswordController::class, 'showSetPasswordForm'])
    ->name('show.new.password.form');
Route::post('/update-new-password', [SetPasswordController::class, 'setPassword'])
    ->name('update.new.password')->middleware(['guest']);

Route::get('/fft', function () {
    return view('fft-graph');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('/users', UserController::class);
    Route::get('/users/profile', [UserController::class, 'profile'])->name('users.profile');
    Route::get('/users/status/{user}', [UserController::class, 'statusToggle'])->name('users.status');
    Route::resource('/menus', MenuController::class)->except(['show']);
    Route::put('/menus/status/{menu}', [MenuController::class, 'statusToggle'])->name('menus.toggle');

    Route::resource('/roles', RoleController::class)->except(['show']);
    Route::post('/roles/role_menu_attachment', [RoleController::class, 'roleMenuAttachment'])->name('roles.role_menu_attachment');
    Route::post('/roles/role_menu_detachment', [RoleController::class, 'roleMenuDetachment'])->name('roles.role_menu_detachment');

    Route::resource('/users', UserController::class)->except(['show']);
    Route::put('/users/status/{user}', [UserController::class, 'statusToggle'])->name('users.status');
    Route::get('/users/profile/{user}', [UserController::class, 'profile'])->name('users.profile');

    Route::resource('/user_register', UserRegistrationController::class);
    Route::resource('/company', CompanyController::class)->except(['destroy', 'update', 'store']);
    Route::resource('/roles', RoleController::class)->except(['create', 'show']);
    Route::resource('/factories', FactoryController::class)->except(['show']);
    Route::resource('/sites', SiteController::class);
    Route::resource('/inspections', InspectionController::class);
    Route::resource('/sensor_data', SensorDataController::class);
    Route::resource('/service-reps', ServiceRepresentativeController::class);
    Route::resource('/question', QuestionController::class)->except(['show']);
    Route::resource('/mid-setups', MidSetupController::class)->except(['store', 'update']);
    Route::resource('/machines', MachineController::class);
    Route::resource('/new-mid', NewMidController::class)->except(['show', 'edit', 'update', 'destroy']);

    Route::resource('/devices', DeviceController::class, ['only' => ['index', 'show']])->names([
        'index' => 'devices.index'
    ]);

    Route::controller(DataFileController::class)
        ->as('data.')
        ->group(function () {
            Route::get('/data', 'index')->name('index');
            Route::get('/data/{data_file}/edit', 'edit')->name('edit');
            Route::put('/data/{data_file}', 'update')->name('update');
            Route::delete('/data/{data_file}', 'destroy')->name('delete');
            Route::get('/data/download/{data_file}', 'download')->name('download');
            Route::get('/data/files', 'getData')->name('data');
        });

    Route::get('/data-setup', [DataCollectionSetupController::class, 'index'])->name('setup.index');
    Route::get('/data-setup/create', [DataCollectionSetupController::class, 'create'])->name('setup.create');
    Route::get('/data-setup/{data_collection_setup}/edit', [DataCollectionSetupController::class, 'edit'])->name('setup.edit');
    Route::get('/data-setup/{data_collection_setup}/show', [DataCollectionSetupController::class, 'show'])->name('setup.show');
    Route::post('/data-setup/complete', [DataCollectionSetupController::class, 'complete'])->name('setup.complete');

    Route::get('/plant/{company}', [PlantController::class, 'index'])->name('plant.index');
    Route::get('/plant/create-plant/{id}', [PlantController::class, 'create'])->name('plant.create');
    Route::get('/plant/{plant}/edit-plant', [PlantController::class, 'edit'])->name('plant.edit');

    Route::post('/client/update-responder', [UserRegistrationController::class, 'updateResponderId']);
    Route::post('/client/update-remarks', [UserRegistrationController::class, 'updateRemarks']);
    Route::post('/client/create-user', [UserRegistrationController::class, 'createClient']);
    Route::post('/client/create-company', [UserRegistrationController::class, 'createCompany']);
    Route::post('/client/email-client', [UserRegistrationController::class, 'emailClient']);

    Route::get('/area/create', [AreaController::class, 'create'])->name('area.create');

    Route::get('/company/manage-users/{id}', [CompanyController::class, 'manageUsersIndex'])->name('company.manage_users');
    Route::post('/company/create-users', [CompanyController::class, 'storeUser'])->name('company.store_user');
    Route::put('/company/status/{user}', [CompanyController::class, 'statusToggle'])->name('company_users.status');
});

Route::resource('/sensor_data', SensorDataController::class);
Route::post('/sensor_data/generate_plot', [SensorDataController::class, 'generatePlot'])->name('sensor_data.generate_plot');
Route::post('/sensor-data/generate-time-domain-plot', [SensorDataController::class, 'generateTimeDomainPlot'])->name('sensor_data.generate_time_domain_plot');
Route::post('/sensor-data/generate-frequency-domain-plot', [SensorDataController::class, 'generateFrequencyDomainPlot'])->name('sensor_data.generate_frequency_domain_plot');
