<?php

namespace App\Providers;

use App\Services\GamificationService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // View::composer('*', function ($view) {
        //     if (auth()->check()) {
        //         $gamificationData = GamificationService::getGamificationData();
        //         $view->with('globalGamificationData', $gamificationData);
        //     }
        // });
    }

    public function register()
    {
        //
    }
}
