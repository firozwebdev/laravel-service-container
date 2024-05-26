<?php

namespace App\Services;

use App\Interfaces\ResponseInterface;

class ResponseService implements ResponseInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function success($message)
    {
       echo $message;
    }

    public function notFound($message)
    {
       echo $message;
    }
}
