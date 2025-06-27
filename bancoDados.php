<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "catalogodelivros";

$connection = new mysqli($servername, $username, $password, $dbname);

if ($connection->connect_error) {
        die("Erro na conexão: " . $connection->connect_error);
}

$connection->set_charset("utf8mb4"); 

?>