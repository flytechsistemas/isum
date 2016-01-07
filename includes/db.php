<?php
include 'medoo.php';
$db = new medoo([
// required
	'database_type' => 'mysql',
	'database_name' => 'isum',
	'server' => 'localhost',
	'username' => 'root',
	'password' => 'samsung1',
	'charset' => 'utf8',
	'port' => 3306,
	'option' => [ PDO::ATTR_CASE => PDO::CASE_NATURAL]
]);
?>