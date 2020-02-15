<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\UserLogin;

class UpdateUserLoginAt
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     *
     * @return void
     */
    public function handle(UserLogin $event)
    {
        optional(User::find($event->userId))
            ->update(['login_at' => now()]);
    }
}
