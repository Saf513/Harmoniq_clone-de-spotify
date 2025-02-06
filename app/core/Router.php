<?php
namespace App\Core;

class Router {
    private $routes = [];

    public function addRoute(string $route, string $controllerAction) {
        $this->routes[$route] = $controllerAction;
    }

    public function run() {
        $uri = $_SERVER['REQUEST_URI'];

        if (array_key_exists($uri, $this->routes)) {
            $this->executeAction($this->routes[$uri]);
        } else {
            $this->handleNotFound();
        }
    }

    private function executeAction(string $controllerAction) {
        // Séparation du contrôleur et de l'action
        list($controllerName, $methodName) = explode('@', $controllerAction);
        $controllerName = 'App\\Controllers\\' . $controllerName;

        if (class_exists($controllerName)) {
            $controller = new $controllerName();

            if (method_exists($controller, $methodName)) {
                $controller->$methodName();
            } else {
                $this->handleMethodNotFound($controllerName, $methodName);
            }
        } else {
            $this->handleControllerNotFound($controllerName);
        }
    }

    private function handleNotFound() {
        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found";
        exit();
    }

    private function handleControllerNotFound(string $controllerName) {
        header("HTTP/1.0 500 Internal Server Error");
        echo "Controller not found: " . htmlspecialchars($controllerName);
        exit();
    }

    private function handleMethodNotFound(string $controllerName, string $methodName) {
        header("HTTP/1.0 500 Internal Server Error");
        echo "Method not found: " . htmlspecialchars($methodName) . " in controller " . htmlspecialchars($controllerName);
        exit();
    }
}