<?php

namespace App\Factories;

use InvalidArgumentException;
use App\Interfaces\VoiceInterface;
use Illuminate\Support\Facades\App;
use App\Interfaces\MessageSenderInterface;

class MessageSenderFactory
{
    protected $services;

    public function __construct()
    {
        $this->services = config('messages');
    }

    public function create(string $type): MessageSenderInterface
    {
        if (!isset($this->services[$type])) {
            throw new InvalidArgumentException("Unsupported type: $type");
        }

        return App::make($this->services[$type]);
    }

    public function createVoiceService(): VoiceInterface
    {
        return App::make(VoiceInterface::class);
    }
}
