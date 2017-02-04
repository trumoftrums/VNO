<?php

namespace App\Providers;

use App\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('Layouts.frontend', function ($view)
        {
            $user = Auth::user();
            $listNewsHome = News::where('status', News::STATUS_ACTIVE)
                ->orderBy('id', 'desc')
                ->limit(6)
                ->get();
            $view->with([
                'listNewsHome' => $listNewsHome,
                'user' => $user
                ]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
