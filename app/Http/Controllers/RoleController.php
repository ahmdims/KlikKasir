<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Menampilkan daftar role yang bisa dikelola.
     */
    public function index()
    {
        $roles = Role::all();

        return view('roles.index', compact('roles'));
    }

    /**
     * Menampilkan halaman detail role (read-only)
     */
    public function show(Role $role)
    {
        $permissions = $role->permissions;

        $users = $role->users()->get();

        return view('roles.show', compact('role', 'permissions', 'users'));
    }

    /**
     * Menampilkan halaman checklist permission untuk role tertentu.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Mengupdate permission dari role yang di-submit.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'nullable|array'
        ]);

        $permissions = $request->input('permissions', []);
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('success', "Permissions for '$role->name' have been updated.");
    }
}