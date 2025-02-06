<?php

namespace App\Models;

class Song {
    protected int $id;
    protected string $title;
    protected Artist $artist;
    protected string $filepath;
    protected array $metadata;
    protected bool $approved;
    protected array $ratings = [];
    protected array $comments = [];
    protected string $created_at;
    protected string $updated_at;

    public function __construct(string $title, Artist $artist, string $filepath, array $metadata = []) {
        $this->title = $title;
        $this->artist = $artist;
        $this->filepath = $filepath;
        $this->metadata = $metadata;
        $this->approved = false;
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
    }

    public function addRating(User $user, int $rating): void {
        $this->ratings[$user->getId()] = $rating;
    }

    public function addComment(User $user, string $comment): void {
        $this->comments[] = [
            'user' => $user,
            'comment' => $comment,
            'created_at' => date('Y-m-d H:i:s')
        ];
    }}