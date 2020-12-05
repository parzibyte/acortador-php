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

class LinkController
{
    static $HASH_LENGTH = 6;

    static function getOneByHash($hash)
    {
        $db = Database::get();
        $statement = $db->prepare("SELECT id, hash, title, real_link, instant_redirect FROM links WHERE hash = ?");
        $statement->execute([$hash]);
        return $statement->fetchObject();
    }
    static function delete($id)
    {
        $db = Database::get();
        $statement = $db->prepare("DELETE FROM links WHERE id = ?");
        return $statement->execute([$id]);
    }

    static function update($id, $title, $realLink, $instantRedirect)
    {
        $db = Database::get();
        $statement = $db->prepare("UPDATE links SET title = ?, real_link = ?, instant_redirect = ? WHERE id = ?");
        return $statement->execute([$title, $realLink, $instantRedirect, $id]);
    }

    static function getOne($id)
    {
        $db = Database::get();
        $statement = $db->prepare("SELECT id, hash, title, real_link, instant_redirect FROM links WHERE id = ?");
        $statement->execute([$id]);
        return $statement->fetchObject();
    }

    static function getAll()
    {
        $db = Database::get();
        $statement = $db->query("SELECT id, hash, title, real_link, instant_redirect FROM links");
        return $statement->fetchAll();
    }

    static function search($search)
    {
        $db = Database::get();
        $statement = $db->prepare("SELECT id, hash, title, real_link, instant_redirect FROM links WHERE title LIKE ? OR real_link LIKE ?");
        $statement->execute(["%$search%", "%$search%"]);
        return $statement->fetchAll();
    }
    static function add($title, $realLink, $instantRedirect)
    {
        $hash = self::getUniqueHash();
        $db = Database::get();
        $statement = $db->prepare("INSERT INTO links(hash, title, real_link, instant_redirect) VALUES (?, ?, ?, ?)");
        return $statement->execute([$hash, $title, $realLink, $instantRedirect]);
    }

    static function getUniqueHash()
    {
        do {
            $hash = self::getRandomString(self::$HASH_LENGTH);
        } while (self::hashExists($hash));
        return $hash;
    }

    static function hashExists($hash)
    {
        $db = Database::get();
        $statement = $db->prepare("SELECT id FROM links WHERE hash = ? LIMIT 1");
        $statement->execute([$hash]);
        return $statement->fetchObject() != null;
    }

    static function getRandomString($length)
    {
        $source = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        return substr(str_shuffle($source), 0, $length);
    }
}
