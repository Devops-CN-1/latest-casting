<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id')->paginate(15);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|min:2|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
            'role'     => 'required|in:admin,super_admin',
            'stock_password' => 'nullable|string|max:255',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'     => 'required|string|min:2|max:255',
            'email'    => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'confirmed', Password::min(8)],
            'role'     => 'required|in:admin,super_admin',
            'stock_password' => 'nullable|string|max:255',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];
        if (!empty($validated['stock_password'])) {
            $user->stock_password = $validated['stock_password'];
        }
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }
}
