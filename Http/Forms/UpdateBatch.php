<?php

namespace Http\Forms;

use Core\BaseForm;
use Core\Validator;

class UpdateBatch extends BaseForm
{
    protected function validateAttributes($attributes): void
    {
        if (!Validator::string($attributes['first_round_start_date'])) {
            $this->error('first_round_start_time', 'First round start time is required')->throw();
        }

        $firstRoundStartTime = strtotime($attributes['first_round_start_time'] . ' ' . $attributes['first_round_start_date']);
        if ($firstRoundStartTime < time()) {
            $this->error('first_round_start_time', 'First round start time must be in the future');
        }

        $times[] = $firstRoundStartTime;

        if ($attributes['first_round_end_date']) {
            $firstRoundEndTime = strtotime($attributes['first_round_end_time'] . ' ' . $attributes['first_round_end_date']);
            $times[] = $firstRoundEndTime;
        }

        if ($attributes['second_round_start_date']) {
            $secondRoundStartTime = strtotime($attributes['second_round_start_time'] . ' ' . $attributes['second_round_start_date']);
            $times[] = $secondRoundStartTime;
        }

        if ($attributes['second_round_end_date']) {
            $secondRoundEndTime = strtotime($attributes['second_round_end_time'] . ' ' . $attributes['second_round_end_date']);
            $times[] = $secondRoundEndTime;
        }

        $times_copy = $times;
        sort($times_copy);

        if ($times_copy !== $times) {
            $this->error('first_round_start_time', 'The times must be in ascending order');
        }
    }
}
