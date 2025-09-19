<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Permission;
use Illuminate\Support\Facades\Route;

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

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Contoh route yang hanya bisa diakses oleh role tertentu
    Route::get('/reports', function () {
        // Tampilan laporan
    })->middleware(['can:view_reports'])->name('reports.index');

    Route::resource('permissions', PermissionController::class);

    Route::group([
        // 'prefix' => 'tenant-settings',
        // 'as' => 'tenant.',
        'middleware' => 'can:manage_roles'
    ], function () {
        Route::resource('roles', RoleController::class)->only(['index', 'show', 'edit', 'update']);
    });

    Route::resource('users', UserController::class)->middleware('can:manage_users');

    // Route::get('/users', function () {
    //     // Tampilan manajemen user
    // })->middleware(['can:manage_users'])->name('users.index');
});