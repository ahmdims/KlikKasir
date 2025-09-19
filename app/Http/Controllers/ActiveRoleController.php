<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActiveRoleController extends Controller
{
    /**
     * Switch the active role for the user.
     *
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switch(Role $role)
    {
        $user = Auth::user();

        // Pastikan user memiliki role yang akan di-switch (cek langsung ke relasi DB)
        if (!$user->roles()->where('id', $role->id)->exists()) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke role tersebut.');
        }

        // Simpan role_id yang aktif ke dalam session
        session(['active_role_id' => $role->id]);

        // Hapus cache permissions agar Spatie-Permission memuat ulang permission sesuai role baru
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()->route('dashboard')->with('success', 'Role berhasil diganti ke ' . $role->name);
    }
}