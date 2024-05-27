<?php

namespace App\Services\Messages;

use App\Interfaces\VoiceInterface;
use App\Interfaces\MessageSenderInterface;

class VoiceService  implements VoiceInterface
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

     public function sendVoice($recipent,$message): void
     {
         echo "Voice SMS: {$message}";
     }
}
