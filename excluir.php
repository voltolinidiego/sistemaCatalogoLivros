<?php
include "bancoDados.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $livroId = (int) $_POST["id"];

    $deleteQuery = "DELETE FROM livros WHERE id = $livroId";
    $connection->query($deleteQuery);
}

$connection->close(); 
?>
