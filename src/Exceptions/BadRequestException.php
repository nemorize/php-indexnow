<?php

namespace Nemorize\Indexnow\Exceptions;

use Throwable;

class BadRequestException extends IndexnowException
{
    public function __construct ()
    {
        parent::__construct('400 Bad Request. Commonly it means "Invalid format"', 400);
    }
}