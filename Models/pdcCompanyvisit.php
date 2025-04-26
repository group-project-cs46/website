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
            lvl.*,
            lvr.reason AS lecturer_reason,
            uc.name AS company_name,
            ul.name AS lecturer_name
        FROM lecturer_visits lv
        LEFT JOIN users uc ON lv.company_id = uc.id
        LEFT JOIN lecture_visit_lecturers lvl ON lv.id = lvl.lecturer_visit_id
        LEFT JOIN users ul ON lvl.lecturer_id = ul.id
        LEFT JOIN lecturer_visit_rejected_reasons lvr ON lv.id = lvr.lecturer_visit_id
    ', [])->get();

    return $visits;
}



    public static function create_visit($company_id, $date, $time)
    {
        $db = App::resolve(Database::class);

        $result = $db->query('INSERT INTO lecturer_visits (company_id, date, time) VALUES (?, ?, ?)', [
            $company_id,
            $date,
            $time
        ]);

        return $result !== false ? $db->lastInsertId() : false;
    }


    public static function edit_visit($id, $date, $time)
    {
        $db = App::resolve(Database::class);

        $statement = $db->query('UPDATE lecturer_visits SET date = ?, time = ? WHERE id = ?', [
            $date,
            $time,
            $id
        ]);

        return $statement->rowCount() > 0;
    }

    public static function fetchAlllecturers()
    {
        $db = App::resolve(Database::class);

        $lecturers = $db->query('
            SELECT
                ul.id,
                ul.name
            FROM users ul
            WHERE ul.role = 5
        ', [])->get();

    }
   
    public static function delete_visit($id)
    {
        $db = App::resolve(Database::class);

        return $db->query('DELETE FROM lecturer_visits WHERE id = ?', [
            $id
        ]);
    }
}
