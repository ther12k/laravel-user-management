<?php

namespace App\Listeners;

use IlluminateEventsLogin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Auth\Events\Login;
use Spatie\ActivityLog\Models\Activity;

class LoginSuccessfull
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  IlluminateEventsLogin  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $event->subject = 'login';
        $event->description ='Login successfull';
        
        activity($event->subject)
        ->by($event->user)
        ->log($event->description);
    }
}
