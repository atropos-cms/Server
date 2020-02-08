<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserLogin
{
    use Dispatchable, SerializesModels;

    /**
     * @var int|null
     */
    public $userId = null;

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
