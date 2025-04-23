<?php

namespace Models;

use Core\App;
use Core\Database;

class PdcRounds
{
    public static function deleteRound($id)
    {
        $db = App::resolve(Database::class);
        return $db->query('DELETE FROM rounds WHERE id = ?', [$id]);
    }

    public static function getAllRounds()
    {
        $db = App::resolve(Database::class);
        return $db->query('SELECT * FROM rounds', [])->get();
    }

    public static function createRound($roundName, $startdate, $enddate)
{
    $db = App::resolve(Database::class);

    $today = date('Y-m-d');
    $isRestricted = ($today >= $startdate && $today <= $enddate) ? 'false' : 'true';

    $result = $db->query(
        'INSERT INTO rounds (round_name, start_date, end_date, restricted) VALUES (?, ?, ?, ?)',
        [
            $roundName,
            $startdate,
            $enddate,
            $isRestricted
        ]
    );

    return $result ? true : false;
}

    public static function updateRound($id, $roundName, $startdate, $enddate)
    {
        $db = App::resolve(Database::class);
        return $db->query('UPDATE rounds SET round_name = ?, start_date = ?, end_date = ? WHERE id = ?', [
            $roundName,
            $startdate,
            $enddate,
            $id,
        ]);
    }
}
