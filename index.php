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
    // session_start();
    // if (isset($_SESSION['login'])) {                    // Se existe usuário logado 
    //     header("location: /biblioteca/index.php");  // Vai para as funcionalidades do site
    //     //TODO Arrumar diretório caso o user esteja logado
    //     exit();
    // }
    ?>

    <?php
        session_start();
        $msg        = "";
        $msg_header = "";

        if (isset($_SESSION['nao_autenticado'])) {
            $msg        = $_SESSION['mensagem'];
            $msg_header = $_SESSION['mensagem_header'];
            if(strlen($msg) != 0){
                echo "<script>alert('" .$msg ."');</script>";
            }
        } else {
            unset($_SESSION['nao_autenticado']);
            if(strlen($msg) != 0){
                echo "<script>alert('" .$msg ."');</script>";
            }            
        }
    ?>

    <div class="container" id="main">
        <div class="welcome">
            Bem vindo à biblioteca!
        </div>
        <div class="welcome" style="font-size: 3rem;">
            🧾
        </div>
        <div class="btn">
            <div class="login-btn" onclick="openContainer('login', 'main')">Login</div>
            <div class="cadastro-btn" onclick="openContainer('cadastro', 'main')">Cadastrar</div>
        </div>
    </div>

    <!-- SECTION LOGIN -->
    <div class="container" id="login" style="display: none;">
        <div class="welcome" style="font-size: 3rem;">Login 📖</div>
        <form action="login.php" method="POST" class="w3-container">
            <div class="box">
                <div class="inputs">
                    <input class="" type="text" name="Login" placeholder="Username" required>
                    <input class="" name="Senha" id="Senha" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,8}" placeholder="Password" title="Deve conter ao menos um número, uma letra maiúscula, uma letra minúscula, um caracter especial, e ter de 6 a 8 caracteres" required>
                </div>
                <p class="show">
                    <input type="checkbox" onclick="mostrarOcultarSenhaLogin()"> <b>Mostrar senha</b>
                </p>
            </div>
            <div class="btn-login">
                <button id="voltar" onclick="openContainer('main', 'login')" type="submit">Voltar</button>
                <button class="login" type="submit">Login</button>
            </div>
        </form>
    </div>



    <!-- SECTION CADASTRO -->
    <div class="container" id="login" style="display: none;">
        <div class="welcome" style="font-size: 3rem;">Login 📖</div>
        <form action="login.php" method="POST" class="w3-container">
            <div class="box">
                <div class="inputs">
                    <input class="" type="text" name="Login" placeholder="Username" required>
                    <input class="" name="Senha" id="Senha" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,8}" placeholder="Password" title="Deve conter ao menos um número, uma letra maiúscula, uma letra minúscula, um caracter especial, e ter de 6 a 8 caracteres" required>
                </div>
                <p class="show">
                    <input  type="checkbox" onclick="mostrarOcultarSenhaLogin()"> <b>Mostrar senha</b>
                </p>
            </div>
            <div class="btn-login">
                <button id="voltar" onclick="openContainer('main', 'login')" type="submit">Voltar</button>
                <button class="login" type="submit">Login</button>
            </div>
        </form>
    </div>


    <div class="container" id="cadastro" style="display: none;">
        <div class="welcome" style="font-size: 3rem;">Cadastro 📚</div>
        <form action="cadastro.php" method="POST">
            <div>
                <div  style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
                <div class="input-div">
                    <label ><b>Nome de usuário</b>*</label>
                    <input  name="nome" type="text" placeholder="Nome">
                </div>
            </div>
            <div>
                <div  style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
                <div class="input-div">
                    <label ><b>Login</b>*</label>
                    <input  name="Login" type="text" pattern="[a-zA-Z]{2,20}\.[a-zA-Z]{2,20}" placeholder="nome.sobrenome" title="nome.sobrenome" required>
                </div>
            </div>
            <div>
                <div  style="width:50px"><i class="w3-xxlarge fa fa-envelope-o"></i></div>
                <div class="input-div">
                    <label ><b>Celular</b>*</label>
                    <input name="Celular" id="Celular" type="text" maxlength="15" placeholder="(XX)XXXXX-XXXX" title="(XX)XXXXX-XXXX" pattern="\([0-9]{2}\)[0-9]{4,6}-[0-9]{3,4}$" required onkeypress="mask(this, mphone);" onblur="mask(this, mphone);">
                </div>
            </div>
            <div>
                <div  style="width:50px"></div>
                <div class="input-div">
                    <label ><b>Senha</b>*</label>
                    <input  name="Senha1" id="Senha1" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,8}" title="Deve conter ao menos um número, uma letra maiúscula, uma letra minúscula, um caracter especial, e ter de 6 a 8 caracteres" required>
                </div>
            </div>

            <div>
                <div  style="width:50px"></div>
                <div class="input-div">
                    <label ><b>Confirma Senha</b>*</label>
                    <input  name="Senha2" id="Senha2" type="password" onkeyup="validarSenha()" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,8}" title="Deve conter ao menos um número, uma letra maiúscula, uma letra minúscula, um caracter especial, e ter de 6 a 8 caracteres" required>
                </div>
            </div>
            <p class="show">
                <input type="checkbox" onclick="mostrarOcultarSenhaCadastro()"> <b>Mostrar senha</b>
            </p>
                <div class="btn-login">
                    <button id="voltar" onclick="openContainer('main', 'cadastro')" type="submit">Voltar</button>
                    <button  type="submit"> Enviar </button>
                </div>
            
        </form>
    </div>

    <script src="./script/script.js"></script>
</body>

</html>