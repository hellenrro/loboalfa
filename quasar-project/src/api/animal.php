<?php
$dbhost = 'database-1.cjomx2prydz9.us-east-2.rds.amazonaws.com';
$dbport = 3306;
$dbname = 'database-1';
$charset = 'utf8' ;

$dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";
$username = $_SERVER['RDS_USERNAME'];
$password = $_SERVER['RDS_PASSWORD'];

$pdo = new PDO($dsn, $username, $password);
?>
