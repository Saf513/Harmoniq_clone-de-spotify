<?php

use App\Core\Router;

$router = new Router();

$router->addRoute('/', 'HomeController@index');
$router->addRoute('/about', 'HomeController@about');
$router->addRoute('/contact', 'HomeController@contact');

$router->addRoute('/login', 'AuthController@login');
$router->addRoute('/register', 'AuthController@register');
$router->addRoute('/logout', 'AuthController@logout');

$router->addRoute('/dashboard', 'UserController@dashboard');
$router->addRoute('/profile', 'UserController@profile');
$router->addRoute('/settings', 'UserController@settings');

$router->addRoute('/artist/upload', 'ArtistController@uploadSong');
$router->addRoute('/artist/manage', 'ArtistController@manageSongs');

$router->addRoute('/admin/users', 'AdminController@manageUsers');
$router->addRoute('/admin/songs', 'AdminController@manageSongs');

$router->addRoute('/playlists', 'PlaylistController@index');
$router->addRoute('/playlists/create', 'PlaylistController@create');
$router->addRoute('/playlists/{id}', 'PlaylistController@show'); 
$router->addRoute('/playlists/{id}/delete', 'PlaylistController@delete'); 