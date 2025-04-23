<?php

namespace Models;

use Core\App;
use Core\Database;

class TrainingSessionRegistration
{
    public static function create($training_session_id, $user_id)
    {
        $db = App::resolve(Database::class);

        $db->query('INSERT INTO training_session_registrations (training_session_id, user_id) VALUES (?, ?)', [
            $training_session_id,
            $user_id
        ]);
    }

    public static function getByUserIdAndTrainingSessionId($user_id, $training_session_id)
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT * FROM training_session_registrations WHERE user_id = ? AND training_session_id = ?', [
            $user_id,
            $training_session_id
        ])->find();
    }

    public static function markAttendance($user_id, $training_session_id)
    {
        $db = App::resolve(Database::class);

        $db->query('UPDATE training_session_registrations SET attended = true WHERE user_id = ? AND training_session_id = ?', [
            $user_id,
            $training_session_id
        ]);

    }

    public static function getAllByTrainingId($training_session_id)
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT 
                training_session_registrations.*, 
                users.name AS sname,
                users.email AS semail,
                students.registration_number AS re_no,
                students.index_number AS index_no
            FROM training_session_registrations
            LEFT JOIN users ON training_session_registrations.user_id = users.id
            LEFT JOIN students ON training_session_registrations.user_id = students.id

            WHERE training_session_id = ?
        ', [$training_session_id])->get();
    }
}
