<?php

declare(strict_types=1);

/**
 * Simple router.
 */

namespace App\Core;

class Router
{
    private array $routes = [];
    private array $middleware = [];

    /**
     * Register GET route.
     */
    public function get(string $path, array $action, array $middleware = []): self
    {
        $this->routes['GET'][$path] = ['action' => $action, 'middleware' => $middleware];
        return $this;
    }

    /**
     * Register POST route.
     */
    public function post(string $path, array $action, array $middleware = []): self
    {
        $this->routes['POST'][$path] = ['action' => $action, 'middleware' => $middleware];
        return $this;
    }

    /**
     * Dispatch the request.
     */
    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = rtrim($uri, '/') ?: '/';

        $route = $this->matchRoute($method, $uri);

        if ($route === null) {
            http_response_code(404);
            require __DIR__ . '/../../resources/views/errors/404.php';
            return;
        }

        foreach ($route['middleware'] as $mw) {
            $middlewareClass = "App\\Middleware\\{$mw}";
            if (class_exists($middlewareClass)) {
                $middlewareClass::handle();
            }
        }

        $controllerClass = "App\\Controllers\\{$route['action'][0]}";
        $method = $route['action'][1];

        if (!class_exists($controllerClass)) {
            http_response_code(500);
            echo 'Controller not found: ' . htmlspecialchars($controllerClass, ENT_QUOTES, 'UTF-8');
            return;
        }

        $controller = new $controllerClass();

        if (!method_exists($controller, $method)) {
            http_response_code(500);
            echo 'Method not found: ' . htmlspecialchars($method, ENT_QUOTES, 'UTF-8');
            return;
        }

        $controller->$method();
    }

    /**
     * Match route by method and URI with parameter support.
     */
    private function matchRoute(string $method, string $uri): ?array
    {
        if (!isset($this->routes[$method])) {
            return null;
        }

        foreach ($this->routes[$method] as $path => $route) {
            $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $path);
            $pattern = '#^' . $pattern . '$#';

            if (preg_match($pattern, $uri, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                $_GET = array_merge($_GET, $params);
                return $route;
            }
        }

        return null;
    }
}
