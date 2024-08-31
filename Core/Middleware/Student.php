<?php

namespace Core\Middleware;

class Student
{
    public function handle()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 2) {
            header('location: /');
            die();
        }
    }
}