<?php

namespace Core\Middleware;

class Middleware
{
    public const MAP = [
        'guest' => Guest::class,
        'auth' => Auth::class,
        'student' => Student::class,
        'admin' => Admin::class,
        'company' => Company::class,
        'lecturer' => Lecturer::class,
    ];

    public static function resolve($key)
    {
        if (!$key) {
            return;
        }
        $middleware = static::MAP[$key] ?? false;

        if (!$middleware) {
            throw new \Exception("Middleware not found for key: {$key}");
        }

        (new $middleware)->handle();
    }
}