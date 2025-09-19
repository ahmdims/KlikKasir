<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthService
{
    /**
     * Attempt to authenticate a user.
     *
     * @param array $credentials
     * @return bool
     */
    public function login(array $credentials): bool
    {
        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();
            return true;
        }

        return false;
    }

    /**
     * Get authenticated user's permissions.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getUserPermissions()
    {
        if (Auth::check()) {
            // Mengambil semua permission dari semua role yang dimiliki user
            return Auth::user()->getAllPermissions()->pluck('name');
        }
        return collect();
    }
}