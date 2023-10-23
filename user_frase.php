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
        </nav><br><br><br><br>
        <style>
            body{
                background-color: #E1EFFF;
            }   
            .frase-box {
                padding: 30px;
                text-align: center;
                margin: 20px;
                height: auto;
                background-color: white;
            }

            .traducao {
                font-size: 25px;
                font-weight: bold;
            }

            .frase {
                font-size: 20px;
                color: #333;
            }

            .frase-imagem {
                max-width: 100%;
                height: auto;
                margin-top: 10px;
            }
        </style>

        <div class="container">
            <?php
            include('config.php');

            if (isset($_GET['module_id'])) {
                $module_id = $_GET['module_id'];

                $module_sql = "SELECT nome FROM modulo WHERE id_modulo = $module_id";
                $module_result = $conn->query($module_sql);

                if ($module_result->num_rows > 0) {
                    $module_row = $module_result->fetch_assoc();
                    $module_name = $module_row['nome'];

                    echo '<h2 class="module-title text-center"><strong>' . $module_name . '</strong></h2><br>';

                    $frase_sql = "SELECT * FROM frase WHERE id_modulo = $module_id";
                    $frase_result = $conn->query($frase_sql);

                    if ($frase_result->num_rows > 0) {
                        while ($frase_row = $frase_result->fetch_assoc()) {
                            $frase = $frase_row['frase'];
                            $traducao = $frase_row['traducao'];

                            echo '<div class="frase-box">';
                            echo '<p class="traducao">' . $traducao . '</p>';
                            echo '<p class="frase">' . $frase . '</p>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p class="text-center">Nenhuma frase encontrada para este módulo.</p>';
                    }
                } else {
                    echo '<p class="text-center">Módulo não encontrado.</p>';
                }
            } else {
                echo '<p class="text-center">Selecione um módulo para visualizar as frases.</p>';
            }
            ?>
        </div>
    </div><br><br><br>
    </body>
</html>
