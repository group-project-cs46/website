<?php
namespace Models;

use Core\App;
use Core\Database;
use Exception;
use PDOException;

class AddStudent {
    
    public static function create_student($registration_number, $course, $email, $name, $index_number, $hashedPassword)
    {
        $db = App::resolve(Database::class);

        try {
            // Check if email already exists
            $existingUser = $db->query('SELECT id FROM users WHERE email = ?', [$email])->find();
            if ($existingUser) {
                throw new Exception("A user with the email '$email' already exists.");
            }

            $existingStudent = $db->query('SELECT id FROM students WHERE index_number = ?', [$index_number])->find();
            if ($existingStudent) {
                throw new Exception("A student with the index number '$index_number' already exists.");
            }

            $existingregistrationno = $db->query('SELECT id FROM students WHERE registration_number = ?', [$registration_number])->find();
            if ($existingregistrationno) {
                throw new Exception("A student with the index number '$registration_number' already exists.");
            }

            if (!ctype_digit($index_number)) {
                throw new Exception("The index number must contain only numbers.");
            }


            // Insert into users table
            $db->query('INSERT INTO users (email, role, name, password, disabled, approved) VALUES (?, ?, ?, ?, ?, ?)', [
                $email,
                2,
                $name,
                $hashedPassword,
                0,
                1
            ]);

            // Get the last inserted user ID
            $user_id = $db->lastInsertId();

            // Insert into students table
            $db->query('INSERT INTO students (id, registration_number, course, index_number) VALUES (?, ?, ?, ?)', [
                $user_id,
                $registration_number,
                $course,
                $index_number
            ]);
        } catch (PDOException $e) {
            // PostgreSQL unique violation error code is 23505
            if ($e->getCode() == '23505') {
                throw new Exception("A user with the email '$email' already exists.");
            }
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    

  

    public static function update_student($registration_number, $course, $email, $name, $index_number, $user_id)
{
    $db = App::resolve(Database::class);

    try {
        // Check if email already exists for another user
        $existingUser = $db->query('SELECT id FROM users WHERE email = ? AND id != ?', [$email, $user_id])->find();
        if ($existingUser) {
            throw new Exception("A user with the email '$email' already exists.");
        }

        // Check if index_number already exists for another student
        $existingStudent = $db->query('SELECT id FROM students WHERE index_number = ? AND id != ?', [$index_number, $user_id])->find();
        if ($existingStudent) {
            throw new Exception("A student with the index number '$index_number' already exists.");
        }

        // Check if registration_number already exists for another student
        $existingRegistrationNo = $db->query('SELECT id FROM students WHERE registration_number = ? AND id != ?', [$registration_number, $user_id])->find();
        if ($existingRegistrationNo) {
            throw new Exception("A student with the registration number '$registration_number' already exists.");
        }

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

    } catch (PDOException $e) {
        if ($e->getCode() == '23505') { // Unique violation
            throw new Exception("A user with the email '$email' already exists.");
        }
        throw new Exception("Database error: " . $e->getMessage());
    }
}


    public static function delete_student($user_id){
        $db = App::resolve(Database::class);
    
        // Delete the student entry first
        $db->query('DELETE FROM users WHERE id = ?', [$user_id]);
    
        // Then delete the user entry
        $db->query('DELETE FROM students WHERE id = ?', [$user_id]);

        return true;
    }

    public static function student_exists($email, $index_number, $registration_number) {
        $db = App::resolve(Database::class);
        
        $query = 'SELECT COUNT(*) 
                  FROM users u
                  LEFT JOIN students s ON u.id = s.id 
                  WHERE u.email = ? OR s.index_number = ? OR s.registration_number = ?';
        $result = $db->query($query, [$email, $index_number, $registration_number])->fetchColumn();
        
        return $result > 0;
    }

    // Check for duplicates in students table
    public static function fetch_student()
    {
        $db = App::resolve(Database::class);

        $result = $db->query('SELECT s.*,u.*,a.selected AS application_status

         FROM students s JOIN users u on s.id = u.id
         LEFT JOIN applications a ON s.id = a.student_id
         ORDER BY u.name ASC',[])->get();
        
        return $result; // Returns a row if a duplicate exists, false otherwise
    }

    public static function disable_student($id)
    {
        $db = App::resolve(Database::class);

        $db->query('UPDATE users SET disabled = ? WHERE id = ?', [1, $id]);

        
    }

    public static function enable_student($id)
    {
        $db = App::resolve(Database::class);

        $db->query('UPDATE users SET disabled = ? WHERE id = ?', [0, $id]);

        
    }

    public static function fetch_hired_students()
    {
        $db = App::resolve(Database::class);

        $result = $db->query(
            "SELECT 
                a.selected AS application_status,
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
            WHERE a.selected = true
            ORDER BY student_name ASC",
            []
        )->get();


        return $result; // Returns a row if a duplicate exists, false otherwise
    }
}