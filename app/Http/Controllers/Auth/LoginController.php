<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AuthService;

class LoginController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }





    public function showLoginForm()
    {
        return view('auth.login'); // Kita perlu buat view ini
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if ($this->authService->login($credentials)) {
            $user = auth()->user();
            // Ambil role pertama user dan simpan sebagai role aktif di session
            $firstRole = $user->roles->first();
            if ($firstRole) {
                session(['active_role_id' => $firstRole->id]);
            }

            // Ambil permissions setelah login berhasil
            $permissions = $this->authService->getUserPermissions();
            session(['user_permissions' => $permissions]);

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}