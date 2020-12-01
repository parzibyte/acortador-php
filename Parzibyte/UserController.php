<?php

namespace Parzibyte;

class UserController
{
    static function create($email, $password)
    {
        $hashedPassword = Security::hashPassword($password);
        $db = Database::get();
        $statement = $db->prepare("INSERT INTO users(email, password) VALUES (?, ?)");
        $statement->execute([$email, $hashedPassword]);
    }

    static function auth($email, $password)
    {
        $user = self::getOneByEmail($email);
        if (!$user) {
            return false;
        }
        return Security::verifyPassword($password, $user->password);
    }

    static function getOneByEmail($email)
    {
        $db = Database::get();
        $statement = $db->prepare("SELECT id, email, password FROM users WHERE email = ?");
        $statement->execute([$email]);
        return $statement->fetchObject();
    }
}
