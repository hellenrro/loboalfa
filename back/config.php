<?php
// Configuração do banco de dados
$db_host = 'localhost';
$db_name = 'ong';
$db_user = 'root';
$db_pass = 'root';
$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);