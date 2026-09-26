<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    private function requireAdmin(): void
    {
        abort_unless(
            auth()->check()
                && auth()->user()->username === 'admin',
            403,
            'Hanya akun Supervisor yang dapat mengelola user.'
        );
    }

    public function index()
    {
        $users = User::orderBy('role')
            ->orderBy('name')
            ->get();

        return view(
            'users.index',
            compact('users')
        );
    }

    public function create()
    {
        $this->requireAdmin();

        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->requireAdmin();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'username' => [
                'required',
                'string',
                'max:255',
                'unique:users,username',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'role' => [
                'required',
                'in:inspector,supervisor',
            ],
            'password' => [
                'required',
                'confirmed',
                Password::min(8),
            ],
        ]);

        $user = new User();

        $user->name = $validated['name'];
        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];
        $user->password = $validated['password'];

        $user->save();

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User berhasil ditambahkan.'
            );
    }

    public function edit(User $user)
    {
        $this->requireAdmin();

        return view(
            'users.edit',
            compact('user')
        );
    }

    public function update(
        Request $request,
        User $user
    ) {
        $this->requireAdmin();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique(
                    'users',
                    'username'
                )->ignore($user->id),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique(
                    'users',
                    'email'
                )->ignore($user->id),
            ],
            'role' => [
                'required',
                'in:inspector,supervisor',
            ],
        ]);

        $user->name = $validated['name'];
        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        $user->save();

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User berhasil diperbarui.'
            );
    }

    public function changePassword()
    {
        return view('users.change-password');
    }

    public function updatePassword(
        Request $request
    ) {
        $validated = $request->validate([
            'current_password' => [
                'required',
                'string',
            ],
            'password' => [
                'required',
                'confirmed',
                Password::min(8),
            ],
        ]);

        $user = auth()->user();

        if (
            !Hash::check(
                $validated['current_password'],
                $user->password
            )
        ) {
            return back()
                ->withErrors([
                    'current_password' =>
                        'Password saat ini salah.',
                ]);
        }

        $user->password =
            $validated['password'];

        $user->save();

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'Password berhasil diubah.'
            );
    }

    public function resetPasswordForm(User $user)
    {
        $this->requireAdmin();

        return view(
            'users.reset-password',
            compact('user')
        );
    }

    public function resetPassword(
        Request $request,
        User $user
    ) {
        $this->requireAdmin();

        $validated = $request->validate([
            'password' => [
                'required',
                'confirmed',
                Password::min(8),
            ],
        ]);

        $user->password =
            $validated['password'];

        $user->save();

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'Password ' . $user->name .
                ' berhasil direset.'
            );
    }
}