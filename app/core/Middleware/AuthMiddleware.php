<?php
namespace App\Core\Middleware;

class AuthMiddleware implements Middleware {
    public function handle() {
        // Vérification si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }
    }
}