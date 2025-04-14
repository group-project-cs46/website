<?php

namespace Models;

use Core\App;
use Core\Database;

class pdc_studentreport
{
    public static function fetchAll()
    {
        $db = App::resolve(Database::class);
        return $db->query('
            SELECT 
                cs.*, 
                company.name AS company_name, 
                student.name AS student_name
            FROM company_student_reports cs
            JOIN users company ON cs.company_id = company.id
            JOIN users student ON cs.student_id = student.id
        ', [])->get();
    }
    

public static function fetchById($id)
{
    $db = App::resolve(Database::class);
    return $db->query('
        SELECT 
            company_student_reports.*, 
            users.company_name 
        FROM company_student_reports 
        JOIN companies ON company_student_reports.company_id = companies.id
        JOIN users ON companies.id = users.id
        WHERE company_student_reports.id = ?
    ', [$id])->find();
}


    public static function delete($id)
    {
        $db = App::resolve(Database::class);
        $db->query('DELETE FROM company_student_reports WHERE id = ?', [$id]);
    }
}