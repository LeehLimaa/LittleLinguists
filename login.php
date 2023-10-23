<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "config.php";

    $login = $_POST["login"]; // Email ou CPF
    $senha = $_POST["senha"];

    // Verificar se o login é um email ou CPF
    $tipo_identificador = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'cpf';

    $sql = "SELECT id_usuario, nome, senha, perfil FROM usuarios WHERE $tipo_identificador = '$login'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($senha, $row["senha"])) {
            $_SESSION["user_id"] = $row["id_usuario"];
            $_SESSION["username"] = $row["nome"];
            $_SESSION["perfil"] = $row["perfil"];

            if ($row["perfil"] == "usuario") {
                header("Location: index_usuario.php"); // Redireciona usuários comuns
            } elseif ($row["perfil"] == "administrador") {
                header("Location: index_administrador.php"); // Redireciona administradores
            }
            exit();
        } else {
            echo '<p class="text-center">Senha incorreta!</p>';
        }
    } else {
        echo '<p class="text-center">Usuário não encontrado!</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>LittleLinguists</title>
        <meta charset="utf-8"/>
        <meta name="description" content="Sistema web para ensinar ingles para as criancas">
        <meta name="keywords" content="Inglês, crianças">
        <meta name="author" content="Leticia de Lima Batista">
        <link rel="icon" type="image/png" href="img/icone.png"/>
        <link href="estilo.css" rel="stylesheet"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>

    <body>
        <!-- Menu -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"></button>
                    <img class="navbar-brand" href="#" src="img/logo.png"/>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="link"><a href="index.html" target="_self"  title="Voltar para a página inicial" class="glyphicon glyphicon-home"></a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Formatação -->
        <style>
            body{
                background-color: #E1EFFF;
            }
            #p{
                font-size: 12px; 
            }
            .jumbotron {
                background-color: #ffffff;
                font-size: 14px;
                color: #1F5692 !important;
                position: relative;
                padding: 5px;
                max-width: 700px;
                margin: 200px;
                border: 2px solid #1F5692;
                
            }
    
            #log {
                color: white !important;
                font-size: 100px;
                position: absolute;
                top: -70px;
                left: 50%;
                transform: translateX(-50%);
                border: 2px solid #1F5692;
                border-radius: 50%;
                padding: 30px;
                background-color: #1F5692;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            
        </style>

        <div class="container">
            <div class="jumbotron">
                <h2 class="text-center"><span id="log" class="glyphicon glyphicon-user"></span></h2><br><br><br>

                <!-- Formulário -->
                <form method="post" action="login.php">
                    <div class="form-group">
                        <label>Email ou CPF:</label><br>
                        <input type="text" name="login" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <div class="input-group">
                            <input type="password" name="senha" class="form-control" required>
                            <span class="input-group-addon" onclick="togglePassword()" style="border: none; background: none;">
                                <span class="glyphicon glyphicon-eye-open" id="eye"></span>
                            </span>
                    </div>

                    <!-- Botões -->
                    <div class="form-group"><button type="submit" class="btn btn-secondary btn-block">Entrar</button></div>
                    <p id="p" class="text-center">Não tem uma conta? <a href="cadastro.php">Cadastrar-se</a></p>
                </form>
            </div>
        </div> 

        <!-- JavaScript -->
        <script>
            function togglePassword() {
                var senhaInput = document.getElementsByName('senha')[0];
                var eyeIcon = document.getElementById('eye');
                
                var type = senhaInput.getAttribute('type') === 'password' ? 'text' : 'password';
                senhaInput.setAttribute('type', type);
                
                if (type === 'text') {
                    eyeIcon.classList.remove('glyphicon-eye-open');
                    eyeIcon.classList.add('glyphicon-eye-close');
                } else {
                    eyeIcon.classList.remove('glyphicon-eye-close');
                    eyeIcon.classList.add('glyphicon-eye-open');
                }
            }

        </script>
    </body>
</html>
