<?php

namespace Models;

use Core\App;
use Core\Database;

class AddPdc
{
    public static function create($employee_id, $title, $email, $name, $contact_no, $password)
    {
        $db = App::resolve(Database::class);

        $db->query('INSERT INTO users(name,email,mobile,password,role,approved) VALUES (?, ?, ?, ?, ?, ?)', [
            $name,
            $email,
            $contact_no,
            password_hash($password, PASSWORD_DEFAULT),
            3,
            1
        ]);

        $user_id = $db->getLastInsertedId();

        $db->query('INSERT INTO pdc(employee_id, title, user_id) VALUES (?, ?, ?)', [
            $employee_id,
            $title,
            $user_id
        ]);
    }

    public static function get_all()
    {
        $db = App::resolve(Database::class);
        $result =  $db->query('SELECT u.*, p.* FROM users as u INNER JOIN pdc as p ON u.id=p.user_id', []);
        return $result->get();
    }

    public static function get_by_id(string $id)
    {
        $db = App::resolve(Database::class);
        $result =  $db->query('SELECT u.*, p.* FROM users as u INNER JOIN pdc as p ON u.id=p.user_id WHERE u.id=?', [$id]);
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

        $db->query('UPDATE pdc SET employee_id=?,title=? WHERE user_id=?', $data);
    }

    public static function delete($id)
    {
        $db = App::resolve(Database::class);

        // dont have to delete from pdc table as the foriegn key constraint stands for CASCADE mode.
        $db->query('DELETE FROM users WHERE id=?', [
            $id,
        ]);
    }
}
