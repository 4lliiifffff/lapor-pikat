<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class AdminUserController extends Controller
{
    /**
     * Display a listing of system accounts and monitoring overview.
     */
    public function index(): View
    {
        $users = User::with('roles')->latest()->paginate(10);
        $totalUsers = User::count();
        $superAdminsCount = User::role('super_admin')->count();
        $adminsCount = User::role('admin')->count();
        $totalReports = Report::count();

        return view('admin.users.index', compact(
            'users',
            'totalUsers',
            'superAdminsCount',
            'adminsCount',
            'totalReports'
        ));
    }

    /**
     * Show the form for creating a new user account.
     */
    public function create(): View
    {
        $roles = Role::whereIn('name', ['super_admin', 'admin'])->get();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created user account in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:super_admin,admin'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('admin.users.index')->with('success', "Akun '{$user->name}' berhasil ditambahkan.");
    }

    /**
     * Show the form for editing the specified user account.
     */
    public function edit(User $user): View
    {
        $roles = Role::whereIn('name', ['super_admin', 'admin'])->get();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user account in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['nullable', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:super_admin,admin'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        $user->syncRoles([$request->role]);

        return redirect()->route('admin.users.index')->with('success', "Akun '{$user->name}' berhasil diperbarui.");
    }

    /**
     * Remove the specified user account from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif.');
        }

        $userName = $user->name;
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', "Akun '{$userName}' telah berhasil dihapus.");
    }
}
