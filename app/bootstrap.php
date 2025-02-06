<?php

require_once __DIR__ . '/vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$config = require_once __DIR__ . '/Config/config.php';

// 2. Connexion à la base de données (exemple avec PDO)
try {
    $db = new PDO(
        "mysql:host={$config['database']['host']};dbname={$config['database']['name']};charset=utf8",
        $config['database']['user'],
        $config['database']['password']
    );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit;
}

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