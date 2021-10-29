<?php

namespace App\Providers;

use App\Photo;
use App\Policies\PhotoPolicy;
use App\Policies\ReservationPolicy;
use App\Reservation;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Reservation::class => ReservationPolicy::class,
        Photo::class => PhotoPolicy::class
    ];

    public function boot()
    {
        $this->registerPolicies();


    }
}
