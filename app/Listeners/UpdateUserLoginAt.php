<?php

namespace App\Listeners;

use App\Events\UserLogin;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;

class UpdateUserLoginAt
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserLogin $event)
    {
        optional(User::find($event->userId))
            ->update(['login_at' => now()]);
    }
}
