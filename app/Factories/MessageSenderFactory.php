<?php

namespace App\Factories;

use App\Interfaces\MessageSenderInterface;
use App\Services\EmailService;
use App\Services\SmsService;
use InvalidArgumentException;

class MessageSenderFactory
{
    protected $emailService;
    protected $smsService;

    public function __construct(EmailService $emailService, SmsService $smsService)
    {
        $this->emailService = $emailService;
        $this->smsService = $smsService;
    }

    public function create(string $gateway): MessageSenderInterface
    {
        switch ($gateway) {
            case 'email':
                return $this->emailService;
            case 'sms':
                return $this->smsService;
            default:
                throw new InvalidArgumentException("Unsupported gateway: $gateway");
        }
    }
}
