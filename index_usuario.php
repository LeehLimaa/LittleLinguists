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
                        <li class="link"><a href="mensagem.php" target="_self"  title="Entre em contato conosco!" class="glyphicon glyphicon-envelope"></a></li>
                        <li class="link"><a href="perfil.php" target="_self"  title="Perfil!" class="glyphicon glyphicon-user"></a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <br><br><br><br>

        <style>
        body {
            background-color: #E1EFFF;
        }
        
        .panel {
            color: #E1EFFF;
            border: none;
            text-decoration: none;
            transition: transform 0.2s;
            background-color: #E1EFFF;
        }

        .panel-heading {
            background-color: #E1EFFF !important;
        }

        .image-container img {
            max-width: 25%;
        } 
        footer {
            text-align: center;
            background-color: #1F5692;
            color: #fff;
        }

        </style>

        <h1 class="text-center"><img src="img/background.png" class="img" width="1200" height="600"></h1><br><br>
        <h2 class="text-center"><img src="img/sub.png" class="img" width="500" height="100"></h2>

        <div class="image-container">
            <div class="panel panel-default text-center">
                <a href="user_menu_modulo.php">
                    <img src="img/modulo.png">
                </a>
                
                <a href="user_menu_frase.php">
                    <img src="img/frases.png">
                </a>
                
                <a href="user_menu_questionario.php">
                    <img src="img/questionario.png">
                </a>
            </div>
        </div>
        <div class="image-container">
            <div class="panel panel-default text-center">
                <a href="user_historico.php">
                    <img src="img/revisao.png">
                </a>
                
                <a href="mensagem.php">
                    <img src="img/suporte.png">
                </a>
                
                <a href="perfil.php">
                    <img src="img/perfil.png">
                </a>
            </div>
        </div>

        <a class="text-center"><img src="img/footer.png" class="img" width="1518" height="700"></a>

        <footer><br>&copy; 2023 Letícia de Lima Batista<br><br></footer>
    </body>
</html>
 
