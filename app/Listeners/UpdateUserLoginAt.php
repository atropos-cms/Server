<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;

class UpdateUserLoginAt
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
     * @param  object  $event
     * @return void
     */
    public function handle(\Laravel\Passport\Events\AccessTokenCreated $event)
    {
        /** @var User $user */
        $user = User::findOrFail($event->userId);
        $user->login_at = Carbon::now();
        $user->save();
    }
}
