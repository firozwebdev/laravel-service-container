<?php

namespace App\Factories;

use App\Interfaces\MessageSenderInterface;
use Illuminate\Support\Facades\App;
use InvalidArgumentException;

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
}
