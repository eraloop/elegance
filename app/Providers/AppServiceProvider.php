<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        try {
            $company_info = \App\Models\CompanyInfo::first();
            \Illuminate\Support\Facades\View::share('company_info', $company_info);
        } catch (\Exception $e) {
            // Handle case where table doesn't exist yet (e.g. during migration)
        }
    }
}
