<?php

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use Illuminate\Support\Facades\Route;

// Vista pública del portafolio
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio');

// Autenticación Administrativa
Route::middleware('guest')->group(function () {
    Route::get('admin/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('admin/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    
    // Panel / Configuración de Perfil
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('dashboard', [DashboardController::class, 'update'])->name('dashboard.update');
    
    // Gestión de Proyectos
    Route::resource('projects', ProjectController::class)->except(['show']);
});
