<?php
namespace app\Models;
class Admin extends Person {
    protected array $permissions = [];

    public function banUser(User $user): void {
    }

    public function unbanUser(User $user): void {
    }

    public function reviewSong(Song $song, bool $approved): void {
    }

    public function hasPermission(string $permission): bool {
        return in_array($permission, $this->permissions);
    }
}
