<?php

namespace App\Interfaces;

interface VoiceInterface extends MessageSenderInterface
{
    public function sendVoice($recipent,$message) ;
}
