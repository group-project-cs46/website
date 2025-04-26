<?php

use Http\Forms\CreateBatch;
use Models\Batch;

$form = CreateBatch::validate($attributes = [
    'first_round_start_time' => $_POST['first_round_start_time'] ?? '',
    'first_round_start_date' => $_POST['first_round_start_date'] ?? '',
    'first_round_end_time' => $_POST['first_round_end_time'] ?? '',
    'first_round_end_date' => $_POST['first_round_end_date'] ?? '',
    'second_round_start_time' => $_POST['second_round_start_time'] ?? '',
    'second_round_start_date' => $_POST['second_round_start_date'] ?? '',
    'second_round_end_time' => $_POST['second_round_end_time'] ?? '',
    'second_round_end_date' => $_POST['second_round_end_date'] ?? '',
]);

$firstRoundStartTime = $attributes['first_round_start_date'] . ' ' . $attributes['first_round_start_time'];
$firstRoundEndTime = $attributes['first_round_end_date'] ? $attributes['first_round_end_date'] . ' ' . $attributes['first_round_end_time'] : null;
$secondRoundStartTime = $attributes['second_round_start_date'] ? $attributes['second_round_start_date'] . ' ' . $attributes['second_round_start_time'] : null;
$secondRoundEndTime = $attributes['second_round_end_date'] ? $attributes['second_round_end_date'] . ' ' . $attributes['second_round_end_time'] : null;


Batch::create([
    'first_round_start_time' => $firstRoundStartTime,
    'first_round_end_time' => $firstRoundEndTime,
    'second_round_start_time' => $secondRoundStartTime,
    'second_round_end_time' => $secondRoundEndTime,
]);

redirect('/pdcs/batches');