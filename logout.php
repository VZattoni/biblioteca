<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
</head>
<body>

<?php
    session_start(); // informa ao PHP que iremos trabalhar com sessão
    session_destroy();
    header('location: /biblioteca/index.php');
    exit();
?>
  
</body>
</html>