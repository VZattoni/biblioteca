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

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
    }

    $id = $_GET['id'];

    $sql = "DELETE FROM livros WHERE id = $id";

    if ($result = mysqli_query($conn, $sql)) {
        header('location: /biblioteca/listarLivros.php');
        exit();
    } else {
        echo "<p>&nbsp;Erro executando DELETE: " . mysqli_error($conn) . "</p>";
    }

    mysqli_close($conn);

    ?>


</body>

</html>