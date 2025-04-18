<?php

namespace Models;

use Core\App;
use Core\Database;

class AddLecturer
{
    public static function create($employee_id, $title, $email, $name, $contact_no, $password)
    {
        $db = App::resolve(Database::class);

        $db->query('INSERT INTO users(name,email,mobile,password,role,approved) VALUES (?, ?, ?, ?, ?, ?)', [
            $name,
            $email,
            $contact_no,
            password_hash($password, PASSWORD_DEFAULT),
            5,
            1
        ]);

        $id = $db->getLastInsertedId();

        $db->query('INSERT INTO lecturers(employee_id, title, id) VALUES (?, ?, ?)', [
            $employee_id,
            $title,
            $id
        ]);
    }

    public static function get_all()
    {
        $db = App::resolve(Database::class);
        $result =  $db->query('SELECT u.*, p.* FROM users as u INNER JOIN lecturers as p ON u.id=p.id', []);
        return $result->get();
    }

    public static function get_by_id(string $id)
    {
        $db = App::resolve(Database::class);
        $result =  $db->query('SELECT u.*, p.* FROM users as u INNER JOIN lecturers as p ON u.id=p.id WHERE u.id=?', [$id]);
        $data = $result->get();
        if (empty($data)) {
            return null;
        }
        return $data[0];
    }

    // public static function update_pdc($employee_id, $title, $pdcname, $contact_no, $email)
    // {
    //     $db = App::resolve(Database::class);

    //     $db->query('UPDATE pdc SET title=?, pdcname=?, contact_no=?,email=? WHERE employee_id=?', [
    //         $title,
    //         $pdcname,
    //         $contact_no,
    //         $email,
    //         $employee_id,
    //     ]);
    // }

    public static function update($id, $name, $email, $employee_id, $contact, $title, $password)
    {
        $data = [
            $name,
            $email,
            $contact
        ];
        $sql = "";

        if (!empty(trim($password))) {
            array_push($data, password_hash($password, PASSWORD_DEFAULT));
            $sql = "UPDATE users SET name=?, email=?, mobile=?, password=? WHERE id=?";
        } else {
            $sql = "UPDATE users SET name=?, email=?, mobile=? WHERE id=?";
        }

        array_push($data, $id);

        $db = App::resolve(Database::class);
        $db->query($sql, $data);

        $data = [
            $employee_id,
            $title,
            $id
        ];

        $db->query('UPDATE lecturers SET employee_id=?,title=? WHERE id=?', $data);
    }

    public static function delete($id)
    {
        $db = App::resolve(Database::class);

        // dont have to delete from pdc table as the foriegn key constraint stands for CASCADE mode.
        $db->query('DELETE FROM users WHERE id=?', [
            $id,
        ]);
    }

    public static function toggle_status($id)
    {
        $db = App::resolve(Database::class);
    
        // Get current status
        $result = $db->query('SELECT approved FROM users WHERE id = ?', [$id])->get();
    
        if (empty($result)) return;
    
        $current = $result[0]['approved'];
        $new = $current ? 0 : 1;
    
        $db->query('UPDATE users SET approved = ? WHERE id = ?', [$new, $id]);
    }
}
