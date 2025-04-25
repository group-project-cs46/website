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
        'pdc' => Pdc::class,
        'isSecondRound' => IsSecondRound::class,
        'isFirstRound' => IsFirstRound::class,
    ];

    public static function resolve(array $keys)
    {
        if (!$keys) {
            return;
        }

        foreach ($keys as $key) {
            $middleware = static::MAP[$key] ?? null;

            if (!$middleware) {
                throw new \Exception("Middleware not found for key: {$key}");
            }

            (new $middleware)->handle();
        }
    }
}