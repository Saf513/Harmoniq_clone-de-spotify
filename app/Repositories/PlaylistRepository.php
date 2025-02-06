<?php

namespace App\Repositories;

use App\Models\Playlist;
use PDO;

class PlaylistRepository
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function findByUserId($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM playlists WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        $playlistsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $playlists = [];
        foreach ($playlistsData as $playlistData) {
            $playlists[] = new Playlist(
                $playlistData['id'],
                $playlistData['name'],
                $playlistData['user_id'],
                $playlistData['created_at']
            );
        }
        return $playlists;
    }

    public function create($userId, $name)
    {
        $stmt = $this->db->prepare("INSERT INTO playlists (name, user_id) VALUES (:name, :user_id)");
        $stmt->execute([
            'name' => $name,
            'user_id' => $userId
        ]);
    }

    public function delete($playlistId)
    {
        $stmt = $this->db->prepare("DELETE FROM playlists WHERE id = :id");
        $stmt->execute(['id' => $playlistId]);
    }

    public function findById($playlistId)
    {
        $stmt = $this->db->prepare("SELECT * FROM playlists WHERE id = :id");
        $stmt->execute(['id' => $playlistId]);
        $playlistData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($playlistData) {
            return new Playlist(
                $playlistData['id'],
                $playlistData['name'],
                $playlistData['user_id'],
                $playlistData['created_at']
            );
        }
        return null;
    }
}