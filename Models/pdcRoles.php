<?php

namespace Models;

use Core\App;
use Core\Database;

class pdcRoles
{
    public static function fetchAll()
{
    $db = App::resolve(Database::class);

    $techtalks = $db->query('
        SELECT * FROM internship_roles
    ', [])->get();

    return $techtalks;
}

    public static function create_role($name, $description)
    {
        $db = App::resolve(Database::class);

        $result = $db->query('INSERT INTO internship_roles (name, description) VALUES (? , ?)', [
            $name,
            $description
        ]);

        return $result !== false;
    }

    public static function edit_role($id, $name, $description)
    {
        $db = App::resolve(Database::class);

        return $db->query('UPDATE internship_roles SET description = ?, name = ? WHERE id = ?', [
            $description,
            $name,
            $id
        ]);
    }

    public static function delete_role($id)
    {
        $db = App::resolve(Database::class);
        
        return $db->query('DELETE FROM internship_roles WHERE id = ?', [
            $id
        ]);
    }
}
