<?php

namespace app\Models;

class Artist extends User {
    protected array $uploadedSongs = [];
    protected string $biography;
    protected array $albums = [];

    public function __construct(string $username, string $email, string $password, string $biography = '') {
        parent::__construct($username, $email, $password);
        $this->biography = $biography;
    }

    public function uploadSong(string $title, string $filepath, array $metadata = []): Song {
        $song = new Song($title, $this, $filepath, $metadata);
        $this->uploadedSongs[] = $song;
        return $song;
    }

    public function getBiography(): string {
        return $this->biography;
    }

    public function setBiography(string $biography): void {
        $this->biography = $biography;
        $this->updated_at = date('Y-m-d H:i:s');
    }
}
