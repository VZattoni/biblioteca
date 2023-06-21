<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Biblioteca</title>
</head>
<body>

    <?php
        session_start(); // informa ao PHP que iremos trabalhar com sessão
        require 'db/conectaBD.php'; 

        // Cria conexão
        $conn = new mysqli($servername, $username, $password, $database);

        // Verifica conexão 
        if ($conn->connect_error) {
            die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
        }

        $nome    = $conn->real_escape_string($_POST['nome']); // prepara a string recebida para ser utilizada em comando SQL
        $login   = $conn->real_escape_string($_POST['Login']); // prepara a string recebida para ser utilizada em comando SQL
        $celular = $conn->real_escape_string($_POST['Celular']); // prepara a string recebida para ser utilizada em comando SQL
        $senha   = $conn->real_escape_string($_POST['Senha1']); // prepara a string recebida para ser utilizada em comando SQL
        
        // Faz Select na Base de Dados
        $sql = "INSERT INTO Usuario (Nome, Celular, Login, Senha) VALUES ('$nome','$celular','$login',md5('$senha'))";

        if ($result = $conn->query($sql)) {
            $msg = "Registro cadastrado com sucesso! Você já pode realizar login.";
            $_SESSION ['nao_autenticado'] = true;
            $_SESSION ['mensagem_header'] = "Cadastro";
            $_SESSION ['mensagem']        = $msg;
            header('location: /biblioteca/index.php');
            exit();
        } else {
            $msg = "Erro executando INSERT: " . $conn->connect_error . " Tente novo cadastro.";
            $_SESSION ['nao_autenticado'] = true;
            $_SESSION ['mensagem_header'] = "Cadastro";
            $_SESSION ['mensagem']        = $msg;
            header('location: /biblioteca/index.php');
            exit();
            }
            header('location: index.php');

        $conn->close();  //Encerra conexao com o BD
    ?>
    
</body>
</html>