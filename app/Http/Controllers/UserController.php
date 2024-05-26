<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factories\MessageSenderFactory;
use App\Interfaces\MessageSenderInterface;
use InvalidArgumentException;

class UserController extends Controller
{
    // protected $messageSenderFactory;

    // public function __construct(MessageSenderFactory $messageSenderFactory)
    // {
    //     $this->messageSenderFactory = $messageSenderFactory;
    // }

    public function index(Request $request,MessageSenderFactory $messageSenderFactory): void
    {
        //$type = $request->input('type');
        $type = "sms";
        $recipient = '01754165234';
        $message = 'Hello from Laravel! This is a sms message.'; 
        
       

        try {
            /** @var MessageSenderInterface $messageSender */
            $messageSender = $messageSenderFactory->create($type);
            //$messageSender->send($request->input('recipient'), $request->input('message'));
            $messageSender->send($recipient, $message);

            echo "<br/>";

            $type = "email";
            $recipient = 'smskushti@gmail.com ';
            $message = 'Hello from Laravel! This is a email message.'; 
            $messageSender = $messageSenderFactory->create($type);
            $messageSender->send($recipient, $message);


            echo "<br/>";
            
            $type = "voice";
            $recipient = 'voice@gmail.com ';
            $message = 'Hello from Laravel! This is a voice message.'; 
            $messageSender = $messageSenderFactory->create($type);
            $messageSender->send($recipient, $message);

        } catch (InvalidArgumentException $e) {
            // Handle the exception, e.g., return a response with an error message.
        }
    }
}
