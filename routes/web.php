<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CollaborationController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\OrganizationController;
use App\Models\CollaborationRequest;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public / Guest Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [GuestController::class, 'home'])->name('home');
Route::get('/struktur-organisasi', [GuestController::class, 'structure'])->name('guest.structure');
Route::post('/kolaborasi', [GuestController::class, 'collab'])->name('guest.collab');

// API: check collaboration status by email
Route::get('/api/collab-status', function (\Illuminate\Http\Request $request) {
    $email = $request->query('email');
    if (!$email) {
        return response()->json(['found' => false]);
    }
    $collab = CollaborationRequest::where('email', $email)->latest()->first();
    if (!$collab) {
        return response()->json(['found' => false]);
    }
    $statusLabels = [
        'pending' => 'Menunggu ditinjau oleh tim HMTI',
        'reviewing' => 'Sedang ditinjau oleh pengurus HMTI',
        'approved' => 'Pengajuan disetujui! Tim akan menghubungi Anda.',
        'rejected' => 'Pengajuan tidak dapat diproses saat ini.',
    ];
    return response()->json([
        'found' => true,
        'status' => $collab->status,
        'status_label' => $statusLabels[$collab->status] ?? $collab->status,
        'type' => $collab->proposalLabel(),
        'admin_notes' => $collab->admin_notes,
        'submitted_at' => $collab->created_at->format('d M Y, H:i'),
    ]);
})->name('api.collab-status');

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

    // Collaboration Management
    Route::get('/collaboration', [CollaborationController::class, 'index'])->name('collaboration.index');
    Route::put('/collaboration/{collaboration}', [CollaborationController::class, 'update'])->name('collaboration.update');
    Route::delete('/collaboration/{collaboration}', [CollaborationController::class, 'destroy'])->name('collaboration.destroy');
});
