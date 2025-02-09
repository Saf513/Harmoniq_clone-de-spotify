<?php

namespace app\Controllers;

use app\Services\AuthService;
use app\Utils\Validator;
use app\Utils\Security;

class AuthController
{
    private $twig;
    private ?AuthService $authService;

    public function __construct($twig, AuthService $authService = null)
    {
        $this->twig = $twig;
        $this->authService = $authService; 
    }

    public function showLogin()
    {
        echo $this->twig->render('auth/login.twig');
    }

    public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (Validator::validateEmail($email) && Validator::validatePassword($password)) {
            $user = $this->authService->authenticate($email, $password);
            if ($user) {
                Security::startSession();
                $_SESSION['user'] = $user;
                header('Location: /dashboard');
            } else {
                echo "Identifiants incorrects.";
            }
        } else {
            echo "Données invalides.";
        }
    }

    public function showRegister()
    {
        // Affiche la page d'inscription
        require __DIR__ . '/../Views/auth/register.twig';
    }

    public function register()
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        var_dump($username , $email , $password);

        if (Validator::validateUsername($username) && Validator::validateEmail($email) && Validator::validatePassword($password)) {
            $this->authService->register($username, $email, $password);
            header('Location: /login');
        } else {
            echo "Données invalides.";
        }
    }

    public function logout()
    {
        Security::destroySession();
        header('Location: /login');
    }
}