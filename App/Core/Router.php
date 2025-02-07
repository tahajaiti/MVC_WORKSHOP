<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    private string $namespace;

    public function __construct()
    {
        $this->namespace = 'App\Controllers\\';
    }

    public function add($method, $path, $handler): void
    {
        $this->routes[$method][$path] = $handler;
    }

    public function dispatch(): void {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        if (isset($this->routes[$method][$uri])) {
            $handler = $this->routes[$method][$uri];
            [$controller, $action] = explode('@', $handler);

            $controller = $this->namespace . $controller;

            if (class_exists($controller) && method_exists($controller, $action)){
                $controller = new $controller();
                $controller->$action();
            } else {
                echo "Invalid controller or action";
            }
        } else {
            echo "404";
        }
    }
}