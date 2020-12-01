<?php

namespace Parzibyte;

class Security
{
    static function hashPassword($password)
    {
        return password_hash(self::preparePlainPassword($password), PASSWORD_BCRYPT);
    }

    static function verifyPassword($password, $hash)
    {
        return password_verify(self::preparePlainPassword($password), $hash);
    }

    static function preparePlainPassword($password)
    {
        return hash("sha256", $password);
    }
}
