<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\TenantService;

class TenantController extends Controller
{
    public function create()
    {
        $users = User::all();
        return view('tenant.create', compact('users'));
    }

    public function store(Request $request, TenantService $tenantService)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        $tenantService->createTenant($validatedData);

        return redirect()->route('tenant.index')->with('success', 'Tenant berhasil dibuat.');
    }

    public function index()
    {
        $tenants = Tenant::all();
        return view('tenant.index', compact('tenants'));
    }

    public function edit(Tenant $tenant)
    {
        return view('tenant.settings', compact('tenant'));
    }
}
