<?php

use App\Core\Router;

$router = new Router();

// Routes générales
$router->addRoute('/', 'HomeController@index');
$router->addRoute('/about', 'HomeController@about');
$router->addRoute('/contact', 'HomeController@contact');

// Routes d'authentification
$router->addRoute('/login', 'AuthController@login');
$router->addRoute('/register', 'AuthController@register');
$router->addRoute('/logout', 'AuthController@logout');

// Routes utilisateur (nécessitent une authentification)
$router->addRoute('/dashboard', 'UserController@dashboard');
$router->addRoute('/profile', 'UserController@profile');
$router->addRoute('/settings', 'UserController@settings');

// Routes de gestion de la musique (artiste)
$router->addRoute('/artist/upload', 'ArtistController@uploadSong');
$router->addRoute('/artist/manage', 'ArtistController@manageSongs');

// Routes d'administration (nécessitent un rôle d'administrateur)
$router->addRoute('/admin/users', 'AdminController@manageUsers');
$router->addRoute('/admin/songs', 'AdminController@manageSongs');

// Routes de playlist
$router->addRoute('/playlists', 'PlaylistController@index');
$router->addRoute('/playlists/create', 'PlaylistController@create');
$router->addRoute('/playlists/{id}', 'PlaylistController@show'); // Route avec paramètre
$router->addRoute('/playlists/{id}/edit', 'PlaylistController@edit'); // Route avec paramètre
$router->addRoute('/playlists/{id}/delete', 'PlaylistController@delete'); // Route avec paramètre