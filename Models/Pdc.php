<?php

namespace Models;

use Core\App;
use Core\Database;

class Pdc
{
    public static function create($id, $title, $name, $contact_No, $email)
    {
        $db = App::resolve(Database::class);

        $db->query('INSERT INTO pdc(id, title, name , contact_No, email) VALUES (?, ?, ?, ?, ?)', [
            $id,
            $title,
            $name,
            $contact_No,
            $email
        ]);
    }

    // public static function update($id, $title, $name, $contact_No, $email)
    // {
    //     $db = App::resolve(Database::class);

    //     $db->query('UPDATE pdc SET id = ?,title = ?,name = ?,contact_No = ?,email = ? WHERE id = ?', [
    //         $id, 
    //         $title, 
    //         $name, 
    //         $contact_No, 
    //         $email
    //     ]);
    // }

}


