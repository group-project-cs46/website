<?php

namespace Models;

use Core\App;
use Core\Database;

class TrainingSession
{
    public static function create($name, $date, $start_time, $end_time, $venue, $attendance_code, $qrcode_id)
    {
        $db = App::resolve(Database::class);

        $db->query('INSERT INTO training_sessions (name, date, start_time, end_time, venue, attendance_code, qrcode_id) VALUES (?, ?, ?, ?, ?, ?, ?)', [
            $name,
            $date,
            $start_time,
            $end_time,
            $venue,
            $attendance_code,
            $qrcode_id
        ]);
    }

    public static function get_all()
    {
        $db = App::resolve(Database::class);
        return $db->query('SELECT * FROM training_sessions ORDER BY created_at DESC', [])->get();
    }

    public static function findById($id)
    {
        $db = App::resolve(Database::class);
        return $db->query('SELECT * FROM training_sessions WHERE id = ?', [$id])->find();
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

    public static function get_total_count()
    {
        $db = App::resolve(Database::class);

    $result = $db->query('SELECT COUNT(*) as count FROM training_sessions', [])->find();

    return (int) $result['count'];
    }

    public static function isTimeSlotTaken($date, $start_time, $end_time)
    {
        $db = App::resolve(Database::class);

        $result = $db->query(
            'SELECT 1 FROM training_sessions WHERE date = ? 
            AND (
                (start_time <= ? AND end_time > ?) OR 
                (start_time < ? AND end_time >= ?) OR
                (start_time >= ? AND end_time <= ?)
            )',
            [
                $date,
                $start_time, $start_time,
                $end_time, $end_time,
                $start_time, $end_time
            ]
        )->find();

        return $result ? true : false;
    }


}
