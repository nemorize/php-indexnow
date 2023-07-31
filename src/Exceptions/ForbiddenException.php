<?php

namespace Nemorize\Indexnow\Exceptions;

use Throwable;

class ForbiddenException extends IndexnowException
{
    public function __construct ()
    {
        parent::__construct('403 Forbidden. Commonly it means "In case of key not valid (e.g. key not found, file found but key not in the file)"', 400);
    }
}