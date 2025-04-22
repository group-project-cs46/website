<?php

namespace Models;

use Core\App;
use Core\Database;

class TrainingSession
{
    public static function create($name, $date, $start_time, $end_time, $venue, $attendance_code)
    {
        $db = App::resolve(Database::class);

        $db->query('INSERT INTO training_sessions (name, date, start_time, end_time, venue, attendance_code) VALUES (?, ?, ?, ?, ?, ?)', [
            $name,
            $date,
            $start_time,
            $end_time,
            $venue,
            $attendance_code
        ]);
    }

    public static function get_all()
    {
        $db = App::resolve(Database::class);
        return $db->query('SELECT * FROM training_sessions ORDER BY created_at DESC', [])->get();
    }

    public static function get_by_id($id)
    {
        $db = App::resolve(Database::class);
        $result = $db->query('SELECT * FROM training_sessions WHERE id = ?', [$id])->get();
        return $result[0] ?? null;
    }

    public static function update($id, $name, $date, $start_time, $end_time, $venue)
    {
        $db = App::resolve(Database::class);
        $db->query(
            'UPDATE training_sessions SET name = ?, date = ?, start_time = ?, end_time = ?, venue = ? WHERE id = ?',
            [$name, $date, $start_time, $end_time, $venue, $id]
        );
    }

    public static function delete($id)
    {
        $db = App::resolve(Database::class);
        $db->query('DELETE FROM training_sessions WHERE id = ?', [$id]);
    }
}
