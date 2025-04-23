<?php

namespace Models;

use Core\App;
use Core\Database;

class Batch
{
    public static function getById($id)
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT * FROM batches WHERE id = ?', [$id])->find();

    }
    public static function getAll()
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT * FROM batches ORDER BY created_at', [])->get();
    }

    public static function create($attributes)
    {
        $db = App::resolve(Database::class);

        $db->query('INSERT INTO batches (first_round_start_time, first_round_end_time, second_round_start_time, second_round_end_time) VALUES (?, ?, ?, ?)', [
            $attributes['first_round_start_time'],
            $attributes['first_round_end_time'],
            $attributes['second_round_start_time'],
            $attributes['second_round_end_time']
        ]);
    }

    public static function update($attributes, $id)
    {
        $db = App::resolve(Database::class);

        // Step 1: Get current batch
        $currentBatch = $db->query('SELECT * FROM batches WHERE id = ?', [$id])->find();

        if (!$currentBatch) {
            return null;
        }

        // Step 2: Merge attributes (use existing if not provided)
        $firstRoundStartTime  = $attributes['first_round_start_time']  ?? $currentBatch['first_round_start_time'];
        $secondRoundStartTime = $attributes['second_round_start_time'] ?? $currentBatch['second_round_start_time'];
        $firstRoundEndTime    = $attributes['first_round_end_time']    ?? $currentBatch['first_round_end_time'];
        $secondRoundEndTime   = $attributes['second_round_end_time']   ?? $currentBatch['second_round_end_time'];
        $description          = $attributes['description']             ?? $currentBatch['description'];

        // Step 3: Update with merged values
        $db->query(
            'UPDATE batches SET first_round_start_time = ?, second_round_start_time = ?, first_round_end_time = ?, second_round_end_time = ?, description = ? WHERE id = ?',
            [$firstRoundStartTime, $secondRoundStartTime, $firstRoundEndTime, $secondRoundEndTime, $description, $id]
        );
    }

    public static function delete($id)
    {
        $db = App::resolve(Database::class);

        $db->query('DELETE FROM batches WHERE id = ?', [$id]);
    }

    public static function currentBatch()
    {
        $db = App::resolve(Database::class);

        return $db->query('SELECT * FROM batches WHERE current = 1')->find();
    }


}