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
        Gate::define('viewWebTinker', function ($user = null) {
            return $user->role=='admin';
        });
        Gate::define('viewAllNppbkc', function ($user = null) {
            return $user->role!='user';
        });
    }
}
