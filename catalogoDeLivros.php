<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema para Catálogo de Livros</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

    <?php
    session_start();
    if (isset($_SESSION["mensagem"])) {
    $mensagem = $_SESSION["mensagem"];
    unset($_SESSION["mensagem"]);
    echo "<script>
        setTimeout(() => {
            exibirMensagem(" . json_encode($mensagem) . ");
        }, 500);
    </script>";
    }
    $form = $_SESSION["formulario"] ?? [];
    ?>

    <h1>Sistema para Catálogo de Livros</h1>
    <form action="incluir.php" method="post">
        <label>Título:</label>
        <input type="text" name="titulo" value="<?= htmlspecialchars($form['titulo'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>

        <label>Autor:</label>
        <input type="text" name="autor" value="<?= htmlspecialchars($form['autor'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>

        <label>Número de Páginas:</label>
        <input type="number" min="0" name="paginas" value="<?= htmlspecialchars($form['paginas'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>

        <label>Gênero:</label>
        <input type="text" name="genero" value="<?= htmlspecialchars($form['genero'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>

        <label>Editora:</label>
        <input type="text" name="editora" value="<?= htmlspecialchars($form['editora'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>

        <label>Situação (Opcional):</label>
        <input type="text" name="situacao" value="<?= htmlspecialchars($form['situacao'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

        <label>Nota (Opcional):</label>
        <input type="number" min="0" step="0.01" name="nota" value="<?= htmlspecialchars($form['nota'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

        <input type="submit" value="Cadastrar o livro">
        <input type="button" value="Pesquisar o livro" onclick="pesquisar()">
    </form>

    <div id="mensagem"></div>
    <div id="resultadoPesquisa"></div>

    <script>
        function alterar(id){
            let classValor = document.getElementsByClassName(id);
            let titulo = classValor[0].value;
            let autor = classValor[1].value;
            let paginas = classValor[2].value;
            let genero = classValor[3].value;
            let editora = classValor[4].value;
            let situacao = classValor[5].value;
            let nota = classValor[6].value;

            const xhttp = new XMLHttpRequest();
            xhttp.open("POST", "alterar.php");
            xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhttp.onload = function () {
                if (xhttp.status == 200) { 
                    exibirMensagem("Cadastro livro atualizado com sucesso");
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    exibirMensagem("Não foi possível atualizar o cadastro do livro, campos obrigatórios: Título, Autor, Número de Páginas, Gênero e Editora");
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            };
            xhttp.send("id=" + id + "&titulo=" + titulo + "&autor=" + autor + "&paginas=" + paginas + "&genero=" + genero + "&editora=" + editora + "&situacao=" + situacao + "&nota=" + nota);
        }

        function excluir(id){
            const xh = new XMLHttpRequest();
            xh.open("POST", "excluir.php");
            xh.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xh.send("id=" + id);
            xh.onload = function() {
                if (xh.status == 200) {
                    exibirMensagem("Cadastro livro excluído com sucesso");
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    exibirMensagem("Não foi possível excluir o cadastro do livro");
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            }
        }

        function pesquisar() {
            let titulo = document.querySelector('input[name="titulo"]').value;
            let autor = document.querySelector('input[name="autor"]').value;
            let paginas = document.querySelector('input[name="paginas"]').value;
            let genero = document.querySelector('input[name="genero"]').value;
            let editora = document.querySelector('input[name="editora"]').value;
            let situacao = document.querySelector('input[name="situacao"]').value;
            let nota = document.querySelector('input[name="nota"]').value;

            const xhttp = new XMLHttpRequest();
            xhttp.open("POST", "pesquisar.php");
            xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhttp.onload = function () {
                if (xhttp.status === 200) {
                    document.querySelector("#tabelaLivros tbody").innerHTML = xhttp.responseText;
                    document.querySelectorAll(".botao-salvar").forEach(botao => {
                        botao.addEventListener("click", function () {
                            let id = this.dataset.id;
                            alterar(id);
                        });
                    });
                } else {
                    alert("Erro ao pesquisar o livro");
                }
            };
            xhttp.send(`titulo=${titulo}&autor=${autor}&paginas=${paginas}&genero=${genero}&editora=${editora}&situacao=${situacao}&nota=${nota}`);
        }

        function exibirMensagem(texto, erro = false) {
            const divMensagem = document.getElementById("mensagem");
            divMensagem.classList.remove("sucesso", "erro");
            divMensagem.classList.add(erro ? "erro" : "sucesso");

            divMensagem.innerText = texto;
            divMensagem.style.display = "block";

            setTimeout(() => {
                divMensagem.style.display = "none";
            }, 3000);
        }
    </script>

</body>
</html>

<?php include_once "exibir.php"; ?> 
<?php exibir(); ?>
