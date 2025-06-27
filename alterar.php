<?php
include "bancoDados.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $id = (int) $_POST["id"];
    $titulo = trim($_POST["titulo"]);
    $autor = trim($_POST["autor"]);
    $paginas = $_POST["paginas"];
    $genero = trim($_POST["genero"]);
    $editora = trim($_POST["editora"]);
    $situacao = trim($_POST["situacao"]);    
    $nota = $_POST["nota"];

    if (
        $titulo === "" ||
        $autor === "" ||
        !is_numeric($paginas) ||
        $genero === "" ||
        $editora  === ""
    ) {
        http_response_code(400);
        echo "Não foi possível atualizar o cadastro do livro, campos obrigatórios: Título, Autor, Número de Páginas, Gênero e Editora";
        exit();
    }

    $update = "UPDATE livros SET titulo='$titulo', autor='$autor', paginas='$paginas', genero ='$genero', editora ='$editora', situacao ='$situacao', nota ='$nota' WHERE id=$id";

    if ($connection->query($update)) {
        echo "Livro atualizado com sucesso";
    } else {
        http_response_code(500);
        echo "Erro ao atualizar: " . $connection->error;
    }
}

$connection->close();
?>
