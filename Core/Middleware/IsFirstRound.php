<?php

namespace Core\Middleware;

use Models\Batch;

class IsFirstRound
{
    public function handle()
    {
        $currentBatch = Batch::currentBatch();
        $isFirstRound = $currentBatch['current_round'] == 'first_round';
        if (!$isFirstRound) {
            redirect('/');
        }
    }
}