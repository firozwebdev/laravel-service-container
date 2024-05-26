<?php

namespace App\Services;
use App\Interfaces\MessageSenderInterface;

class SmsService implements MessageSenderInterface
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
        echo "Sending SMS: {$message}";
    }
}
