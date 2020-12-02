<?php

namespace Parzibyte;

class UserController
{

    static function delete($id)
    {
        $db = Database::get();
        $statement = $db->prepare("DELETE FROM users WHERE id = ?");
        $statement->execute([$id]);
    }

    static function updatePassword($id, $password)
    {
        $hashedPassword = Security::hashPassword($password);
        $db = Database::get();
        $statement = $db->prepare("UPDATE users SET password = ? WHERE id = ?");
        $statement->execute([$hashedPassword, $id]);
    }

    static function getOneById($id)
    {
        $db = Database::get();
        $statement = $db->prepare("SELECT id, email, password FROM users WHERE id = ?");
        $statement->execute([$id]);
        return $statement->fetchObject();
    }
    static function getAll()
    {
        $db = Database::get();
        $statement = $db->query("SELECT id, email, password FROM users");
        return $statement->fetchAll();
    }
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

    static function authById($id, $password)
    {
        $user = self::getOneById($id);
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
