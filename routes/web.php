<?php

use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Admin\CampaignAdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DisbursementController;
use App\Http\Controllers\Admin\DonationAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\VolunteerAdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VolunteerController;
use Illuminate\Support\Facades\Route;

// ---------- Publik ----------
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns.index');
Route::get('/campaigns/{campaign}', [CampaignController::class, 'show'])->name('campaigns.show');
Route::get('/campaigns/{campaign}/transparency', [CampaignController::class, 'transparency'])->name('campaigns.transparency');

// ---------- Auth (rate limiting login: 5/menit — FR-AUTH-04) ----------
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:10,1');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
});

// ---------- Pengguna login ----------
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    Route::get('/donations', [DonationController::class, 'index'])->name('donations.index');
    Route::get('/campaigns/{campaign}/donate', [DonationController::class, 'create'])->name('donations.create');
    Route::post('/donations', [DonationController::class, 'store'])->name('donations.store');
    Route::get('/donations/{donation}', [DonationController::class, 'show'])->name('donations.show');
    Route::post('/donations/{donation}/proof', [DonationController::class, 'uploadProof'])->name('donations.proof');
    Route::post('/donations/{donation}/cancel', [DonationController::class, 'cancel'])->name('donations.cancel');

    Route::get('/volunteers', [VolunteerController::class, 'index'])->name('volunteers.index');
    Route::get('/campaigns/{campaign}/volunteer', [VolunteerController::class, 'create'])->name('volunteers.create');
    Route::post('/volunteers', [VolunteerController::class, 'store'])->name('volunteers.store');
    Route::post('/volunteers/{volunteer}/cancel', [VolunteerController::class, 'cancel'])->name('volunteers.cancel');

    // ---------- Admin (middleware 'admin' = RBAC server-side) ----------
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('campaigns', CampaignAdminController::class)->except(['show']);
        Route::get('/donations', [DonationAdminController::class, 'index'])->name('donations.index');
        Route::get('/donations/{donation}', [DonationAdminController::class, 'show'])->name('donations.show');
        Route::post('/donations/{donation}/verify', [DonationAdminController::class, 'verify'])->name('donations.verify');
        Route::post('/donations/{donation}/reject', [DonationAdminController::class, 'reject'])->name('donations.reject');
        Route::get('/volunteers', [VolunteerAdminController::class, 'index'])->name('volunteers.index');
        Route::post('/volunteers/{volunteer}/status', [VolunteerAdminController::class, 'setStatus'])->name('volunteers.status');
        Route::resource('disbursements', DisbursementController::class)->only(['index', 'create', 'store', 'destroy']);
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/export.csv', [ReportController::class, 'exportCsv'])->name('reports.csv');
        Route::get('/reports/export.pdf', [ReportController::class, 'exportPdf'])->name('reports.pdf');
        Route::get('/users', [UserAdminController::class, 'index'])->name('users.index');
        Route::post('/users/{user}/toggle-active', [UserAdminController::class, 'toggleActive'])->name('users.toggle');
        Route::post('/users/{user}/make-admin', [UserAdminController::class, 'makeAdmin'])->name('users.make-admin');
        Route::get('/audit-logs', [AuditLogController::class, 'index'])->name('audit-logs.index');
    });
});
