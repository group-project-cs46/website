<?php

namespace Models;

use Core\App;
use Core\Database;

class Pdc
{
    public static function create($employee_id , $title, $name, $contact_no, $email)
    {
        $db = App::resolve(Database::class);

        $db->query('INSERT INTO pdc(employee_id, title, name , contact_no, email) VALUES (?, ?, ?, ?, ?)', [
            $employee_id,
            $title,
            $name,
            $contact_no,
            $email
        ]);
    }

    public static function get_all(){
        $db = App::resolve(Database::class);
        $result =  $db->query('SELECT * FROM pdc',[]);
        return $result->get();
    }

    public static function get_by_id(string $id){
        $db = App::resolve(Database::class);
        $result =  $db->query('SELECT * FROM pdc WHERE employee_id=?',[$id]);
        $data= $result->get();
        if(empty($data)){
            return null;
        }
        return $data[0];
    }

    public static function update($employee_id , $title, $name, $contact_no, $email)
    {
        $db = App::resolve(Database::class);

        $db->query('UPDATE pdc SET title=?, name=?, contact_no=?,email=? WHERE employee_id=?', [
            $title,
            $name,
            $contact_no,
            $email,
            $employee_id,
        ]);
    }

    public static function delete($employee_id)
    {
        $db = App::resolve(Database::class);

        $db->query('DELETE FROM pdc WHERE employee_id=?', [
            $employee_id,
        ]);
    }

}


