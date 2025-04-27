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

function log_to_file(string $message) {
    $logDir = base_path("storage/logs");
    $filePath = $logDir . "/app.log";

    // Create the logs directory if it doesn't exist
    if (!is_dir($logDir)) {
        mkdir($logDir, 0755, true); // 0755 permissions, true to create nested directories
    }

    // Add timestamp to the message
    $timestamp = date('[Y-m-d H:i:s]');
    $logMessage = "{$timestamp} {$message}\n";

    // Append to the log file
    error_log($logMessage, 3, $filePath);
}



function urlIs($value, $no_query = false)
{
    if ($no_query) {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === $value;
    }
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

function getFirstDayOfMonth($year, $month) {
    $date = new DateTime("$year-$month-01");
    return $date->format('N'); // 'N' format character returns the ISO-8601 numeric representation of the day of the week
}

function roleNumber() {
    return $_SESSION['user']['role'] ?? null;
}

function urlBack()
{
    return $_SERVER['HTTP_REFERER'] ?? '/';
}