@extends('layouts.app')

@section('content')
<div class="min-h-[60vh] bg-gray-50 dark:bg-gray-900/50">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 transition mb-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Back to home
                </a>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">User Management</h1>
                <p class="mt-1 text-gray-500 dark:text-gray-400">Add users and assign roles (Super Admin / Admin).</p>
            </div>
            <a href="{{ route('users.create') }}"
               class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium rounded-xl hover:from-purple-700 hover:to-indigo-700 transition shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                Add User
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 rounded-xl bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 border border-green-200 dark:border-green-800">
                {{ session('success') }}
            </div>
        @endif

        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800/80 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-100 dark:bg-gray-700/50 text-gray-700 dark:text-gray-300 text-sm font-semibold uppercase tracking-wider">
                        <tr>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Role</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                        @forelse($users as $u)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30">
                                <td class="px-4 py-3 text-gray-900 dark:text-white">{{ $u->name }}</td>
                                <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $u->email }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full
                                        {{ $u->role === 'super_admin' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900/40 dark:text-purple-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                        {{ $u->role === 'super_admin' ? 'Super Admin' : 'Admin' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <a href="{{ route('users.edit', $u) }}" class="text-purple-600 dark:text-purple-400 hover:underline font-medium">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">No users yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($users->hasPages())
                <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-600">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
