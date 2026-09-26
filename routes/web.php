<?php
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FindingController;
use App\Http\Controllers\FindingPhotoController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\MaintenanceRecordController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TowerController;
use App\Http\Controllers\WorkOrderController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Sites
|--------------------------------------------------------------------------
*/

Route::get(
    '/sites',
    [SiteController::class, 'index']
)->name('sites.index');

Route::get(
    '/sites/create',
    [SiteController::class, 'create']
)->name('sites.create');

Route::post(
    '/sites',
    [SiteController::class, 'store']
)->name('sites.store');

Route::get(
    '/sites/{site}/edit',
    [SiteController::class, 'edit']
)->name('sites.edit');

Route::put(
    '/sites/{site}',
    [SiteController::class, 'update']
)->name('sites.update');

/*
|--------------------------------------------------------------------------
| Towers
|--------------------------------------------------------------------------
*/

Route::get(
    '/towers',
    [TowerController::class, 'index']
)->name('towers.index');

Route::get(
    '/towers/create',
    [TowerController::class, 'create']
)->name('towers.create');

Route::post(
    '/towers',
    [TowerController::class, 'store']
)->name('towers.store');

Route::get(
    '/towers/{tower}/edit',
    [TowerController::class, 'edit']
)->name('towers.edit');

Route::put(
    '/towers/{tower}',
    [TowerController::class, 'update']
)->name('towers.update');

/*
|--------------------------------------------------------------------------
| Assets
|--------------------------------------------------------------------------
*/

Route::get(
    '/assets',
    [AssetController::class, 'index']
)->name('assets.index');

Route::get(
    '/assets/create',
    [AssetController::class, 'create']
)->name('assets.create');

Route::post(
    '/assets',
    [AssetController::class, 'store']
)->name('assets.store');

Route::get(
    '/assets/{asset}/edit',
    [AssetController::class, 'edit']
)->name('assets.edit');

Route::put(
    '/assets/{asset}',
    [AssetController::class, 'update']
)->name('assets.update');

/*
|--------------------------------------------------------------------------
| Inspections
|--------------------------------------------------------------------------
*/

Route::get(
    '/inspections/create',
    [InspectionController::class, 'create']
)->name('inspections.create');

Route::post(
    '/inspections',
    [InspectionController::class, 'store']
)->name('inspections.store');

Route::get(
    '/inspections/history',
    [InspectionController::class, 'index']
)->name('inspections.index');

Route::get(
    '/inspections/{inspection}',
    [InspectionController::class, 'show']
)->name('inspections.show');

Route::put(
    '/inspections/{inspection}/results',
    [InspectionController::class, 'updateResults']
)->name('inspections.results.update');

Route::post(
    '/inspections/{inspection}/photos',
    [InspectionController::class, 'uploadPhotos']
)->name('inspections.photos.upload');

Route::delete(
    '/inspections/{inspection}/photos/{photo}',
    [InspectionController::class, 'destroyPhoto']
)->name('inspections.photos.destroy');

Route::put(
    '/inspections/{inspection}/complete',
    [InspectionController::class, 'complete']
)->name('inspections.complete');

Route::get(
    '/inspections/{inspection}/pdf',
    [ReportController::class, 'inspection']
)->name('inspections.pdf');

/*
|--------------------------------------------------------------------------
| Findings
|--------------------------------------------------------------------------
*/

Route::get(
    '/findings',
    [FindingController::class, 'index']
)->name('findings.index');

Route::get(
    '/findings/{finding}',
    [FindingController::class, 'show']
)->name('findings.show');

Route::put(
    '/findings/{finding}/status',
    [FindingController::class, 'updateStatus']
)->name('findings.status.update');

Route::post(
    '/findings/{finding}/photos',
    [FindingPhotoController::class, 'store']
)->name('findings.photos.store');

Route::delete(
    '/findings/{finding}/photos/{photo}',
    [FindingPhotoController::class, 'destroy']
)->name('findings.photos.destroy');

/*
|--------------------------------------------------------------------------
| Work Orders
|--------------------------------------------------------------------------
*/

Route::get(
    '/findings/{finding}/work-order/create',
    [WorkOrderController::class, 'create']
)->name('work-orders.create');

Route::post(
    '/findings/{finding}/work-order',
    [WorkOrderController::class, 'store']
)->name('work-orders.store');

Route::get(
    '/work-orders',
    [WorkOrderController::class, 'index']
)->name('work-orders.index');

Route::get(
    '/work-orders/{workOrder}',
    [WorkOrderController::class, 'show']
)->name('work-orders.show');

Route::put(
    '/work-orders/{workOrder}/status',
    [WorkOrderController::class, 'updateStatus']
)->name('work-orders.status.update');

/*
|--------------------------------------------------------------------------
| Maintenance
|--------------------------------------------------------------------------
*/

Route::get(
    '/maintenance',
    [MaintenanceRecordController::class, 'index']
)->name('maintenance.index');

Route::get(
    '/work-orders/{workOrder}/maintenance/create',
    [MaintenanceRecordController::class, 'create']
)->name('maintenance.create');

Route::post(
    '/work-orders/{workOrder}/maintenance',
    [MaintenanceRecordController::class, 'store']
)->name('maintenance.store');

/*
|--------------------------------------------------------------------------
| Users
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get(
        '/users',
        [UserController::class, 'index']
    )->name('users.index');

    Route::get(
        '/users/create',
        [UserController::class, 'create']
    )->name('users.create');

    Route::post(
        '/users',
        [UserController::class, 'store']
    )->name('users.store');

    Route::get(
        '/users/{user}/edit',
        [UserController::class, 'edit']
    )->name('users.edit');

    Route::put(
        '/users/{user}',
        [UserController::class, 'update']
    )->name('users.update');

    Route::get(
        '/users/change-password',
        [UserController::class, 'changePassword']
    )->name('users.change-password');

    Route::put(
        '/users/change-password',
        [UserController::class, 'updatePassword']
    )->name('users.update-password');

    Route::get(
        '/users/{user}/reset-password',
        [UserController::class, 'resetPasswordForm']
    )->name('users.reset-password');

    Route::put(
        '/users/{user}/reset-password',
        [UserController::class, 'resetPassword']
    )->name('users.reset-password.update');
    });
   /*
|--------------------------------------------------------------------------
| Checklists
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get(
        '/checklists',
        [ChecklistController::class, 'index']
    )->name('checklists.index');

    Route::get(
        '/checklists/create',
        [ChecklistController::class, 'create']
    )->name('checklists.create');

    Route::post(
        '/checklists',
        [ChecklistController::class, 'store']
    )->name('checklists.store');

    Route::get(
        '/checklists/{checklist}/edit',
        [ChecklistController::class, 'edit']
    )->name('checklists.edit');

    Route::put(
        '/checklists/{checklist}',
        [ChecklistController::class, 'update']
    )->name('checklists.update');
});