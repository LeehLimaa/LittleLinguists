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
        </nav>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #E1EFFF;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #000;
        }
        #container {
            width: 80%;
            max-width: 800px;
            margin: 50px;
            padding: 15px;
            background-color: #E1EFFF;
            box-shadow: #E1EFFF;
            border-radius: 10px;
        }
        .question-card {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            text-align: left;
        }
        label {
            display: block;
            margin: 8px 0;
            cursor: pointer;
            color: #000 !important;
        }
        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #1F5692;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.s ease;
        }
        button:hover {
            background-color: #0E3C6F;
        }
    </style>
    </style><br><br><br><br>
    <div class="container mt-5" id="container">
        <?php
        
        require_once "config.php"; 

        if (isset($_GET['id_questionario'])) {
            $id_questionario = $_GET['id_questionario'];

            // Recupere perguntas do questionário
            $sql = "SELECT * FROM questao WHERE id_questionario = $id_questionario ORDER BY RAND() LIMIT 5";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<form method="POST" action="user_respostas.php">';
                echo '<input type="hidden" name="id_questionario" value="' . $id_questionario . '">';
                echo '<h1 class="text-center"><img src="img/responder_questionario.png" class="img" width="500" height="100"></h1>';

                while ($row = $result->fetch_assoc()) {
                    echo '<div class="question-card">';
                    echo '<p>' . $row['enunciado'] . '</p>';
                    echo '<label><input type="radio" name="answer_' . $row['id_questao'] . '" value="a"> A) ' . $row['a'] . '</label>';
                    echo '<label><input type="radio" name="answer_' . $row['id_questao'] . '" value="b"> B) ' . $row['b'] . '</label>';
                    echo '<label><input type="radio" name="answer_' . $row['id_questao'] . '" value="c"> C) ' . $row['c'] . '</label>';
                    echo '<label><input type="radio" name="answer_' . $row['id_questao'] . '" value="d"> D) ' . $row['d'] . '</label>';
                    echo '</div>';
                }

                echo '<button type="submit" class="btn btn-secondary btn-block">Enviar Respostas</button>';
                echo '</form>';
            } else {
                echo "<p>Nenhuma pergunta encontrada para este questionário.</p>";
            }
        } else {
            echo '<p class="text-center">Questionário não especificado.</p>';
        }
        ?>
    </div>

</body>
</html>
