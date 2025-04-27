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
            lv.id AS visit_id, -- Explicitly select and alias the id from lecturer_visits
            lv.company_id,
            lv.time,
            lv.visited,
            lv.date,
            
            lv.batch_id,
            lv.approved,
            lv.rejected,
            lvl.id AS lecturer_visit_id, -- Alias the id from lecture_visit_lecturers
            lvl.lecturer_id,
            lvr.reason AS lecturer_reason,
            uc.name AS company_name,
            ul.name AS lecturer_name
        FROM lecturer_visits lv
        LEFT JOIN users uc ON lv.company_id = uc.id
        LEFT JOIN lecture_visit_lecturers lvl ON lv.id = lvl.lecturer_visit_id
        LEFT JOIN users ul ON lvl.lecturer_id = ul.id
        LEFT JOIN lecturer_visit_rejected_reasons lvr ON lv.id = lvr.lecturer_visit_id
        WHERE lv.id IS NOT NULL
    ', [])->get();

    return $visits;
}

    public static function create_visit($company_id, $date, $time, $lecturer_id)
    {
        $db = App::resolve(Database::class);

        // Insert into lecturer_visits
        $result = $db->query('INSERT INTO lecturer_visits (company_id, date, time) VALUES (?, ?, ?)', [
            $company_id,
            $date,
            $time
        ]);

        if ($result === false) {
            throw new \Exception('Failed to insert into lecturer_visits');
        }

        $visit_id = $db->lastInsertId();

        // Insert into lecture_visit_lecturers
        $lecturer_result = $db->query('INSERT INTO lecture_visit_lecturers (lecturer_visit_id, lecturer_id) VALUES (?, ?)', [
            $visit_id,
            $lecturer_id
        ]);

        if ($lecturer_result === false) {
            // If the second insert fails, attempt to clean up by deleting the visit
            $db->query('DELETE FROM lecturer_visits WHERE id = ?', [$visit_id]);
            throw new \Exception('Failed to insert into lecture_visit_lecturers');
        }

        return $visit_id;
    }

    public static function edit_visit($id, $date, $time, $lecturer_id)
{
    $db = App::resolve(Database::class);

    // Update lecturer_visits
    $visit_statement = $db->query('UPDATE lecturer_visits SET date = ?, time = ? WHERE id = ?', [
        $date,
        $time,
        $id
    ]);

    if ($visit_statement === false) {
        throw new \Exception('Failed to update lecturer_visits');
    }

    // Check if a record exists in lecture_visit_lecturers
    $existing = $db->query('SELECT * FROM lecture_visit_lecturers WHERE lecturer_visit_id = ?', [$id])->find();

    if ($existing) {
        // Update the existing lecturer
        $lecturer_statement = $db->query('UPDATE lecture_visit_lecturers SET lecturer_id = ? WHERE lecturer_visit_id = ?', [
            $lecturer_id,
            $id
        ]);
    } else {
        // Insert a new record if none exists
        $lecturer_statement = $db->query('INSERT INTO lecture_visit_lecturers (lecturer_visit_id, lecturer_id) VALUES (?, ?)', [
            $id,
            $lecturer_id
        ]);
    }

    if ($lecturer_statement === false) {
        throw new \Exception('Failed to update/insert into lecture_visit_lecturers');
    }

    return true;
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

        return $lecturers;
    }

    public static function delete_visit($id)
    {
        $db = App::resolve(Database::class);

        // Delete from lecture_visit_lecturers
        $lecturer_statement = $db->query('DELETE FROM lecture_visit_lecturers WHERE lecturer_visit_id = ?', [$id]);

        if ($lecturer_statement === false) {
            throw new \Exception('Failed to delete from lecture_visit_lecturers');
        }

        // Delete from lecturer_visits
        $visit_statement = $db->query('DELETE FROM lecturer_visits WHERE id = ?', [$id]);

        if ($visit_statement === false) {
            throw new \Exception('Failed to delete from lecturer_visits');
        }

        return true;
    }
}