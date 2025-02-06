<?php 

namespace app\Models;

class Playlist {
    protected int $id;
    protected string $name;
    protected User $owner;
    protected array $songs = [];
    protected bool $isPublic;
    protected array $followers = [];
    protected string $created_at;
    protected string $updated_at;

    public function __construct(string $name, User $owner, bool $isPublic = true) {
        $this->name = $name;
        $this->owner = $owner;
        $this->isPublic = $isPublic;
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
    }

    public function addSong(Song $song): void {
        if (!in_array($song, $this->songs)) {
            $this->songs[] = $song;
            $this->updated_at = date('Y-m-d H:i:s');
        }
    }

    public function removeSong(Song $song): void {
        $key = array_search($song, $this->songs);
        if ($key !== false) {
            unset($this->songs[$key]);
            $this->updated_at = date('Y-m-d H:i:s');
        }
    }

    public function addFollower(User $user): void {
        if (!in_array($user, $this->followers)) {
            $this->followers[] = $user;
        }
    }

    public function isPublic(): bool {
        return $this->isPublic;
    }

    public function setVisibility(bool $isPublic): void {
        $this->isPublic = $isPublic;
        $this->updated_at = date('Y-m-d H:i:s');
    }
}