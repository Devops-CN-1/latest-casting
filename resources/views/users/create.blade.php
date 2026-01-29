@extends('layouts.app')

@section('content')
<div class="min-h-[60vh] bg-gray-50 dark:bg-gray-900/50">
    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <div class="mb-8">
            <a href="{{ route('users.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 transition mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Back to users
            </a>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">Add User</h1>
            <p class="mt-1 text-gray-500 dark:text-gray-400">Create a new user and assign role.</p>
        </div>

        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800/80 shadow-sm overflow-hidden">
            <form action="{{ route('users.store') }}" method="POST" class="p-6 sm:p-8">
                @csrf

                <div class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                               class="block w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700/50 px-4 py-3 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition outline-none"
                               required>
                        @error('name')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                               class="block w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700/50 px-4 py-3 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition outline-none"
                               required>
                        @error('email')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Password</label>
                        <input type="password" name="password" id="password"
                               class="block w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700/50 px-4 py-3 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition outline-none"
                               required minlength="8">
                        @error('password')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="block w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700/50 px-4 py-3 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition outline-none">
                    </div>

                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Role (Permission)</label>
                        <select name="role" id="role"
                                class="block w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700/50 px-4 py-3 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition outline-none">
                            <option value="admin" {{ old('role', 'admin') === 'admin' ? 'selected' : '' }}>Admin (no system settings / import / backup / user management)</option>
                            <option value="super_admin" {{ old('role') === 'super_admin' ? 'selected' : '' }}>Super Admin (full access)</option>
                        </select>
                        @error('role')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="stock_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Stock Password (optional)</label>
                        <input type="text" name="stock_password" id="stock_password" value="{{ old('stock_password') }}"
                               class="block w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700/50 px-4 py-3 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition outline-none">
                        @error('stock_password')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-600">
                    <button type="submit"
                            class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium rounded-xl hover:from-purple-700 hover:to-indigo-700 focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition shadow-md">
                        Create User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
