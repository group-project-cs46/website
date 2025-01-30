<?php

namespace Models;

use Core\App;
use Core\Database;

class User
{
    public static function find($id)
    {
        $db = App::resolve(Database::class);

        $user = $db->query('SELECT * FROM users WHERE id = ?', [$id])->find();

        return $user;
    }

    public static function findByEmail($email)
    {
        $db = App::resolve(Database::class);

        $user = $db->query('SELECT * FROM users WHERE email = ?', [$email])->find();

        return $user;
    }

    public static function findByIdWithRoleData($id)
    {
        $db = App::resolve(Database::class);

        $user = $db->query('SELECT
                u.name,
                u.email,
                u.mobile,
                u.role,
                u.id,
                u.disabled,
                u.approved,
                u.photo,
                s.index_number,
                s.registration_number
            FROM 
                users u
            LEFT JOIN students s 
                ON u.id = s.id AND u.role = 2  -- Role::Student
            LEFT JOIN lecturers l 
                ON u.id = l.id AND u.role = 5  -- Role::Lecturer
            LEFT JOIN companies c 
                ON u.id = c.id AND u.role = 4  -- Role::Company
            LEFT JOIN admins a 
                ON u.id = a.id AND u.role = 1  -- Role::Admin
            LEFT JOIN pdcs p 
                ON u.id = p.id AND u.role = 3 -- Role::Pdc
            WHERE u.id = ?', [$id])
            ->find();

        return $user;
    }

    public static function create($attributes)
    {
        $db = App::resolve(Database::class);

        $user = $db->query('INSERT INTO users (email, password, role, approved, name) VALUES (?, ?, ?, ?, ?)',
            [$attributes['email'], password_hash($attributes['password'], PASSWORD_DEFAULT), 2, 1, $attributes['name']]);

        $lastInsertedId = $db->connection->lastInsertId();
        return $lastInsertedId;
    }
}