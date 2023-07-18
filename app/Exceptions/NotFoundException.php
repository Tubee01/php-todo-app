<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class NotFoundException extends Exception
{
    public function __construct(
        string     $message = 'not_found',
        int        $code = Response::HTTP_NOT_FOUND,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
