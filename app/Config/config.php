<?php

return [
    'database' => [
        'host' =>'localhost',
        'dbname' => 'spotify',
        'user' => 'postgres',
        'password' => '123456',
        'driver' => 'pgsql'
    ],
    'twig' => [
        'cache' => false, 
    ],
    'app' => [
        'name' => 'MonApplicationMusique',
        'url' => 'http://localhost:8000', 
        'debug' => true, 
    ],
    'session' => [
        'name' => 'session_musique',
        'lifetime' => 7200, 
        'path' => '/',
        'domain' => '',
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Strict',
    ],
    ];