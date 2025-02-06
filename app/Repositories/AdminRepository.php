<?php

namespace App\Repositories;

use App\Models\Admin;
use PDO;

class AdminRepository
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

   

    public function create($userId)
    {
        $stmt = $this->db->prepare("INSERT INTO admins (user_id) VALUES (:user_id)");
        $stmt->execute(['user_id' => $userId]);
    }
}