<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Interfaces\MessageSenderInterface;
use App\Interfaces\PaymentGatewayInterface;
use App\Interfaces\ResponseInterface;

class UserController extends Controller
{
    public function index(ResponseInterface $response)
    {
        $emailService = app(MessageSenderInterface::class)->get('email');
        $emailService->send('test@gmail.com','Email message');
        //echo $response->success("Email Sent");
        echo ', ';
        $response->success("Email Sent");
        echo '<br/>';

        $bkash = app(PaymentGatewayInterface::class)->get('bikash');
        $bkash->charge(50);
        echo '<br>';
        $bkash->refund(40); 
        echo '<br>';

        $smsService = app(MessageSenderInterface::class)->get('sms');
        $smsService->send('01754165234','Sms message');
        //echo $response->success("SMS Sent");
        echo ', ';
        $response->success("SMS Sent");
        echo '<br>';

        $nagad = app(PaymentGatewayInterface::class)->get('nagad');
        $nagad->charge(58); 
        echo '<br>';
        $nagad->refund(41);
        
    }
}
