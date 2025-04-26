<?php

namespace Models;

use Core\App;
use Core\Database;

class pdc_studentreport
{
    public static function fetchStudentreports()
{
    $db = App::resolve(Database::class);
    return $db->query('
        SELECT 
            r.*,
            u.name AS sender_name,
            s.name AS subject_name,
            students.index_number,
            TO_CHAR(r.created_at, \'YYYY-MM-DD\') AS created_date
            
        FROM 
            reports r
        JOIN 
            users u ON r.sender_id = u.id
        JOIN 
            users s ON r.subject_id = s.id
        JOIN
            students ON r.sender_id = students.id
        JOIN 
            roles ON u.role = roles.id
        WHERE
            u.role = 2
        ORDER BY r.created_at DESC
    ', [])->get();
}

public static function fetchCompanyreports()
{
    $db = App::resolve(Database::class);
    return $db->query('
        SELECT 
            r.*,
            u.name AS sender_name,
            s.name AS subject_name,
            TO_CHAR(r.created_at, \'YYYY-MM-DD\') AS created_date
            
        FROM 
            reports r
        JOIN 
            users u ON r.sender_id = u.id
        JOIN 
            users s ON r.subject_id = s.id
        JOIN 
            roles ON u.role = roles.id
        WHERE
            u.role = 4
        ORDER BY r.created_at DESC
    ', [])->get();
}


    public static function findById($id)
    {
        $db = App::resolve(Database::class);
        return $db->query('SELECT * FROM reports WHERE id = ?', [$id])->find();

    }

    public static function delete($id)
    {
        $db = App::resolve(Database::class);
        $db->query('DELETE FROM reports WHERE id = ?', [$id]);
    }
}





// {
//     public static function fetchAll()
// {
//     $db = App::resolve(Database::class);
//     return $db->query('
//         SELECT 
//             cs.*, 
//             users.name AS company_name
//         FROM company_student_reports cs
//         JOIN users ON cs.company_id = users.id
//     ', [])->get();
// }

   

// public static function fetchById($id)
// {
//     $db = App::resolve(Database::class);
//     return $db->query('
//         SELECT 
//             company_student_reports.*, 
//             users.name AS company_name
//         FROM company_student_reports 
//         JOIN users ON company_student_reports.company_id = users.id
//         WHERE company_student_reports.id = ?
//     ', [$id])->find();
// }


//     public static function delete($id)
//     {
//         $db = App::resolve(Database::class);
//         $db->query('DELETE FROM company_student_reports WHERE id = ?', [$id]);
//     }
// }