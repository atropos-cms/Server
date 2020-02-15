<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class UserLogin
{
    use Dispatchable, SerializesModels;

    public ?int $userId = null;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->userId = auth()->id();
    }
}
