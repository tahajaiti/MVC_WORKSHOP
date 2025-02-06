<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    private string $namespace;

    public function __construct() {
        $this->namespace = 'App\\Controllers\\';
    }

    public function add (string $method, string $path, string $handler){
        $this->routes[$method][$path] = $handler;
    }

    public function dispatch(){
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $route = $this->routes[$method][$uri];

        if (isset($route)){
            [$controller, $action] = explode('@', $route);
            
            $controller = $this->namespace . $controller;

            if (class_exists($controller) && method_exists($controller, $action)){
                $controller = new $controller();
                $controller->$action();
            }
        }
        
    }
    
}