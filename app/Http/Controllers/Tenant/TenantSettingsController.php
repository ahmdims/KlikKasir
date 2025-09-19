<?php

namespace App\Http\Controllers\Tenant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Services\TenantService;

class TenantSettingsController extends Controller
{
    public function create()
    {
        $tenant = Auth::user()->tenant;

        if (!$tenant) {
            abort(404, 'Tenant not found for this user.');
        }

        return view('tenant.settings', compact('tenant'));
    }

    public function update(Request $request, TenantService $tenantService)
    {
        $tenant = Auth::user()->tenant;

        if (!$tenant) {
            abort(404, 'Tenant not found for this user.');
        }

        if (! Gate::allows('update', $tenant)) {
            abort(403);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|url|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $tenantService->updateTenant($tenant, $validatedData);

        return redirect()->route('tenant.settings')->with('success', 'Pengaturan tenant berhasil diperbarui.');
    }
}
