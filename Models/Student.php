<?php

namespace Models;

use Core\App;
use Core\Database;

class Student
{

    public static function findByUserId($id)
    {
        $db = App::resolve(Database::class);


        $cvs = $db->query('SELECT * FROM cvs WHERE user_id = ?', [$id])->get();

        return $cvs;
    }

    public static function find($id)
    {
        $db = App::resolve(Database::class);
        return $db->query('SELECT * FROM students WHERE id = ?', [$id])->get();
    }

    public static function update($attributes, $id)
    {
        $db = App::resolve(Database::class);

        // Step 1: Get current student data
        $current = $db->query('SELECT * FROM students WHERE id = ?', [$id])->find();
        if (!$current) {
            return null;
        }

        // Step 2: Merge given attributes with current values
        $registration_number = $attributes['registration_number'] ?? $current['registration_number'];
        $course              = $attributes['course']              ?? $current['course'];
        $index_number        = $attributes['index_number']        ?? $current['index_number'];
        $website             = $attributes['website']             ?? $current['website'];

        // Step 3: Run the update
        $db->query(
            'UPDATE students SET registration_number = ?, course = ?, index_number = ?, website = ? WHERE id = ?',
            [$registration_number, $course, $index_number, $website, $id]
        );
    }

    public static function getSelectedForCompany($companyId)
    {
        $db = App::resolve(Database::class);

        $currentBatch = Batch::currentBatch();

        return $db->query('
            SELECT
                applications.*,
                advertisements.batch_id,
                advertisements.company_id,
                students.index_number,
	            users.name
            FROM applications
            LEFT JOIN advertisements ON applications.ad_id = advertisements.id
            LEFT JOIN students ON applications.student_id = students.id
            LEFT JOIN users ON users.id = applications.student_id
            WHERE
                applications.selected = TRUE
                AND advertisements.batch_id = ?
                AND advertisements.company_id = ?
        ', [$currentBatch['id'], $companyId])->get();
    }
}