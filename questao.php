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
                        <li class="link"><a href="index_administrador.php" target="_self"  title="Página inicial" class="glyphicon glyphicon-home"></a></li>
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-plus" title="Painel de criação"></span></a>
                            <ul class="dropdown-menu">
                                <li class="link"><a href="criar_modulo.php" target="_self" title="">Criar novo módulo</a></li>
                                <li class="link"><a href="criar_questionario.php" target="_self" title="">Criar novo questionário</a></li>
                            </ul>
                        </li>
                        <li class="link"><a href="consultar_mensagem.php" target="_self"  title="Caixa de mensagens" class="glyphicon glyphicon-envelope"></a></li>
                        <li class="link"><a href="perfil.php" target="_self"  title="Perfil" class="glyphicon glyphicon-user"></a></li>
                    </ul>
                </div>
            </div>
        </nav><br><br><br><br>

        <!-- Formatação -->
        <style>    
            body{
                background-color: #E1EFFF;
                color: #000;
                margin:2em;     
            }     
            .question-card {
                border-radius: 10px;
                margin: 0 auto; /* Center horizontally */
                margin-bottom: 20px;
                padding: 15px;
                background-color: #fff;
                max-width: 700px;
            }

            .question-card .card-header {
                background-color: #000;
                border-bottom: none;
                text-align: center;
                font-size: 25px;
                background-color: #1F5692; 
                color: white; 
            }

            .btn-group {
                margin-top: 10px;
            } 
            
            
        </style>

        <div class="container mt-5">
            <?php
                require_once "config.php"; 

                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["salvar"])) {
                    $id_questionario = $_POST["id_questionario"];
                    $enunciado = $_POST["enunciado"];
                    $a = $_POST["a"];
                    $b = $_POST["b"];
                    $c = $_POST["c"];
                    $d = $_POST["d"];
                    $resposta = $_POST["resposta"];
                
                    $sql = "INSERT INTO questao (id_questionario, enunciado, a, b, c, d, resposta)
                            VALUES ('$id_questionario', '$enunciado', '$a', '$b', '$c', '$d', '$resposta')";
                    if ($conn->query($sql) === TRUE) {
                        echo '<p class="text-center">Questão adicionada com sucesso!</p>';
                    } else {
                        echo "Erro ao adicionar questão: " . $conn->error;
                    }

                }else {
                    $sql = "SELECT questao.*, questionario.nome AS nome_questionario FROM questao
                            INNER JOIN questionario ON questao.id_questionario = questionario.id_questionario";
            
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $questionsByQuestionario = [];
                
                        while ($row = $result->fetch_assoc()) {
                            $nome_questionario = $row["nome_questionario"];
                
                            // Criar um array para agrupar as perguntas pelo nome do questionário
                            if (!isset($questionsByQuestionario[$nome_questionario])) {
                                $questionsByQuestionario[$nome_questionario] = [];
                            }
                
                            // Adicionar a pergunta ao array do questionário correspondente
                            $questionsByQuestionario[$nome_questionario][] = $row;
                        }
                
                        // Exibir as perguntas agrupadas por questionário
                        foreach ($questionsByQuestionario as $nome_questionario => $questions) {
                            echo '<div class="question-card">';
                            echo '<div class="card-header">' . $nome_questionario . '</div>';
                            echo '<div class="card-body">';
                            
                            foreach ($questions as $question) {
                                echo '<h5 class="card-title">' . $question["enunciado"] . '</h5>';
                                echo '<p class="card-text"><strong>A:</strong> ' . $question["a"] . '</p>';
                                echo '<p class="card-text"><strong>B:</strong> ' . $question["b"] . '</p>';
                                echo '<p class="card-text"><strong>C:</strong> ' . $question["c"] . '</p>';
                                echo '<p class="card-text"><strong>D:</strong> ' . $question["d"] . '</p>';
                                echo '<p class="card-text"><strong>Resposta:</strong> ' . $question["resposta"] . '</p>';
                                echo '<div class="btn-group">';
                                echo '<a href="editar_questao.php?id=' . $question['id_questao'] . '" class="btn btn"><span class="glyphicon glyphicon-pencil"></span></a>';
                                echo '<a href="?excluir=' . $question['id_questao'] . '" class="btn btn"><span class="glyphicon glyphicon-trash"></span></a>';
                                echo '</div>';
                                echo '<hr>';
                            }
                
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p class="text-center">Nenhuma questão encontrada.</p>';
                    }
                }

                if (isset($_GET['excluir'])) {
                    $id_questao = $_GET['excluir'];
                
                    // Assuming $conn is your database connection
                    $sql = "DELETE FROM questao WHERE id_questao = ?";
                
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $id_questao); // "i" indicates integer type
                    if ($stmt->execute()) {
                        echo '<p class="text-center">Registro excluído com sucesso!</p>';
                    } else {
                        echo '<p class="text-center">Erro ao excluir registro: </p>' . $stmt->error;
                    }
                    $stmt->close();
                }
            ?>
        </div>
    </body>
</html>