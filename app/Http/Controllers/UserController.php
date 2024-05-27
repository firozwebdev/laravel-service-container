<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use InvalidArgumentException;
use App\Interfaces\VoiceInterface;
use App\Factories\MessageSenderFactory;
use App\Factories\PaymentGatewayFactory;
use App\Interfaces\MessageSenderInterface;
use App\Interfaces\StripeInterface;

class UserController extends Controller
{
    // protected $messageSenderFactory;

    // public function __construct(MessageSenderFactory $messageSenderFactory)
    // {
    //     $this->messageSenderFactory = $messageSenderFactory;
    // }

    public function index(Request $request,MessageSenderFactory $messageSenderFactory, PaymentGatewayFactory $paymentGatewayFactory): void
    {
        //$type = $request->input('type');
        $type = "sms";
        $recipient = '01754165234';
        $message = 'Hello from Laravel! This is a sms message.'; 
        
       

        try {
            /** @var MessageSenderInterface $messageSender */
            // $messageSender = $messageSenderFactory->create($type);
            // //$messageSender->send($request->input('recipient'), $request->input('message'));
            // $messageSender->send($recipient, $message);

            // echo "<br/>";

            // $type = "email";
            // $recipient = 'smskushti@gmail.com ';
            // $message = 'Hello from Laravel! This is a email message.'; 
            // $messageSender = $messageSenderFactory->create($type);
            // $messageSender->send($recipient, $message);


            // echo "<br/>";
            
            // $type = "voice";
            // $recipient = 'voice@gmail.com ';
            // $message = 'Hello from Laravel! This is a voice message.'; 
            // $messageSender = $messageSenderFactory->create($type);
            // $messageSender->send($recipient, $message);echo "<br/>";
            
            // if ($messageSender instanceof VoiceInterface) {
            //     // Handle additional functionality for voice messages
            //     $convertedText = $messageSender->convertText($request->input('message'));
            //     $messageSender->send($request->input('recipient'), $convertedText);
            // } else {
            //     $messageSender->send($request->input('recipient'), $request->input('message'));
            // }

            // echo "<br/>";
            $type = "voice";
            $recipient = 'voice@gmail.com ';
            $message = 'Hello from Laravel! This is a voice message.'; 
            $messageSender = $messageSenderFactory->create($type);
            //dd($messageSender);
            //$messageSender->send($recipient, $message);
           
            if ($messageSender instanceof VoiceInterface) {
                // Handle additional functionality for voice messages
                $voiceTxt = $messageSender->sendVoice($recipient, $message);
                //$messageSender->send($recipient, $voiceTxt);
            }
            //$convertedText = $messageSender->sendVoice($recipient, $message);
            //$messageSender = $messageSenderFactory->create($type);
            //$messageSender->sendVoice($recipient, $message);echo "<br/>";

            // $gateway = "bikash";
            // $paymentGateway = $paymentGatewayFactory->create($gateway);
            // $paymentGateway->charge(100);
            // $paymentGateway->refund(50);
             echo '<br/>';

            $gateway = "stripe";
            $paymentGateway = $paymentGatewayFactory->create($gateway);
            
            if ($paymentGateway instanceof StripeInterface) {
               
                // Handle additional functionality for Stripe payment gateway
                $paymentGateway->withdraw(100);
            }

            // $gateway = "nagad";
            // $paymentGateway = $paymentGatewayFactory->create($gateway);
            // $paymentGateway->charge(20);
            // $paymentGateway->refund(5);

        } catch (InvalidArgumentException $e) {
           echo $e->getMessage();
        }
    }
}
