<?php

namespace Core\Middleware;

class Lecturer
{
    public function handle()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 5) {
            redirect('/');
        }
    }
}