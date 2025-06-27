<?php

function exibir() {
    include_once "bancoDados.php";

    $query = $connection->query("SELECT * FROM livros");

    if ($query->num_rows > 0) {
        echo <<<HTML
        <p class="titulo-livros">Livros cadastrados</p>
        <table id="tabelaLivros">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Número de Páginas</th>
                    <th>Gênero</th>
                    <th>Editora</th>
                    <th>Situação</th>
                    <th>Nota</th>
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
        HTML;

        while ($row = $query->fetch_assoc()) {
            $id = $row['id'];
            $titulo = htmlspecialchars($row['titulo'], ENT_QUOTES, 'UTF-8');
            $autor = htmlspecialchars($row['autor'], ENT_QUOTES, 'UTF-8');
            $paginas = htmlspecialchars($row['paginas'], ENT_QUOTES, 'UTF-8');
            $genero = htmlspecialchars($row['genero'], ENT_QUOTES, 'UTF-8');
            $editora = htmlspecialchars($row['editora'], ENT_QUOTES, 'UTF-8');
            $situacao = htmlspecialchars($row['situacao'], ENT_QUOTES, 'UTF-8');
            $nota = htmlspecialchars($row['nota'], ENT_QUOTES, 'UTF-8');

            echo <<<HTML
            <tr>
                <td><input type="text" data-id="$id" value="$titulo" class="campo $id"></td>
                <td><input type="text" data-id="$id" value="$autor" class="campo $id"></td>
                <td><input type="number" data-id="$id" value="$paginas" class="campo $id"></td>
                <td><input type="text" data-id="$id" value="$genero" class="campo $id"></td>
                <td><input type="text" data-id="$id" value="$editora" class="campo $id"></td>
                <td><input type="text" data-id="$id" value="$situacao" class="campo $id"></td>
                <td><input type="number" data-id="$id" value="$nota" class="campo $id"></td>
                <td><input type="button" onclick="alterar($id)" value="Salvar alterações"></td>
                <td><input type="button" onclick="excluir($id)" value="Excluir"></td>
            </tr>
            HTML;
        }

        echo "</tbody></table>";
    } else {
        echo "<p class='mensagem-centralizada'>Não existem livros cadastrados</p>";
    }

    $connection->close(); 
}
?>
