<?php 

namespace app\Controllers;
use App\Models\Database;


include_once '../../vendor/autoload.php';

$db = Database :: getInstance();
$pdo = $db->getConnection();


var_dump($db);