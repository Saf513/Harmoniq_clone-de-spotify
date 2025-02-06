<?php
namespace app\Models;
class Admin extends Person {
    protected array $permissions = [];

    public function banUser(User $user): void {
        // Logique pour bannir un utilisateur
    }

    public function unbanUser(User $user): void {
        // Logique pour débannir un utilisateur
    }

    public function reviewSong(Song $song, bool $approved): void {
        // Logique pour approuver/rejeter une chanson
    }

    public function hasPermission(string $permission): bool {
        return in_array($permission, $this->permissions);
    }
}
