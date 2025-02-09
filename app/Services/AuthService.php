<?php

namespace App\Services;

use app\Repositories\UserRepository;
use app\Utils\Security;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function authenticate($email, $password)
    {
        $user = $this->userRepository->findByEmail($email);
        if ($user && Security::verifyPassword($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function register($username, $email, $password)
    {
        $hashedPassword = Security::hashPassword($password);
        $this->userRepository->createUser($username, $email, $hashedPassword);
    }
}