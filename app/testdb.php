<?php

$uri = "postgres://avnadmin:AVNS_saSe8tspt2KUsA95Sxr@pg-2208327-safiakhoulaid11-1c0b.e.aivencloud.com:16056/defaultdb?sslmode=require";

$fields = parse_url($uri);

// build the DSN including SSL settings
$conn = "pgsql:";
$conn .= "host=" . $fields["host"];
$conn .= ";port=" . $fields["port"];;
$conn .= ";dbname=defaultdb";

$db = new PDO($conn, $fields["user"], $fields["pass"]);

foreach ($db->query("SELECT VERSION()") as $row) {
	print($row[0]);
}

?>