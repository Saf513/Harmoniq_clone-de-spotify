<?php

namespace app\Controllers;


class HomeController {
    
    public function index() {
        include_once __DIR__ . '/../Views/user/playlists.php';
    }
}