<?php

namespace Models;

use Core\App;
use Core\Database;

class Round
{
    public static function currentRound()
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT * FROM rounds WHERE CURRENT_DATE BETWEEN start_date AND end_date', [])->find();
    }
}