<?php
include "bancoDados.php";

$titulo = $_POST["titulo"] ?? "";
$autor = $_POST["autor"] ?? "";
$paginas = $_POST["paginas"] ?? "";
$genero = $_POST["genero"] ?? "";
$editora = $_POST["editora"] ?? "";
$situacao = $_POST["situacao"] ?? "";
$nota = $_POST["nota"] ?? "";

$query = "SELECT * FROM livros WHERE 1=1";
if ($titulo !== "") $query .= " AND titulo LIKE '%$titulo%'";
if ($autor !== "") $query .= " AND autor LIKE '%$autor%'";
if ($paginas !== "") $query .= " AND paginas = $paginas";
if ($genero !== "") $query .= " AND genero LIKE '%$genero%'";
if ($editora !== "") $query .= " AND editora LIKE '%$editora%'";
if ($situacao !== "") $query .= " AND situacao LIKE '%$situacao%'";
if ($nota !== "") $query .= " AND nota = $nota";

$result = $connection->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td><input type='text' data-id='{$row['id']}' value='{$row['titulo']}' class='campo {$row['id']}'></td>
                <td><input type='text' data-id='{$row['id']}' value='{$row['autor']}' class='campo {$row['id']}'></td>
                <td><input type='number' data-id='{$row['id']}' value='{$row['paginas']}' class='campo {$row['id']}'></td>
                <td><input type='text' data-id='{$row['id']}' value='{$row['genero']}' class='campo {$row['id']}'></td>
                <td><input type='text' data-id='{$row['id']}' value='{$row['editora']}' class='campo {$row['id']}'></td>
                <td><input type='text' data-id='{$row['id']}' value='{$row['situacao']}' class='campo {$row['id']}'></td>
                <td><input type='number' data-id='{$row['id']}' value='{$row['nota']}' class='campo {$row['id']}'></td>
                <td><input type='button' class='botao-salvar' data-id='{$row['id']}' value='Salvar alterações' onclick='alterar({$row['id']})'></td>
                <td><input type='button' onclick='excluir({$row['id']})' value='Excluir'></td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6' class='mensagem-pesquisar'>Nenhum livro encontrado, favor pesquisar novamente</td></tr>";
}

$connection->close(); 
?>
