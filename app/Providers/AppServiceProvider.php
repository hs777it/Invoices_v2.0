<?php

namespace App\Providers;

use App\Composers\ProfileComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        View::share('hs', 'Hussein Saad');

        View::composer('*', function ($view) {
          //  $view->with('invoices', \App\User::first());
        });

        //View::composer('*', ProfileComposer::class);
        View::composer('photos.index', ProfileComposer::class);
    }
}
