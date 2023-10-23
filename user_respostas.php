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
        <!-- Menu -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"></button>
                    <img class="navbar-brand" href="#" src="img/logo.png"/>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="link"><a href="index_usuario.php" target="_self"  title="Página inicial" class="glyphicon glyphicon-home"></a></li>
                        <li class="link"><a href="mensagem.php" target="_self"  title="Entre em contato conosco!" class="glyphicon glyphicon-envelope"></a></li>
                        <li class="link"><a href="perfil.php" target="_self"  title="Perfil!" class="glyphicon glyphicon-user"></a></li>
                    </ul>
                </div>
            </div>
        </nav><br><br><br>

        <style>
        body {
            background-color: #E1EFFF;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
    
        .animated-text {
            font-size: 50px;
            color: #76A6E2;
            animation: pulse 1s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1); 
            }
            100% {
                transform: scale(1);
            }
        }
    
        </style>

    <body class="text-center">
        <?php
        session_start();

        require_once "config.php"; 

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_questionario'])) {
            if(isset($_SESSION["user_id"])) {
                $id_usuario = $_SESSION["user_id"];
            } else {
                header("Location: login.php");
                exit();
            }

            $id_questionario = $_POST['id_questionario'];

            $data_execucao = date("Y-m-d H:i:s"); 

            $sql_resposta_usuario = "INSERT INTO resposta_usuario (id_usuario, id_questionario, data_execucao) VALUES (?, ?, ?)";
            $stmt_resposta_usuario = $conn->prepare($sql_resposta_usuario);
            $stmt_resposta_usuario->bind_param("iis", $id_usuario, $id_questionario, $data_execucao);

            if ($stmt_resposta_usuario->execute()) {
                $id_resposta = $stmt_resposta_usuario->insert_id;
                $pontuacao = 0;

                foreach ($_POST as $key => $value) {
                    if (strpos($key, "answer_") !== false) {
                        $id_questao = str_replace("answer_", "", $key);
                        $resposta_dada = $conn->real_escape_string($value);

                        $sql_resposta_correta = "SELECT resposta FROM questao WHERE id_questao = ?";
                        $stmt_resposta_correta = $conn->prepare($sql_resposta_correta);
                        $stmt_resposta_correta->bind_param("i", $id_questao);
                        $stmt_resposta_correta->execute();
                        $stmt_resposta_correta->bind_result($resposta_correta);
                        $stmt_resposta_correta->fetch();
                        $stmt_resposta_correta->close();

                        $correta = ($resposta_dada === $resposta_correta) ? 1 : 0;

                        $sql_resposta_questao = "INSERT INTO resposta_questao (id_resposta, id_questao, resposta_dada, correta) VALUES (?, ?, ?, ?)";
                        $stmt_resposta_questao = $conn->prepare($sql_resposta_questao);
                        $stmt_resposta_questao->bind_param("iisi", $id_resposta, $id_questao, $resposta_dada, $correta);

                        if (!$stmt_resposta_questao->execute()) {
                            echo "Erro ao inserir resposta da questão: " . $stmt_resposta_questao->error;
                        } else {
                            $pontuacao += $correta;
                        }

                        $stmt_resposta_questao->close();
                    }
                }

                $sql_atualizar_pontuacao = "UPDATE resposta_usuario SET pontuacao = ? WHERE id_resposta = ?";
                $stmt_atualizar_pontuacao = $conn->prepare($sql_atualizar_pontuacao);
                $stmt_atualizar_pontuacao->bind_param("ii", $pontuacao, $id_resposta);
                $stmt_atualizar_pontuacao->execute();
                $stmt_atualizar_pontuacao->close();

                echo '<p class="text-center"><img src="img/pontuacao.png" class="img" width="500" height="100"></p>';
                echo "<p class='animated-text'><strong>0" . $pontuacao . "</strong></p>";

 
            } else {
                echo "Erro ao inserir resposta do usuário: " . $stmt_resposta_usuario->error;
            }

            $stmt_resposta_usuario->close();
        } else {
            echo "Erro ao processar respostas.";
        }

        $conn->close();
        ?>

    </body>
</html>
