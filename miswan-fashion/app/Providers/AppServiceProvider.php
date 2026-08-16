<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Setting;

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
        Schema::defaultStringLength(191);

        if (request()->server('HTTP_X_FORWARDED_PROTO') == 'https' || request()->isSecure() || env('APP_ENV') === 'production' || (isset($_SERVER['HTTP_HOST']) && str_contains($_SERVER['HTTP_HOST'], 'infinityfree'))) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Share global categories and settings across all views if database tables exist
        try {
            if (Schema::hasTable('categories') && Schema::hasTable('settings')) {
                $globalCategories = Category::with('subCategories')
                    ->where('status', 1)
                    ->orderBy('priority', 'asc')
                    ->get();
                $globalSetting = Setting::first();

                View::share('globalCategories', $globalCategories);
                View::share('globalSetting', $globalSetting);
            }
        } catch (\Exception $e) {
            // Silently catch in CLI/setup
        }
    }
}
