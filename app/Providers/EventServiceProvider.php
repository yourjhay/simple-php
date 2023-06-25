<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
 
class EventServiceProvider {
    
    /**
     * Register any events/observer for your application.
     * Example:
     *  User::observe(UserObserver::class);
     * 
     *  To Create Observer
     *   php cli make:observer User
     */
    public function boot()
    {
        // Put all your observers here.
       // User::observe(UserObserver::class);
    }
}