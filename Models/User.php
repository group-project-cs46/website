<?php

namespace Models;

use Core\App;
use Core\Database;

class User
{
    public static function find($id)
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT * FROM users WHERE id = ?', [$id])->find();
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

        $user = auth_user();

        $query = 'SELECT * FROM users';

        switch ($user['role']) {
            case 1: // Admin
                $query .= ' LEFT JOIN admins other ON other.id = users.id';
                break;
            case 2: // Student
                $query .= ' LEFT JOIN students other ON other.id = users.id';
                break;
            case 3: // PDC
                $query .= ' LEFT JOIN pdcs other ON other.id = users.id';
                break;
            case 4: // Company
                $query .= ' LEFT JOIN companies other ON other.id = users.id';
                break;
            case 5: // Lecturer
                $query .= ' LEFT JOIN lecturers other ON other.id = users.id';
                break;
            default:
                // Handle unknown role
                break;
        }

        $query .= ' WHERE users.id = ?';

        $user = $db->query($query, [$id])->find();

        return $user;
    }

    public static function update($attributes, $id)
    {
        $db = App::resolve(Database::class);

        // Step 1: Get current user
        $currentUser = User::find($id);

        if (!$currentUser) {
            return null;
        }

        // Step 2: Merge attributes (use existing if not provided)
        $mobile   = $attributes['mobile']   ?? $currentUser['mobile'];
        $bio      = $attributes['bio']      ?? $currentUser['bio'];
        $linkedin = $attributes['linkedin'] ?? $currentUser['linkedin'];
        $name     = $attributes['name']     ?? $currentUser['name'];

        // Step 3: Update with merged values
        $db->query(
            'UPDATE users SET mobile = ?, bio = ?, linkedin = ?, name = ? WHERE id = ?',
            [$mobile, $bio, $linkedin, $name, $id]
        );

//        // Optionally, return updated data
//        return $db->query('SELECT * FROM users WHERE id = ?', [$id])->find();
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