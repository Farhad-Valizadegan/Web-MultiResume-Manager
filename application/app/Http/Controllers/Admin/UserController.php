<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'in:admin,user'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        User::create($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'in:admin,user'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        \Illuminate\Support\Facades\DB::transaction(function () use ($user, $validated) {
            // Lock the same administrator set for competing role/status changes.
            $admins = User::where('role', 'admin')->where('status', 'active')->lockForUpdate()->get();
            if ($admins->contains('id', $user->id)
                && ($validated['role'] !== 'admin' || $validated['status'] !== 'active')
                && $admins->count() === 1) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'role' => 'Keep at least one active administrator.',
                ]);
            }
            $user->update($validated);
        });

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        app(\App\Services\ResumeFiles::class)->transaction(fn () => $user->delete());

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }

    public function deactivate(User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'You cannot deactivate your own account.');
        }

        \Illuminate\Support\Facades\DB::transaction(function () use ($user) {
            $admins = User::where('role', 'admin')->where('status', 'active')->lockForUpdate()->get();
            if ($admins->contains('id', $user->id) && $admins->count() === 1) {
                throw \Illuminate\Validation\ValidationException::withMessages(['status' => 'Keep at least one active administrator.']);
            }
            $user->update(['status' => 'inactive']);
        });

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deactivated successfully.');
    }
}