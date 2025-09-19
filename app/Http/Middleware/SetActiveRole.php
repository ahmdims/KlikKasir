<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\PermissionRegistrar;

class SetActiveRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $activeRoleId = session('active_role_id');

            // Jika tidak ada role aktif di session, set dari role pertama user
            if (!$activeRoleId && $user->roles->isNotEmpty()) {
                $activeRoleId = $user->roles->first()->id;
                session(['active_role_id' => $activeRoleId]);
            }

            // Jika ada role aktif, override relasi 'roles' pada model User untuk request ini saja
            if ($activeRoleId) {
                $activeRole = $user->roles->find($activeRoleId);
                if ($activeRole) {
                    // Ini adalah triknya: kita menimpa relasi roles yang di-load oleh Spatie
                    // hanya dengan role yang aktif untuk request ini.
                    $user->setRelation('roles', collect([$activeRole]));
                }
            }

            // Hapus cache permission agar Spatie menggunakan relasi roles yang sudah kita override
            app(PermissionRegistrar::class)->forgetCachedPermissions();
        }

        return $next($request);
    }
}