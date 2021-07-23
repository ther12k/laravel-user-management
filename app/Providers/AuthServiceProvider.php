<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Aktivasi Registrasi')
                ->line('TERIMA KASIH TELAH MELAKUKAN PENDAFTARAN USER!, Klik link dibawah ini.')
                ->action('Aktivasi Registrasi', $url);
        });
        Gate::define('userbiasa', function ($user = null) {
            return $user&&$user->role=='user';
        });
        Gate::define('addNppbkc', function ($user = null) {
            return $user&&$user->role=='user';
        });
        Gate::define('viewAllNppbkc', function ($user = null) {
            return $user&&$user->role!='user';
        });
        Gate::define('updateStatusNppbkc', function ($user = null) {
            if(env('APP_ENV')=='local')
                return $user&&($user->role=='officer'||$user->role=='admin');

            //officer only
            return $user&&($user->role=='officer');
        });
        Gate::define('manageUser', function ($user = null) {
            return $user&&$user->role=='admin';
        });
        Gate::define('viewActivityLog', function ($user = null) {
            return $user&&$user->role=='admin';
        });
        Gate::define('viewWebTinker', function ($user = null) {
            return $user&&$user->role=='admin';
        });
    }
}
