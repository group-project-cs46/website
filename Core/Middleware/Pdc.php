<?php

namespace Core\Middleware;

class Pdc
{
    public function handle()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 3) {
            redirect('/');
        }
    }
}