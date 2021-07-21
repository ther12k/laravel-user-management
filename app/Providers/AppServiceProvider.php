<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

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
        Schema::defaultStringLength(191);
        // if(config('app.debug')!=true) {
        //     \URL::forceScheme('https');
        // }

        Relation::morphMap([
            'UserProfile' => 'App\Models\UserProfile',
            'OfficerProfile' => 'App\Models\OfficerProfile',
            'AdminProfile' => 'App\Models\AdminProfile',
        ]);
    }
}
