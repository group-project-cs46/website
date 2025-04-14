<?php

namespace Core\Middleware;

class Company
{
    public function handle()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 4) {
            header('location: /');
            die();
        }
    }
}