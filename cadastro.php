<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "config.php";

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $cpf = $_POST["cpf"];
    $data_nasc = $_POST["data_nasc"];
    $senha = $_POST["senha"];
    $perfil = "usuario"; 

    // Criptografar a senha antes de armazenar no banco de dados
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, email, cpf, data_nasc, senha, perfil) VALUES ('$nome', '$email', '$cpf', '$data_nasc', '$senhaHash', '$perfil')";

    if ($conn->query($sql) === TRUE) {
        echo '<p class="text-center">Usuário cadastrado com sucesso!</p>';
    } else {
        echo "Erro ao cadastrar usuário: " . $conn->error;
    }

    $conn->close();
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
        </nav><br><br><br><br>

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
                left: 100px;
                max-width: 800px;
                margin: 50px;
                border: 2px solid #1F5692;
                
            }

            #cad {
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
                <h2 class="text-center">
                    <span id="cad" class="glyphicon glyphicon-user"></span>
                </h2><br><br><br>

                <!-- Formulário -->
                <form method="post" action="cadastro.php">
                    <div class="form-group">
                        <label>Nome:</label><br>
                        <input type="text" name="nome" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email:</label><br>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>CPF:</label><br>
                        <input type="text" name="cpf" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Data de Nascimento:</label><br>
                        <input type="date" name="data_nasc" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <div class="input-group">
                            <input type="password" name="senha" class="form-control" required>
                            <span class="input-group-addon" onclick="togglePassword()" style="border: none; background: none;">
                                <span class="glyphicon glyphicon-eye-open" id="eye"></span>
                            </span>
                    </div>
                </div>



                    <!-- Botões -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-secondary btn-block">Cadastrar</button>           
                    </div>
                    <p id="p" class="text-center">Já possui uma conta? <a href="login.php">Entrar</a></p>
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
