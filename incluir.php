<?php
session_start();
include "bancoDados.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $autor = $_POST["autor"];
    $paginas= $_POST["paginas"];
    $genero = $_POST["genero"];
    $editora = $_POST["editora"];
    $situacao = $_POST["situacao"];
    $nota = $_POST["nota"];

    $query = "INSERT INTO livros (titulo, autor, paginas, genero, editora, situacao, nota)
          VALUES ('$titulo', '$autor', '$paginas', '$genero', '$editora', '$situacao', '$nota')";

    if ($connection->query($query)) {
        $_SESSION["mensagem"] = "Livro incluído com sucesso";
    } else {
        $_SESSION["mensagem"] = "Erro ao incluir o livro";
    }

    header("Location: catalogoDeLivros.php"); 
    exit();
}
?>
