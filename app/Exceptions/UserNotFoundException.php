<?php

namespace App\Exceptions;

use Exception;

/**
 * UserNotFoundException.
 *
 * @author Marco Pedraza <mpdrza@gmail.com>
 */
class UserNotFoundException extends Exception
{
    protected $message = 'User object not found';
}