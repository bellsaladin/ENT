<?php

namespace Bse\CandidatureBundle\Service;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class CustomEncoder implements PasswordEncoderInterface
{

    public function encodePassword($raw, $salt)
    {
        return md5($raw); // using MD5 for password encrypt
    }

    public function isPasswordValid($encoded, $raw, $salt)
    {
        return $encoded === $this->encodePassword($raw, $salt);
    }

}
