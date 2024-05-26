<?php

namespace App\Interfaces;

interface MessageSenderInterface
{
    public function send($recipent,$message): void;
}
