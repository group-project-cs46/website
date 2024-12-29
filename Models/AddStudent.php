<?php
namespace Models;

use Core\App;
use Core\Database;

class AddStudent {
    public static function create_student($regno, $course, $email, $stuname, $indexno)
    {
        $db = App::resolve(Database::class);

        $db->query('INSERT INTO students (regno, course, email, stuname, indexno) VALUES (?, ?, ?, ?, ?)', [
            $regno,
            $course,
            $email,
            $stuname,
            $indexno
        ]);
    }

    public static function create_user($name, $email, $password)
    {
        $db = App::resolve(Database::class);

        $db->query('INSERT INTO users (name, email, password) VALUES (?, ?, ?)', [
            $name,
            $email,
            $password
        ]);
    }

    public static function update_student($regno, $course, $email, $stuname, $indexno,$id){
        $db = App::resolve(Database::class);

        $db->query('UPDATE students SET regno = ?, course = ?, email = ?, stuname = ?, indexno = ? WHERE id = ?', [
            $regno,
            $course,
            $email,
            $stuname,
            $indexno,
            $id
        ]);
    }

    public static function delete_student($id){
        $db = App::resolve(Database::class);

        $db->query('DELETE FROM students WHERE id = ?', [$id]);
    }

    // check for duplicates
    public static function check_duplicate($indexno, $regno)
    {
        $db = App::resolve(Database::class);

        $result = $db->query('SELECT * FROM students WHERE indexno = ? OR regno = ?', [$indexno, $regno]);

        return $result->fetch();//returns a row if duplicate exists , false otherwise
    }
    
}
