<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\SystemSetting;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Laravel\Sanctum\PersonalAccessToken;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('system_settings')) {
            $settings = SystemSetting::first();
            View::share('systemSettings', $settings);
        }

        View::composer('*', function ($view) {
            $currentUser = null;
            $token = session('auth_token');
            if ($token && Schema::hasTable('personal_access_tokens')) {
                $accessToken = PersonalAccessToken::findToken($token);
                if ($accessToken && $accessToken->tokenable instanceof User) {
                    $currentUser = $accessToken->tokenable;
                }
            }
            $view->with('currentUser', $currentUser);
        });
    }
}
