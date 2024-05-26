<?php

namespace App\Services\Messages;

use App\Interfaces\MessageSenderInterface;

class VoiceService  implements MessageSenderInterface
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
}
