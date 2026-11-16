<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AuditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showRegister() { return view('auth.register'); }

    public function register(Request $request)
    {
        // FR-AUTH-01/06: validasi server, password kuat, role TIDAK bisa dimanipulasi
        // dari form — selalu 'user'. Hash bcrypt via cast 'hashed' di model.
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()->symbols()],
        ], [
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'email.unique' => 'Email sudah terdaftar.',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => strtolower($data['email']),
            'phone' => $data['phone'] ?? null,
            'password' => Hash::make($data['password']),
            'role' => 'user',
        ]);
        AuditService::log('auth.registered', 'users', $user->id, 'Registrasi akun baru: '.$user->email);
        Auth::login($user);
        $request->session()->regenerate(); // ID sesi diperbarui setelah login (FR-AUTH-03)
        return redirect()->route('dashboard')->with('success', 'Selamat datang, '.$user->name.'!');
    }

    public function showLogin() { return view('auth.login'); }

    public function login(Request $request)
    {
        // FR-AUTH-02: pesan galat generik — tidak membocorkan email terdaftar atau tidak.
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);
        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors(['email' => 'Email atau kata sandi salah.'])->onlyInput('email');
        }
        $user = Auth::user();
        if (!$user->is_active) {
            Auth::logout();
            return back()->withErrors(['email' => 'Akun Anda dinonaktifkan. Hubungi admin.'])->onlyInput('email');
        }
        $request->session()->regenerate();
        AuditService::log('auth.login', 'users', $user->id, 'Login berhasil');
        return redirect()->intended(route('dashboard'));
    }

    public function logout(Request $request)
    {
        AuditService::log('auth.logout', 'users', Auth::id(), 'Logout');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
