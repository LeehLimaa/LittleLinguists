<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $mensagem = $_POST["mensagem"];

    if (empty($nome) || empty($email) || empty($mensagem)) {
        echo "Por favor, preencha todos os campos.";
    } else {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "little_linguists";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Erro na conexão ao banco de dados: " . $conn->connect_error);
        }

        $sql = "INSERT INTO mensagem (nome, email, mensagem) VALUES ('$nome', '$email', '$mensagem')";

        if ($conn->query($sql) === TRUE) {
            echo "Dados salvos com sucesso!";
        } else {
            echo "Erro ao salvar os dados: " . $conn->error;
        }

        $conn->close();
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
            </div>
        </nav><br><br><br><br><br><br>

        <!-- Formatação -->
        <style>
            body{
                margin: 0;
                display: block;
                width: 100vw;
                height: 100vh;
                padding: 0;
                text-align: ;
                color:white;
                background: url(fundo_msg.png) no-repeat bottom right scroll;
                background-color: #E1EFFF;
                -webkit-background-size: contain;
                -moz-background-size: contain;
                background-size: contain;
                -o-background-size: contain;
            }
            .jumbotron {
                background-color: #ffffff;
                font-size: 14px;
                color: #1F5692 !important;
                position: relative;
                padding: 20px 80px; 
                margin: 70px;
                border: 2px solid #1F5692;
            }
    
            #msg {
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
                <h2 class="text-center"><span id="msg" class="glyphicon glyphicon-envelope"></span></h2><br><br><br>

                <!-- Formulário -->
                <form method="POST" action="mensagem.php">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control" name="nome">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label for="mensagem">Mensagem:</label>
                        <textarea class="form-control" name="mensagem"></textarea>
                    </div>
                    
                    <!-- Botões -->
                    <div class="form-group"><button type="submit" class="btn btn-secondary btn-block">Enviar</button></div>
                </form>
            </div>
        </div> 
    </body>
</html>