<?php

namespace Models;

use Core\App;
use Core\Database;

class SecondRoundShortlistedStudents
{
    public static function getBySecondRoundRolesId($second_round_role_id,)
    {
        $db = App::resolve(Database::class);
        return $db->query('SELECT * FROM second_round_shortlisted_students WHERE second_round_roles_id = ?',
            [$second_round_role_id])->get();

    }

}