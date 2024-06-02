<?php

namespace App\Test;

use Illuminate\Support\Facades\Mail;

class PostcardSedingService
{
    /**
     * Create a new class instance.
     */
    private $country;
    private $width;
    private $height;
    public function __construct($country, $width, $height)
    {
        $this->country = $country;
        $this->width = $width;
        $this->height = $height;
    }

    public function hello($message,$email){
        Mail::raw($message, function ($message) use ($email) {
            $message->to($email);
        });

        //Mail out postcard thorugh some service
        dump('Postcard sent!' . $message);
    }
}
