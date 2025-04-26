<?php

namespace Core\Middleware;

use Models\Batch;

class IsSecondRound
{
    public function handle()
    {
        $currentBatch = Batch::currentBatch();
        $isSecondRound = $currentBatch['current_round'] == 'second';
        if (!$isSecondRound) {
            redirect('/');
        }
    }
}