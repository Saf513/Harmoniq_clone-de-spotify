<?php
namespace app\Models;


class User extends Person {

    protected array $likedSongs=[];
    protected array $playlists=[];
    protected array $followedPlaylists=[];

    public function addLikedSong(Song $song): void {
        if (!in_array($song, $this->likedSongs)) {
            $this->likedSongs[] = $song;
        }
    }

    public function removeLikedSong(Song $song): void {
        $key = array_search($song, $this->likedSongs);
        if ($key !== false) {
            unset($this->likedSongs[$key]);
        }
    }

    public function createPlaylist(string $name, bool $isPublic = true): Playlist {
        $playlist = new Playlist($name, $this, $isPublic);
        $this->playlists[] = $playlist;
        return $playlist;
    }

    public function followPlaylist(Playlist $playlist): void {
        if (!in_array($playlist, $this->followedPlaylists)) {
            $this->followedPlaylists[] = $playlist;
        }
    }


}