<?php

namespace Models;

use Core\App;
use Core\Database;

class AddEventStudent
{
    public static function create($student_id, $title, $email, $name, $contact_no, $password, $course)
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

        $id = $db->getLastInsertedId();

        $db->query('INSERT INTO event_students(student_id, title, id, course) VALUES (?, ?, ?, ?)', [
            $student_id,
            $title,
            $id,
            $course
        ]);
    }

    public static function get_all()
    {
        $db = App::resolve(Database::class);
        $result =  $db->query('SELECT u.*, p.* FROM users as u INNER JOIN event_students as p ON u.id=p.id', []);
        return $result->get();
    }

    public static function get_by_id(string $id)
    {
        $db = App::resolve(Database::class);
        $result =  $db->query('SELECT u.*, p.* FROM users as u INNER JOIN event_students as p ON u.id=p.id WHERE u.id=?', [$id]);
        $data = $result->get();
        if (empty($data)) {
            return null;
        }
        return $data[0];
    }

    public static function update($id, $name, $email, $student_id, $contact, $title, $password, $course)
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
            $student_id,
            $title,
            $id,
            $course
        ];

        $db->query('UPDATE pdcs SET student_id=?,title=? WHERE id=?', $data);
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
