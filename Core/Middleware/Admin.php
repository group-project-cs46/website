<?php

namespace Core\Middleware;

class Admin
{
    public function handle()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 1) {
            header('location: /');
            die();
        }
    }
}