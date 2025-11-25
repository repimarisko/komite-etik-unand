<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PengajuanBaruController;
use App\Http\Controllers\PerbaikanController;
use App\Http\Controllers\AmandemenController;
use App\Http\Controllers\LaporanAkhirController;
use App\Http\Controllers\PerpanjanganController;
use App\Http\Controllers\KtdSaeController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\Auth\UserRegistrationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\PengajuanController as AdminPengajuanController;
use App\Http\Controllers\Admin\PlottingController;
use App\Http\Controllers\Admin\VerificationController;
use App\Http\Controllers\LayPersonController;

// Public Routes (accessible without login)
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard - accessible to everyone
Route::get('/dashboard', function () {
    $featuredNews = \App\Models\News::published()->featured()->latest('published_at')->first();
    $latestNews = \App\Models\News::published()->latest('published_at')->get();
    return view('dashboard', compact('featuredNews', 'latestNews'));
})->name('dashboard');

// News detail - accessible to everyone
Route::get('/berita/{news}', function (\App\Models\News $news) {
    return view('news.show', compact('news'));
})->name('news.show');

// Profil Komite Etik - accessible to everyone
Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');

// Authentication Routes
Route::middleware('guest')->group(function () {
    // Login routes
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Registration routes
    Route::get('/register', [UserRegistrationController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [UserRegistrationController::class, 'register']);

    // Email verification routes
    Route::get('/email/verify', [UserRegistrationController::class, 'showVerificationNotice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [UserRegistrationController::class, 'verifyEmail'])->name('verification.verify');
    Route::get('/email/verify/{token}', [UserRegistrationController::class, 'verifyEmailByToken'])->name('email.verify');
    Route::post('/email/verification-notification', [UserRegistrationController::class, 'resendVerification'])->name('verification.resend');

    // Registration success page
    Route::get('/registration-success', function () {
        return view('auth.registration-success');
    })->name('registration.success');

    // Email verified page
    Route::get('/email-verified', function () {
        return view('auth.email-verified');
    })->name('email.verified');
});

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    // Logout route
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware(['active_user', 'role:pengusul_etik,super_admin'])->group(function () {
        // Formulir Pengajuan Baru
        Route::get('/pengajuan-baru', [PengajuanBaruController::class, 'index'])->name('pengajuan-baru.index');
        Route::post('/pengajuan-baru', [PengajuanBaruController::class, 'store'])->name('pengajuan-baru.store');

        // Formulir Pengajuan Perbaikan
        Route::get('/perbaikan', [PerbaikanController::class, 'index'])->name('perbaikan.index');
        Route::post('/perbaikan', [PerbaikanController::class, 'store'])->name('perbaikan.store');

        // Formulir Pengajuan Amandemen
        Route::get('/amandemen', [AmandemenController::class, 'index'])->name('amandemen.index');
        Route::post('/amandemen', [AmandemenController::class, 'store'])->name('amandemen.store');

        // Laporan Akhir Penelitian
        Route::get('/laporan-akhir', [LaporanAkhirController::class, 'index'])->name('laporan-akhir.index');
        Route::post('/laporan-akhir', [LaporanAkhirController::class, 'store'])->name('laporan-akhir.store');

        // Formulir Perpanjangan Penelitian
        Route::get('/perpanjangan', [PerpanjanganController::class, 'index'])->name('perpanjangan.index');
        Route::post('/perpanjangan', [PerpanjanganController::class, 'store'])->name('perpanjangan.store');

        // Modul KTD-SAE
        Route::get('/ktd-sae', [KtdSaeController::class, 'index'])->name('ktd-sae.index');
        Route::post('/ktd-sae', [KtdSaeController::class, 'store'])->name('ktd-sae.store');

        // API Dosen
        Route::get('/api/dosen', [DosenController::class, 'index'])->name('api.dosen.index');
        Route::get('/api/dosen/search', [DosenController::class, 'search'])->name('api.dosen.search');
        Route::get('/dosen', [DosenController::class, 'show'])->name('dosen.show');
        Route::get('/dosen/{nidn}', [DosenController::class, 'detail'])->name('dosen.detail');
    });
});

// Admin Routes (require admin authentication)
Route::middleware(['admin_auth', 'role:super_admin,verifikator,operator'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/pengajuan', [AdminPengajuanController::class, 'index'])->name('pengajuan.index');
    Route::get('/verifikasi', [VerificationController::class, 'index'])->name('verifications.index');
    Route::get('/exports', [ExportController::class, 'index'])->name('exports.index');
    Route::get('/plotting', [PlottingController::class, 'index'])->name('plotting.index');

    // User Management
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::get('/users/{user}', [AdminController::class, 'showUser'])->name('users.show');

    // News Management
    Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::patch('/users/{user}/toggle-status', [AdminController::class, 'toggleUserStatus'])->name('users.toggle-status');
    Route::post('/users/{user}/reset-password', [AdminController::class, 'resetUserPassword'])->name('users.reset-password');

    // User Registration Management
    Route::get('/registrations', [AdminController::class, 'pendingRegistrations'])->name('registrations.index');
    Route::post('/registrations/{registration}/operator-verify', [AdminController::class, 'operatorVerifyRegistration'])->name('registrations.operator-verify');
    Route::post('/registrations/{registration}/approve', [AdminController::class, 'approveRegistration'])->name('registrations.approve');
    Route::post('/registrations/{registration}/reject', [AdminController::class, 'rejectRegistration'])->name('registrations.reject');

    // Role Management
    Route::get('/roles', [AdminController::class, 'roles'])->name('roles.index');
    Route::post('/roles', [AdminController::class, 'storeRole'])->name('roles.store');
    Route::put('/roles/{role}', [AdminController::class, 'updateRole'])->name('roles.update');
    Route::delete('/roles/{role}', [AdminController::class, 'deleteRole'])->name('roles.delete');

    // Activity Logs
    Route::get('/activity-logs', [AdminController::class, 'activityLogs'])->name('activity-logs.index');

    // News Management
    Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);
});

Route::middleware(['admin_auth', 'role:lay_person,super_admin'])->prefix('lay-person')->name('lay-person.')->group(function () {
    Route::get('/assignments', [LayPersonController::class, 'assignments'])->name('assignments');
    Route::get('/forms', [LayPersonController::class, 'forms'])->name('forms');
});
