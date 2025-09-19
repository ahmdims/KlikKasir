<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Tenant\TenantSettingsController;
use App\Http\Controllers\Tenant\TenantController;
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

use App\Http\Controllers\ActiveRoleController;

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/debug-roles', function () {
    if (!Auth::check()) {
        return response()->json(['error' => 'User not logged in.']);
    }
    $user = Auth::user();
    // Penting: kita perlu memuat ulang relasi roles untuk mendapatkan semua role, bukan hanya yang aktif dari middleware
    $user->load('roles');

    return response()->json([
        'user_id' => $user->id,
        'user_name' => $user->name,
        'roles_count' => $user->roles->count(),
        'roles' => $user->roles->pluck('name'),
        'active_role_id_in_session' => session('active_role_id'),
    ]);
})->middleware('web');

Route::middleware('auth')->group(function () {
    Route::get('/roles/switch/{role}', [ActiveRoleController::class, 'switch'])->name('roles.switch');
});

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

    Route::get('tenant/settings', [TenantSettingsController::class, 'create'])->name('tenant.settings');
    Route::put('tenant/settings', [TenantSettingsController::class, 'update'])->name('tenant.settings.update');
});

Route::middleware(['auth', 'superadmin'])->group(function () {
    Route::get('tenants', [TenantController::class, 'index'])->name('tenant.index');
    Route::get('tenants/create', [TenantController::class, 'create'])->name('tenant.create');
    Route::post('tenants', [TenantController::class, 'store'])->name('tenant.store');
    Route::get('tenants/{tenant}/edit', [TenantController::class, 'edit'])->name('tenant.edit');
});