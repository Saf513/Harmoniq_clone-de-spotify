<?php

namespace App\Repositories;

use App\Models\Artist;
use PDO;

class ArtistRepository
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function findByUserId($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM artists WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        $artistData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($artistData) {
            return new Artist(
                $artistData['id'],
                $artistData['name'],
                $artistData['bio'],
                $artistData['user_id']
            );
        }
        return null;
    }

    public function create($name, $bio, $userId)
    {
        $stmt = $this->db->prepare("INSERT INTO artists (name, bio, user_id) VALUES (:name, :bio, :user_id)");
        $stmt->execute([
            'name' => $name,
            'bio' => $bio,
            'user_id' => $userId
        ]);
    }

    public function delete($artistId)
    {
        $stmt = $this->db->prepare("DELETE FROM artists WHERE id = :id");
        $stmt->execute(['id' => $artistId]);
    }
}