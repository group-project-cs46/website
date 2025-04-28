<?php

namespace Core\Middleware;

use Models\Batch;

class IsSecondRound
{
    public function handle()
    {
        if (!isSecondRound()) {
            redirect('/');
        }
    }
}