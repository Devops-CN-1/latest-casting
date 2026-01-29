@extends('layouts.app')

@section('content')
<div class="min-h-[60vh] bg-gray-50 dark:bg-gray-900/50">
    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 transition mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Back to home
            </a>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">System Settings</h1>
            <p class="mt-1 text-gray-500 dark:text-gray-400">Manage rates and application name.</p>
        </div>

        <!-- Settings card -->
        <div class="rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800/80 shadow-sm overflow-hidden">
            <form id="systemSettingsForm" class="p-6 sm:p-8">
                @csrf

                <div class="space-y-6">
                    <div>
                        <label for="gold_rate" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Gold Rate</label>
                        <input type="number" step="0.01" name="gold_rate" id="gold_rate"
                               value="{{ $system_settings->gold_rate ?? '' }}"
                               placeholder="0.00"
                               class="block w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700/50 px-4 py-3 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition outline-none"
                               required>
                    </div>

                    <div>
                        <label for="gram_rate" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Gram Rate</label>
                        <input type="number" step="0.01" name="gram_rate" id="gram_rate"
                               value="{{ $system_settings->gram_rate ?? '' }}"
                               placeholder="0.00"
                               class="block w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700/50 px-4 py-3 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition outline-none"
                               required>
                    </div>

                    <div>
                        <label for="software_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Software Name</label>
                        <input type="text" name="software_name" id="software_name"
                               value="{{ $system_settings->software_name ?? '' }}"
                               placeholder="Casting Management"
                               class="block w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700/50 px-4 py-3 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition outline-none"
                               required>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-600">
                    <button type="submit"
                            class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium rounded-xl hover:from-purple-700 hover:to-indigo-700 focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition shadow-md">
                        Save Settings
                    </button>
                </div>
            </form>
        </div>

        <!-- Message -->
        <div id="message" class="mt-4"></div>

        <!-- Quick actions -->
        <div class="mt-8">
            <h2 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">Quick actions</h2>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('backup.download') }}"
                   class="flex items-center justify-center gap-2 px-5 py-3 rounded-xl border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800/80 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:border-green-500/50 dark:hover:border-green-500/50 transition font-medium">
                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Download backup
                </a>
                <a href="{{ route('import.index') }}"
                   class="flex items-center justify-center gap-2 px-5 py-3 rounded-xl border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800/80 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:border-purple-500/50 dark:hover:border-purple-500/50 transition font-medium">
                    <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                    Import data
                </a>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $("#systemSettingsForm").on("submit", function(e){
        e.preventDefault();

        $.ajax({
            url: "{{ url('/api/system-settings/save') }}",
            type: "POST",
            data: $(this).serialize(),
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", "Bearer {{ session('auth_token') }}");
            },
            success: function(response){
                $("#message").html('<div class="p-4 rounded-xl bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 border border-green-200 dark:border-green-800">'+response.message+'</div>');
                setTimeout(function(){ window.location.href = '/'; }, 1200);
            },
            error: function(xhr){
                $("#message").html('<div class="p-4 rounded-xl bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 border border-red-200 dark:border-red-800">Something went wrong. Please try again.</div>');
            }
        });
    });
});
</script>
@endsection
