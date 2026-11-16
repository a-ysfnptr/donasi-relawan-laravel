<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuditService;

class UserAdminController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function toggleActive(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors(['akun' => 'Admin tidak dapat menonaktifkan akunnya sendiri.']);
        }
        $user->update(['is_active' => !$user->is_active]);
        AuditService::log('user.status_changed', 'users', $user->id, 'Akun '.($user->is_active ? 'diaktifkan' : 'dinonaktifkan'));
        return back()->with('success', 'Status akun diperbarui.');
    }

    public function makeAdmin(User $user)
    {
        $user->update(['role' => 'admin']);
        AuditService::log('user.role_changed', 'users', $user->id, 'Peran diubah menjadi admin');
        return back()->with('success', $user->name.' kini menjadi admin.');
    }
}
