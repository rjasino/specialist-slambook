<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\SlamBook;

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
        // Share slambook data with navigation view
        View::composer('*', function ($view) {
            $slambook = null;
            if (Auth::check()) {
                $slambook = SlamBook::where('user_id', Auth::id())->first();
            }
            $view->with('slambook', $slambook);
        });
    }
}
