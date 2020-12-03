<?php

namespace Parzibyte;

class StatisticsController
{
    static function registerClick($linkId)
    {
        $db = Database::get();
        $statement = $db->prepare("INSERT INTO statistics(link_id, date) VALUES (?, ?)");
        $statement->execute([$linkId, date("Y-m-d")]);
    }
}
