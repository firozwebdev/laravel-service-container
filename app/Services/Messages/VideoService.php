<?php

namespace App\Services\Messages;
use App\Interfaces\MessageSenderInterface;

class VideoService implements MessageSenderInterface
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
        echo "Voice SMS: {$message}";
    }    
    
    public function liveChat($recipent,$message): void
    {
        echo "Live Chat: {$message}";
    }
}
