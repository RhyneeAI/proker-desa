<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::with('roles')->latest()->get();
        $roles = Role::orderBy('name')->pluck('name');

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {
        if ($user->is(auth()->user())) {
            return back()->with('error', 'Anda tidak dapat mengubah peran Anda sendiri.');
        }

        $validated = $request->validate([
            'role' => ['nullable', 'string', Rule::in(Role::pluck('name'))],
        ]);

        $user->syncRoles(isset($validated['role']) ? [$validated['role']] : []);

        return back()->with('success', "Peran pengguna {$user->name} berhasil diperbarui.");
    }
}
