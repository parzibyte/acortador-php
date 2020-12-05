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

class StatisticsController
{

    static function getClickCountByDateAndLink($linkId, $start, $end)
    {
        $db = Database::get();
        $statement = $db->prepare("SELECT date, count(*) as clicks FROM statistics
        WHERE date >= ? AND date <= ?
        AND link_id = ?
        GROUP BY date");
        $statement->execute([$start, $end, $linkId]);
        return $statement->fetchAll();
    }

    static function getMostClickedLinksOfAllTime()
    {
        $db = Database::get();
        $statement = $db->query("SELECT links.title, count(*) AS clicks
        FROM statistics INNER JOIN links ON links.id = link_id
        GROUP BY link_id, title 
        ORDER BY clicks DESC LIMIT 10");
        return $statement->fetchAll();
    }

    static function getMostClickedLinksByDate($start, $end)
    {
        $db = Database::get();
        $statement = $db->prepare("SELECT links.title, count(*) AS clicks
        FROM statistics INNER JOIN links ON links.id = link_id
        WHERE date >= ? AND date <= ?
        GROUP BY link_id, title 
        ORDER BY clicks DESC LIMIT 10");
        $statement->execute([$start, $end]);
        return $statement->fetchAll();
    }

    static function getClickCountByDate($start, $end)
    {
        $db = Database::get();
        $statement = $db->prepare("SELECT date, count(*) as clicks FROM statistics
        WHERE date >= ? AND date <= ?
        GROUP BY date");
        $statement->execute([$start, $end]);
        return $statement->fetchAll();
    }

    static function registerClick($linkId)
    {
        $db = Database::get();
        $statement = $db->prepare("INSERT INTO statistics(link_id, date) VALUES (?, ?)");
        $statement->execute([$linkId, date("Y-m-d")]);
    }
}
