<?php
/*

  ____          _____               _ _           _       
 |  _ \        |  __ \             (_) |         | |      
 | |_) |_   _  | |__) |_ _ _ __ _____| |__  _   _| |_ ___ 
 |  _ <| | | | |  ___/ _` | '__|_  / | '_ \| | | | __/ _ \
 | |_) | |_| | | |  | (_| | |   / /| | |_) | |_| | ||  __/
 |____/ \__, | |_|   \__,_|_|  /___|_|_.__/ \__, |\__\___|
         __/ |                               __/ |        
        |___/                               |___/         
    
____________________________________
/ Si necesitas ayuda, contáctame en \
\ https://parzibyte.me               /
 ------------------------------------
        \   ^__^
         \  (oo)\_______
            (__)\       )\/\
                ||----w |
                ||     ||
Creado por Parzibyte (https://parzibyte.me).
------------------------------------------------------------------------------------------------
Si el código es útil para ti, puedes agradecerme siguiéndome: https://parzibyte.me/blog/sigueme/
Y compartiendo mi blog con tus amigos
También tengo canal de YouTube: https://www.youtube.com/channel/UCroP4BTWjfM0CkGB6AFUoBg?sub_confirmation=1
------------------------------------------------------------------------------------------------
*/ ?>
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
