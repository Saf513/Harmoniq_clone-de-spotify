<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

use app\Models\Database;

require_once __DIR__ . '/../vendor/autoload.php';

$config = require_once __DIR__ . '../../app/Config/config.php';
// $db = $config['database'];
//  var_dump($config);

// 2. Connexion à la base de données (exemple avec PDO)

$db = Database::getConnection();

// 3. Initialisation de Twig
$loader = new FilesystemLoader(__DIR__ . '/Views');
$twig = new Environment($loader, [
    'cache' => $config['twig']['cache'] ? __DIR__ . '/../cache' : false,
    'debug' => $config['app']['debug']
]);

if ($config['app']['debug']) {
    $twig->addExtension(new \Twig\Extension\DebugExtension());
}

// 4. Gestion de la session
session_name($config['session']['name']);
session_set_cookie_params(
    $config['session']['lifetime'],
    $config['session']['path'],
    $config['session']['domain'],
    $config['session']['secure'],
    $config['session']['httponly']
);
session_start();

//Fonction d'aide pour rediriger
function redirect(string $path){
    header("Location: ".$path);
    exit();
}
// Retourne les instances de la db et de twig
return compact('db', 'twig', 'config');