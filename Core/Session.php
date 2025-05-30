<?php

namespace Core;

class Session
{
    public static function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function getFlash($key, $default = null)
    {
        return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? $default;
    }

    public static function has($key)
    {
        return (bool)static::getFlash($key);
    }

    public static function toast($message, $type = 'info')
    {
        static::flash('toast', $message);
        static::flash('toast_type', $type);
    }

    public static function flash($key, $value)
    {
        $_SESSION['_flash'][$key] = $value;
    }

    public static function unflash() {
        unset($_SESSION['_flash']);
    }

    public static function flush()
    {
        $_SESSION = [];
    }

    public static function destroy()
    {
        static::flush();
        session_destroy();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }

    public static function sessionUserRefresh($user)
    {
        $_SESSION['user'] = [
            'email' => $user['email'],
            'role' => $user['role'],
            'name' => $user['name'],
            'photo' => getUserProfilePhotoUrl($user)
        ];

    }
}