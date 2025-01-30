<?php

use Core\Response;
use Core\Session;

function dd($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die();
}

function console_log($value)
{
    error_log(print_r($value, TRUE));
}

function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function abort($status = 404)
{
    http_response_code($status);
    require base_path("views/{$status}.php");
    die();
}

function authorize($condition, $status = Response::FORBIDDEN)
{
    if (!$condition) {
        abort($status);
    }
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function component_path($path)
{
    return base_path("views/components/$path");
}
function views_path($path)
{
    return base_path("views/$path");
}

function view($path, $attributes = [])
{
    extract($attributes);
    require base_path("views/$path");
}

function render($path, $attributes = [])
{
    ob_start();
    view($path, $attributes);
    return ob_get_clean();
}

function logout()
{
    $_SESSION = [];
    session_destroy();

    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}

function redirect($path)
{
    header("location: {$path}");
    die();
}

function old($key, $default = '')
{
    return Session::getFlash('old')[$key] ?? $default;
}

function auth_user()
{
    $user = \Models\User::findByEmail($_SESSION['user']['email']);
    return $user;
}

function getUserProfilePhotoUrl($user)
{
    return $user['photo'] ? '/assets/photos/' . $user['photo'] : '/assets/default_profile.jpg';
}