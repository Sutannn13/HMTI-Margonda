<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\OrganizationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public / Guest Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [GuestController::class, 'home'])->name('home');
Route::get('/struktur-organisasi', [GuestController::class, 'structure'])->name('guest.structure');
Route::post('/kolaborasi', [GuestController::class, 'collab'])->name('guest.collab');

/*
|--------------------------------------------------------------------------
| Auth Routes (guest only)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

/*
|--------------------------------------------------------------------------
| Admin Routes (authenticated + admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Organization Management
    Route::get('/organization', [OrganizationController::class, 'index'])->name('organization.index');
    Route::get('/organization/create', [OrganizationController::class, 'create'])->name('organization.create');
    Route::post('/organization', [OrganizationController::class, 'store'])->name('organization.store');
    Route::get('/organization/{member}/edit', [OrganizationController::class, 'edit'])->name('organization.edit');
    Route::put('/organization/{member}', [OrganizationController::class, 'update'])->name('organization.update');
    Route::delete('/organization/{member}', [OrganizationController::class, 'destroy'])->name('organization.destroy');

    // Kas Management
    Route::get('/kas', [KasController::class, 'index'])->name('kas.index');
    Route::post('/kas/{payment}/paid', [KasController::class, 'markPaid'])->name('kas.mark-paid');
    Route::post('/kas/{payment}/unpaid', [KasController::class, 'markUnpaid'])->name('kas.mark-unpaid');
    Route::put('/kas/{payment}/notes', [KasController::class, 'updateNotes'])->name('kas.update-notes');
    Route::post('/kas/disposition', [KasController::class, 'updateDisposition'])->name('kas.disposition');
    Route::get('/kas/report', [KasController::class, 'report'])->name('kas.report');
});
