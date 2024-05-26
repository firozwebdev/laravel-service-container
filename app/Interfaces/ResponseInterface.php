<?php

namespace App\Interfaces;

interface ResponseInterface
{
    public function success($message);
    public function notFound($message);
}
