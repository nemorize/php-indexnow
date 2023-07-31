<?php

namespace Nemorize\Indexnow\Exceptions;

use Throwable;

class TooManyRequestsException extends IndexnowException
{
    public function __construct ()
    {
        parent::__construct('429 Too May Requests. Commonly it means "Too Many Requests (potential Spam)"', 400);
    }
}