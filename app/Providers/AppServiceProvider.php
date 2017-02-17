<?php

namespace App\Providers;

use App\Models\Baiviet;
use App\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Models\Thongso;

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
            $listNewsHome = News::where('status', News::STATUS_ACTIVE)
                ->orderBy('id', 'desc')
                ->limit(6)
                ->get();
            $totalPost = 0;
            $user = [];
            if(Auth::check()){
                $user = Auth::user();
                $totalPost = Baiviet::where('userid', $user->id)->count();
            }
            $list_thongso = Thongso::where('filter',1)->get()->toArray();

            $view->with([
                'listNewsHome' => $listNewsHome,
                'user' => $user,
                'totalPost' => $totalPost,
                'list_thongso'=>$list_thongso
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
