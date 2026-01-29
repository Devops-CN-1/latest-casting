<!-- layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts: use system stack for offline (figtree was fonts.bunny.net) -->
        <style>body{font-family:ui-sans-serif,system-ui,sans-serif,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif}</style>
        <!-- Toastr (local for offline) -->
        <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet"/>
        <!-- jQuery (sync load so $ is defined before inline scripts) -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <!-- Toastr JS (after jQuery) -->
        <script src="{{ asset('js/toastr.min.js') }}"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .header-gradient {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }
            .logout-btn {
                transition: all 0.3s ease;
            }
            .logout-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            }
        </style>
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
        @if(session('auth_token'))
        <header class="header-gradient shadow-lg">
            <div class="container mx-auto px-4 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <h1 class="text-2xl font-bold text-white">{{ $systemSettings->software_name ?? " " }}</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        @if(isset($currentUser) && $currentUser && $currentUser->isSuperAdmin())
                        <div class="relative group">
                            <button type="button" class="logout-btn bg-white/90 text-gray-800 px-4 py-2 rounded-lg font-semibold shadow-md hover:bg-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-purple-600 flex items-center gap-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>Admin</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div class="absolute right-0 mt-1 w-56 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 shadow-lg py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
                                <a href="{{ url('system-settings') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">System Settings</a>
                                <a href="{{ route('import.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Upload DB (Import)</a>
                                <a href="{{ route('backup.download') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Download Encrypted DB</a>
                                <a href="{{ route('users.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 border-t border-gray-100 dark:border-gray-600 mt-1 pt-2">User Management</a>
                            </div>
                        </div>
                        @endif
                        <button 
                            type="button" 
                            onclick="logout()"
                            class="logout-btn bg-white text-gray-800 px-6 py-2 rounded-lg font-semibold shadow-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-purple-600">
                            <span class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                <span>Logout</span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </header>
        @endif

        
            <main>
                    
                @yield('content')
            </main>

            <!-- <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </footer> -->
        </div>
    </div>
    <script>
        function logout() {
            fetch("{{ route('logout') }}", {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": "Bearer {{ session('auth_token') }}",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
            })
            .then(response => response.json())
            .then(data => {
                window.location.reload('/');
            })
            .catch(error => console.error('Logout failed:', error));
        }
    </script>

</body>
</html>
