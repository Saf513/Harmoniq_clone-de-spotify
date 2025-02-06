<?php 
namespace app\Controllers;

include_once '../../vendor/autoload.php';
use \app\Models\Database\Database;

$db = Database :: getInstance();
$pdo = $db->getConnection();


var_dump($db);