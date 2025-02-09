<?php
namespace app\Core;
use app\Controllers\HomeController;
use  app\Services\authService;
use app\Models\Database;

class Router
{
    private $routes = [];
    public function add($method, $uri, $handler) {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $this->formatPath($uri),
            'handler' => $handler
        ];
    }
    public function dispatch($httpmethod, $path) {
        $uri = $this->formatPath($path);
        foreach ($this->routes as $route) {
            if ($route['method'] === strtoupper($httpmethod) && $route['path'] === $uri) {
                $class = $route['handler'][0];
                $method = $route['handler'][1];
    
                // Instanciez Twig
                $twig = new \Twig\Environment(
                    new \Twig\Loader\FilesystemLoader(__DIR__ . '/../Views') // Spécifiez le bon chemin
                );
    
                // Instanciez AuthService avec ses dépendances
                $authService = new \app\Services\AuthService(
                    new \app\Repositories\UserRepository(Database::getConnection())
                );
    
                // Passez les instances réelles au contrôleur
                $instance = new $class($twig, $authService);
    
                return call_user_func([$instance, $method]);
            }
        }
        http_response_code(404);
        echo "404 Not Found";
    }
    private function formatPath($path) {
        return '/' . trim($path, '/public');
    }
}