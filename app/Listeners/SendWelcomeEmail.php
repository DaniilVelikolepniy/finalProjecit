<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Mail\RegistrationComplitedMailing;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail
{
    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event)
    {
        Mail::to($event->user->email)->send(new RegistrationComplitedMailing($event->user));
    }
} 