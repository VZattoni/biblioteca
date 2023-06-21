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
        $id      = $_POST['Id'];  // identifica o registro a ser alterado
        $titulo    = $_POST['titulo'];
        $autor     = $_POST['autor'];


        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
        }

        $sql = "UPDATE livros SET titulo = '$titulo', id_autor = '$autor' WHERE id = $id";

        if ($result = $conn->query($sql)) {
            $conn->close(); //Encerra conexao com o BD
            header('location: /biblioteca/listarLivros.php');
            exit();
        } else {
            $conn->close(); //Encerra conexao com o BD
            echo "<p style='text-align:center'>Erro executando UPDATE: " . $conn->connect_error . "</p>";
        }
    
      


    ?>




    
</body>
</html>