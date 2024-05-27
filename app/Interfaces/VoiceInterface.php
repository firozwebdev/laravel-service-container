<?php

namespace App\Interfaces;

use App\Interfaces\MessageSenderInterface;

interface VoiceInterface extends MessageSenderInterface
{
    public function sendVoice($recipent,$message) ;
}
