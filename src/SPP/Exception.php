<?php

namespace SPP;

class Exception extends \Exception
{
    public function __construct($message)
    {
        $this->message = $message;
    }
}

?>