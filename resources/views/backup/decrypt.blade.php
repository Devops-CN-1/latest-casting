@extends('layouts.app')

@section('content')
<div class="min-h-[60vh] bg-gray-50 dark:bg-gray-900/50">
    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <div class="mb-8">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 transition mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Back to home
            </a>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">Decrypt database backup</h1>
            <p class="mt-1 text-gray-500 dark:text-gray-400">Upload an encrypted .enc file, enter the backup password, and download the decrypted SQL.</p>
        </div>

        @if(session('error'))
            <div class="mb-6 p-4 rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800/80 shadow-sm overflow-hidden">
            <form action="{{ route('backup.decrypt') }}" method="post" enctype="multipart/form-data" class="p-6 sm:p-8">
                @csrf

                <div class="space-y-6">
                    <div>
                        <label for="encrypted_file" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Encrypted backup file (.enc)</label>
                        <input type="file" name="encrypted_file" id="encrypted_file" accept=".enc,application/octet-stream"
                               class="block w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700/50 px-4 py-3 text-gray-900 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-purple-50 dark:file:bg-purple-900/30 file:text-purple-700 dark:file:text-purple-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition outline-none"
                               required>
                        <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400">Select the encrypted database file you downloaded from this system.</p>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Backup password</label>
                        <input type="password" name="password" id="password" autocomplete="off"
                               placeholder="Enter the password used when the backup was created"
                               class="block w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700/50 px-4 py-3 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition outline-none"
                               required>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-600">
                    <button type="submit"
                            class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium rounded-xl hover:from-purple-700 hover:to-indigo-700 focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition shadow-md flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                        Decrypt &amp; download
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
