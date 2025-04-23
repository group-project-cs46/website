<?php

namespace Models;

use Core\App;
use Core\Database;

class pdcCompanyvisit
{
    public static function fetchAll()
{
    $db = App::resolve(Database::class);

    $visits = $db->query('
        SELECT
            lv.*,
            uc.name AS company_name,
            ul.name AS lecturer_name
        FROM lecturer_visits lv
        LEFT JOIN users uc ON lv.company_id = uc.id
        LEFT JOIN users ul ON lv.lecturer_id = ul.id
    ', [])->get();

    return $visits;
}


public static function create_visit($company_id, $date, $time, $status = 'Scheduled')
{
    $db = App::resolve(Database::class);

    $result = $db->query('INSERT INTO lecturer_visits (company_id, date, time, status) VALUES (?, ?, ?, ?)', [
        $company_id,
        $date,
        $time,
        $status
    ]);

    return $result !== false ? $db->lastInsertId() : false;
}

    public static function edit_visit($id, $date, $time)
    {
        $db = App::resolve(Database::class);
        

        return $db->query('UPDATE lecturer_visits SET date = ?, time = ? WHERE id = ?', [
            $date,
            $time,
            $id
        ]);
    }

    public static function delete_visit($id)
    {
        $db = App::resolve(Database::class);
        
        return $db->query('DELETE FROM lecturer_visits WHERE id = ?', [
            $id
        ]);
    }
}
