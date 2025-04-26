<?php

namespace Core;

use Core\Middleware\Auth;
use Core\Middleware\Guest;
use Core\Middleware\Middleware;
use Models\Notification;

class Router
{
    protected $routes = [];

    public function add($method, $uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => [],
        ];
        return $this;
    }

    public function get($uri, $controller)
    {
        return $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller)
    {
        return $this->add('POST', $uri, $controller);
    }

    public function put($uri, $controller)
    {
        return $this->add('PUT', $uri, $controller);
    }

    public function delete($uri, $controller)
    {
        return $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller)
    {
        return $this->add('PATCH', $uri, $controller);
    }

    public function only($key)
    {
        $this->routes[array_key_last($this->routes)]['middleware'][] = $key;
        return $this;
    }

    public function middleware(array $middleware)
    {
        $existingMiddleware = $this->routes[array_key_last($this->routes)]['middleware'];
        $this->routes[array_key_last($this->routes)]['middleware'] = [...$middleware, ...$existingMiddleware];
        return $this;
    }

    protected function abort($code = 404)
    {
        http_response_code($code);
        require base_path("views/{$code}.php");
        die();
    }

    public function previousUrl()
    {
        return $_SERVER['HTTP_REFERER'];
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                Middleware::resolve($route['middleware']);



                if (isset($_SESSION['user'])) {
                    $notifications = Notification::getAllByUserId(auth_user()['id']);
                    $_SESSION['user']['notifications'] = $notifications;

                }

                return require base_path('Http/controllers/' . $route['controller']);
            }
        }

        $this->abort();
    }
}