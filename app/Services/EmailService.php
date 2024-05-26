<?php

namespace App\Services;
use App\Interfaces\MessageSenderInterface;

class EmailService implements MessageSenderInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function send($recipent,$message): void
    {
        echo "Sending Email: {$message}";
    }
}
