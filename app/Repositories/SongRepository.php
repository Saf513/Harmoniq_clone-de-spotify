<?php

namespace App\Repositories;

use App\Models\Song;
use PDO;

class SongRepository
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function findAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM songs");
        $stmt->execute();
        $songsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $songs = [];
        foreach ($songsData as $songData) {
            $songs[] = new Song(
                $songData['id'],
                $songData['title'],
                $songData['artist'],
                $songData['file_path'],
                $songData['uploaded_by'],
                $songData['created_at']
            );
        }
        return $songs;
    }

    public function findById($songId)
    {
        $stmt = $this->db->prepare("SELECT * FROM songs WHERE id = :id");
        $stmt->execute(['id' => $songId]);
        $songData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($songData) {
            return new Song(
                $songData['id'],
                $songData['title'],
                $songData['artist'],
                $songData['file_path'],
                $songData['uploaded_by'],
                $songData['created_at']
            );
        }
        return null;
    }

    public function create($title, $artist, $filePath, $uploadedBy)
    {
        $stmt = $this->db->prepare("INSERT INTO songs (title, artist, file_path, uploaded_by) VALUES (:title, :artist, :file_path, :uploaded_by)");
        $stmt->execute([
            'title' => $title,
            'artist' => $artist,
            'file_path' => $filePath,
            'uploaded_by' => $uploadedBy
        ]);
    }

    public function delete($songId)
    {
        $stmt = $this->db->prepare("DELETE FROM songs WHERE id = :id");
        $stmt->execute(['id' => $songId]);
    }
}