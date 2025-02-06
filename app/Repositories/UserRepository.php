<?php

namespace App\Repositories;

use App\Models\User;
use PDO;

class UserRepository
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData) {
            return new User(
                $userData['id'],
                $userData['username'],
                $userData['email'],
                $userData['password'],
                $userData['role']
            );
        }
        return null;
    }

    public function createUser($username, $email, $password)
    {
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => $password
        ]);
    }

    public function getLikedSongs($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM songs WHERE id IN (SELECT song_id FROM liked_songs WHERE user_id = :user_id)");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $userId]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData) {
            return new User(
                $userData['id'],
                $userData['username'],
                $userData['email'],
                $userData['password'],
                $userData['role']
            );
        }
        return null;
    }
}