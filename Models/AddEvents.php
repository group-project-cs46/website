<?php

namespace Models;

use Core\App;
use Core\Database;

class AddEvents
{
    public static function create($events_no, $competition_name, $date, $time, $deadline_date, $deadline_time )
    {
        $db = App::resolve(Database::class);

        // $events_id = $db->getLastInsertedId();

        $db->query('INSERT INTO events(events_no, name, date, time, deadline_date, deadline_time) VALUES (?, ?, ?, ?, ?, ?)', [
            $events_no,
            $competition_name,
            $date,
            $time,
            $deadline_date,
            $deadline_time,
        ]);
    }

    public static function get_all()
    {
        $db = App::resolve(Database::class);
        return $db->query('SELECT * FROM events', [])->get();
    }

    public static function get_by_no($events_no)
    {
        $db = App::resolve(Database::class);
        $result = $db->query('SELECT * FROM events WHERE events_no = ?', [$events_no])->get();
        return $result[0] ?? null;
    }

    public static function update($events_no, $name, $date, $time, $deadline_date, $deadline_time)
    {
        $db = App::resolve(Database::class);
        $db->query(
            'UPDATE events SET name=?, date=?, time=?, deadline_date=?, deadline_time=? WHERE events_no=?',
            [$name, $date, $time, $deadline_date, $deadline_time, $events_no]
        );
    }

    public static function delete($events_no)
    {
        $db = App::resolve(Database::class);
        $db->query('DELETE FROM events WHERE events_no = ?', [$events_no]);
    }

}
