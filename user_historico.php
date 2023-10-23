<?php
require ("config.php");
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

$sql_historico = "SELECT rq.id_resposta, q.nome AS nome_questionario, rq.pontuacao, rq.data_execucao
                  FROM resposta_usuario rq
                  INNER JOIN questionario q ON rq.id_questionario = q.id_questionario
                  WHERE rq.id_usuario = ? ORDER BY rq.data_execucao DESC";


$stmt_historico = $conn->prepare($sql_historico);
$stmt_historico->bind_param("i", $user_id);
$stmt_historico->execute();
$result_historico = $stmt_historico->get_result();

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
                        <li class="link"><a href="index_usuario.php" target="_self"  title="Página inicial" class="glyphicon glyphicon-home"></a></li>
                        <li class="link"><a href="mensagem.php" target="_self"  title="Entre em contato conosco!" class="glyphicon glyphicon-envelope"></a></li>
                        <li class="link"><a href="perfil.php" target="_self"  title="Perfil!" class="glyphicon glyphicon-user"></a></li>
                    </ul>
                </div>
            </div>
        </nav><br><br><br>

    <style>
            body{
                background-color: #E1EFFF;
            }
            form {
                margin: 0 auto;
                width: 900px;
                padding: 1em;
                border: 1px solid #FFF;
                border-radius: 1em;
            }

            .table-container {
                margin: 0 auto; 
                max-width: 1000px; 
                padding: 20px; 
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th, td {
                padding: 10px;
                text-align: center;
            }

            th {
                background-color: #76A6E2;
            }

            tr {
                background-color: #fff;
            }
            h2{
                text-align: center;
            } 
        .glyphicon {
            font-size: 16px;
            margin-right: 5px;
        }

    </style>

<div class="table-container">

            <?php
            echo "<table border='1'>";
            echo '<h2 class="text-center"><img src="img/historico_respostas.png" class="img" width="500" height="100"></h2><br>';
            echo '<tr><th>Questionário</th><th>Pontuação</th><th>Data de execução</th><th>Respostas</th></tr>';
            while ($row_historico = $result_historico->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row_historico['nome_questionario'] . "</td>";
                echo "<td>" . $row_historico['pontuacao'] . "</td>";
                $data_execucao = date("d/m/Y", strtotime($row_historico['data_execucao']));

                echo "<td>" . $data_execucao . "</td>";
                echo "<td>";

                // Consulta para obter as respostas corretas e erradas para este questionário
                $id_resposta = $row_historico['id_resposta'];
                $sql_respostas = "SELECT id_questao, correta FROM resposta_questao WHERE id_resposta = ?";
                $stmt_respostas = $conn->prepare($sql_respostas);
                $stmt_respostas->bind_param("i", $id_resposta);
                $stmt_respostas->execute();
                $result_respostas = $stmt_respostas->get_result();

                // Inicializa variáveis para contar respostas corretas e erradas
                $corretas = 0;
                $erradas = 0;

                while ($row_respostas = $result_respostas->fetch_assoc()) {
                    if ($row_respostas['correta'] == 1) {
                        $corretas++;
                    } else {
                        $erradas++;
                    }
                }

                // Exibe ícones correspondentes com base nas respostas corretas e erradas
                if ($corretas > 0) {
                    echo "<span class='glyphicon glyphicon-ok correta'></span> Respostas Corretas: $corretas <br>";
                }

                if ($erradas > 0) {
                    echo "<span class='glyphicon glyphicon-remove errada'></span> Respostas Erradas: $erradas ";
                }

                echo "</td>";
                echo "</tr>";
            }
            ?>
        </div>
    </body>
</html>



<?php
$stmt_historico->close();
$conn->close();
?>
