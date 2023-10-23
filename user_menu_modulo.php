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
         body {
            background-color: #E1EFFF;
        }   
        .module-box {
        padding: 20px;
        text-align: center;
        margin: 10px;
        height: 130px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        color: black;
        }

        .btn-branco {
            background-color: white;
            color: black;
            border: white;
        }
        
    </style>

    <div class="container">
    <h2 class="text-center"><img src="img/selecione_modulo.png" class="img" width="500" height="100"></h2>
        <div class="row">
            <?php
            include('config.php');

            $cores = array( '#F0E58A', '#C49CCF', '#F7B7C5', '#D1EDA9', '#AAC6E8');

            $sql = "SELECT * FROM modulo";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                $cor_index = 0; 
                while ($row = $result->fetch_assoc()) {
                    $module_id = $row['id_modulo'];
                    $module_name = $row['nome'];
                    
                    $cor_atual = $cores[$cor_index % count($cores)];

                    echo '<div class="col-md-4">';
                    echo '<div class="module-box" style="background-color: ' . $cor_atual . ';">';
                    echo '<h4><strong style="font-size: 20px;">' . $module_name . '</strong></h4>';
                    echo '<a href="user_modulo.php?module_id=' . $module_id . '" class="btn btn-primary btn-branco">Abrir</a>';
                    echo '</div>';
                    echo '</div>';

                    $cor_index++;
                }
            } else {
                echo '<div class="col-md-12">';
                echo '<p>Nenhum módulo encontrado.</p>';
                echo '</div>';
            }

            ?>
        </div>
    </div>
    </body>
</html>