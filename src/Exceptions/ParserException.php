<?php declare(strict_types=1);

namespace Zafkiel\Exceptions;

use \Exception;

class ParserException extends Exception
{
    public function __construct($message, $code = 0, \Throwable $previous = null) {
        // some code

        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    public function displayMessage()
    {
        
    }
}