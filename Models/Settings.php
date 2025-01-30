<?php

namespace Models;

use Core\App;
use Core\Database;

class Settings
{
    public static function getValueByKey($key)
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT value FROM settings WHERE key = ?', [$key])->find();
    }
}