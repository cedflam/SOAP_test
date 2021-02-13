<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Validator\Constraints\Email;

class HelloService
{

    public function __construct()
    {

    }

    public function hello($name): string
    {
        return 'Hello, ' . $name;
    }
}
