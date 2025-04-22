<?php
namespace Models;

use Core\App;
use Core\Database;

class AddStudent {
    public static function create_student($registration_number, $course, $email, $name, $index_number,$hashedPassword)
    {
        $db = App::resolve(Database::class);

        // Insert into users table first
        $db->query('INSERT INTO users (email, role,name, password) VALUES (?, ?, ?,?)', [
            $email,
            2,
            $name,
            $hashedPassword
        ]);

        // Get the last inserted user ID
        $user_id = $db->lastInsertId();

        // Insert into students table
        $db->query('INSERT INTO students (id,registration_number, course, index_number) VALUES (?, ?, ?, ?)', [
            $user_id,
            $registration_number,
            $course,
            $index_number,
           
        ]);
    }

  

    public static function update_student($registration_number, $course, $email, $name, $index_number, $user_id){
        $db = App::resolve(Database::class);

        // Update students table
        $db->query('UPDATE students SET registration_number = ?, course = ?, index_number = ? WHERE id = ?', [
            $registration_number,
            $course,
            $index_number,
            $user_id
        ]);

        // Update users table
        $db->query('UPDATE users SET email = ?, name = ? WHERE id = ?', [
            $email,
            $name,
            $user_id
        ]);
    }

    public static function delete_student($user_id){
        $db = App::resolve(Database::class);
    
        // Delete the student entry first
        $db->query('DELETE FROM users WHERE id = ?', [$user_id]);
    
        // Then delete the user entry
        $db->query('DELETE FROM students WHERE id = ?', [$user_id]);

        return true;
    }

    // Check for duplicates in students table
    public static function fetch_student()
    {
        $db = App::resolve(Database::class);

        $result = $db->query('SELECT s.*,u.* FROM students s JOIN users u on s.id = u.id',[])->get();
        
        return $result; // Returns a row if a duplicate exists, false otherwise
    }

    public static function disable_student($id)
    {
        $db = App::resolve(Database::class);

        $db->query('UPDATE users SET disabled = ? WHERE id = ?', [1, $id]);

        
    }

    public static function fetch_hired_students()
    {
        $db = App::resolve(Database::class);

        $result = $db->query(
            "SELECT 
                su.name AS student_name,
                s.registration_number,
                s.course,
                cu.name AS company_name,
                ir.name AS job_role
            FROM applications a
            JOIN students s ON a.student_id = s.id
            JOIN users su ON s.id = su.id
            JOIN advertisements ad ON a.ad_id = ad.id
            JOIN users cu ON ad.company_id = cu.id
            JOIN internship_roles ir ON ad.internship_role_id = ir.id
            WHERE a.selected = true",
            []
        )->get();


        return $result; // Returns a row if a duplicate exists, false otherwise
    }
}