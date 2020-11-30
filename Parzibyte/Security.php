<?php

namespace Parzibyte;

class Security
{
    static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    static function preparePlainPassword($password)
    {
        return hash("sha256", $password);
    }
}
