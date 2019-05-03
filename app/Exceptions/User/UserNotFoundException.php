<?php

namespace App\Exceptions\User;

class UserNotFoundException extends \Exception
{
    public $message = 'User not found.';
}
