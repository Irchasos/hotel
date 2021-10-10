<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Enjoythetrip\Repositories\FrontendRepository;

class AppServiceProvider extends ServiceProvider
{



    public function register()
    {
        $this->app->bind(
            \App\Enjoythetrip\Interfaces\FrontendRepositoryInterface::class, function () {
                return new  \App\Enjoythetrip\Repositories\FrontendRepository;
            }
        );
        $this->app->bind(
            \App\Enjoythetrip\Interfaces\BackendRepositoryInterface::class, function () {
            return new  \App\Enjoythetrip\Repositories\BackendRepository;
        }
        );
    }

    public function boot()
    {
        View::composer(
            'frontend.*', function ($view) {
                $view->with('placeholder', asset('images/placeholder.jpeg'));
            }
        );
    }
}
