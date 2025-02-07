<?php

namespace App\Controllers;

class Controller
{

    protected string $path = __DIR__ . '/../Views/';

    protected function render(string $view, array $data = []): void {

        $view = ucfirst($view);
        $view = $this->path . $view . '.php';

        if (file_exists($view)) {
            extract($data);
            require $view;
        } else {
            echo "Page not found";
        }
    }

    protected function redirect(string $url): void {
        header("Location: $url");
        exit;
    }

    protected function getMethod(): string {
        return $_SERVER['REQUEST_METHOD'];
    }

    protected function getData(): array {
        $data = [];

        foreach ($_POST as $key => $value){
            $data[$key] = is_string($value) ? htmlspecialchars(trim($value)) : $value;
        }

        foreach ($_GET as $key => $value){
            $data[$key] = is_string($value) ? htmlspecialchars(trim($value)) : $value;
        }

        return $data;
    }

    protected function setMessage(string $message): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['message'] = $message;
    }

}