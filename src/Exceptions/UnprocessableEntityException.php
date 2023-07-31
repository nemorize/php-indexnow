<?php

namespace Nemorize\Indexnow\Exceptions;

use Throwable;

class UnprocessableEntityException extends IndexnowException
{
    public function __construct ()
    {
        parent::__construct('422 Unprocessable Entity. Commonly it means "In case of URLs which don\'t belong to the host or the key is not matching the schema in the protocol"', 400);
    }
}