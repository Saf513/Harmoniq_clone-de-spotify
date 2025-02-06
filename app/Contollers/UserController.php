<?php 
namespace app\Controllers;
use app\Models\Database\Database;

$db = Database :: getInstance();
$pdo = $db->getConnection();


var_dump($db);