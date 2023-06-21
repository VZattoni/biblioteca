<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Biblioteca</title>
</head>

<body>
    <?php require 'db/conectaBD.php'; ?>
    <?php
    session_start();
    if (!isset($_SESSION['login'])) {                              // Não houve login ainda
        unset($_SESSION['nao_autenticado']);
        unset($_SESSION['mensagem_header']);
        unset($_SESSION['mensagem']);
        header('location: /biblioteca/index.php');    // Vai para a página inicial
        exit();
    }
    ?>
    <div class="container" id="list">
        <div class="header">

            <div class="title-list">
                <h2>
                    Minha biblioteca
                </h2>
                <div class="add" onclick="openContainer('list-include', 'list')">+</div>
            </div>
            <div class="exit-div">
                <div>
                    Admin: <?php echo $_SESSION['nome']; ?>&nbsp;
                </div>
                <div class="logout-btn" onclick="window.location.href = 'logout.php'">
                    Sair
                </div>
            </div>
        </div>
        <div class="real-list">
            <div class="list-container">
                <ul class="list-titles">
                    <li>
                        <div class="titulo">Título</div>
                        <div class="autor">Autor</div>
                        <div class="id_autor">Código do Autor</div>
                        <div class="id_obra">Código do Livro</div>
                    </li>
                </ul>
            </div>

            <?php
            // Cria conexão
            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
            }


            $sql = 'SELECT A.id as"Código do Autor" , L.id as "Código do Livro",
                        L.titulo, A.nome AS autor
                        FROM livros AS L
                        INNER JOIN autores AS A ON (L.id_autor = A.id)
                        ORDER BY L.id;';

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {


                    echo '    <ul class="list-books"> ';
                    echo '        <li> <div class="titulo">' . $row["titulo"] . '</div> <div class="autor">' . $row["autor"] . '</div> <div class="id_autor">' . $row["Código do Autor"] . '</div> <div class="id_obra">' . $row["Código do Livro"] . '<div class="btns"> <div class="delete" onclick="sendUrl(' . $row["Código do Livro"] . ',' . true . ')">❌</div><div class="edit" onclick="sendUrl(' . $row["Código do Livro"] . ',' . false . ')">📃</div></div> </div> </li> ';
                    echo '    </ul> ';
                }
            }
            ?>
        </div>
    </div>



    <div class="container" id="list-include" style="display: none;">
        <?php

        $sqlG = "SELECT id, nome FROM autores";
        $result = $conn->query($sqlG);
        $optionsEspec = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($optionsEspec, "\t\t\t<option value='" . $row["id"] . "'>" . $row["nome"] . "</option>\n");
            }
        } else {
            echo "Erro executando SELECT: " . $conn->connect_error;
        }
        $conn->close();

        ?>



    <h1>Incluir um livro</h1>

        <form class="form-include" action="includeExe.php" method="post" enctype="multipart/form-data">
           
                <div class="title-include">
                </div>
                <tr>
                    <td style="width:50%;">
                        <p class="p-form">
                            <label class="w3-text-IE">
                                <b>Título</b>*
                            </label>
                            <input name="titulo" type="text" required>
                        </p>
                        
                        <p class="p-form">
                            <label class="w3-text-IE">
                                <b>Autor</b>*
                            </label>
                            <select name="autor" id="autor" required>
                                <option value=""></option>
                                <?php
                                foreach ($optionsEspec as $key => $value) {
                                    echo $value;
                                }
                                ?>
                            </select>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center">
                        <p class="btn-update">
                            <input type="submit" value="Salvar" class="w3-btn w3-theme">
                            <input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="openContainer('list', 'list-include')">
                        </p>
                    </td>
                </tr>
        </form>
    </div>

    <script src="./script/script.js"></script>
</body>

</html>