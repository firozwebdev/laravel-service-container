<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use InvalidArgumentException;
use App\Interfaces\VoiceInterface;
use App\Factories\MessageSenderFactory;
use App\Factories\PaymentGatewayFactory;
use App\Interfaces\MessageSenderInterface;
use App\Interfaces\StripeInterface;
use App\Interfaces\AmarPayInterface;
class UserController extends Controller
{
    protected $messageSenderFactory;
    protected $paymentGatewayFactory;

    public function __construct(MessageSenderFactory $messageSenderFactory, PaymentGatewayFactory $paymentGatewayFactory)
    {
        $this->messageSenderFactory = $messageSenderFactory;
        $this->paymentGatewayFactory = $paymentGatewayFactory;
    }

    public function index(Request $request): void
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
            $messageSender = $this->messageSenderFactory->create($type);
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
            $paymentGateway = $this->paymentGatewayFactory->create($gateway);
            
            if ($paymentGateway instanceof StripeInterface) {
               
                // Handle additional functionality for Stripe payment gateway
                $paymentGateway->deposit(100); echo '<br/>';
                $paymentGateway->withdraw(100);
            }

            $gateway = "amarpay";
            $paymentGateway = $this->paymentGatewayFactory->create($gateway);
            $paymentGateway->charge(209);
            $paymentGateway->refund(50);
            if($paymentGateway instanceof AmarpayInterface){
                $paymentGateway->exchange(34);
                $paymentGateway->contvertCurrency(340);
            }

        } catch (InvalidArgumentException $e) {
           echo $e->getMessage();
        }
    }
}
