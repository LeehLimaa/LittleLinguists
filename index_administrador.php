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
                                <li class="link"><a href="criar_conteudo.php" target="_self" title="">Criar novo conteúdo</a></li>
                                <li class="link"><a href="criar_frase.php" target="_self" title="">Criar nova frase</a></li>
                                <li class="link"><a href="criar_questionario.php" target="_self" title="">Criar novo questionário</a></li>
                            </ul>
                        </li>
                        <li class="link"><a href="consultar_mensagem.php" target="_self"  title="Caixa de mensagens" class="glyphicon glyphicon-envelope"></a></li>
                        <li class="link"><a href="usuarios_cadastrados.php" target="_self"  title="Verificar usuários cadastrados" class="glyphicon glyphicon-info-sign"></a></li>
                        <li class="link"><a href="perfil.php" target="_self"  title="Perfil" class="glyphicon glyphicon-user"></a></li>
                    </ul>
                </div>
            </div>
        </nav><br><br><br><br>

        <style>
        body {
            background-color: #E1EFFF;
        }
        
        .panel {
            color: #E1EFFF;
            border: none;
            text-decoration: none;
            background-color: #E1EFFF;
        }

        .panel-heading {
            background-color: #E1EFFF !important;
        }

        .image-container img {
            max-width: 20%;
        } 
        footer {
            text-align: center;
            background-color: #1F5692;
            color: #fff;
        }
        </style>

        <h1 class="text-center"><img src="img/background.png" class="img" width="1200" height="600"></h1><br><br>
        <h2 class="text-center"><img src="img/painel_criacao.png" class="img" width="500" height="100"></h2>

        <div class="image-container">
            <div class="panel panel-default text-center">
                <a href="criar_modulo.php">
                    <img src="img/criar_modulo.png">
                </a>
                
                <a href="criar_conteudo.php">
                    <img src="img/criar_conteudo.png">
                </a>
                
                <a href="criar_frase.php">
                    <img src="img/criar_frase.png">
                </a>

                <a href="criar_questionario.php">
                    <img src="img/criar_questionario.png">
                </a>
            </div>
        </div><br><br><br><br>

        <h2 class="text-center"><img src="img/menu_administrador.png" class="img" width="500" height="100"></h2>

        <div class="image-container">
            <div class="panel panel-default text-center">
                <a href="usuarios_cadastrados.php">
                    <img src="img/usuarios_cadastrados.png">
                </a>
                
                <a href="consultar_mensagem.php">
                    <img src="img/mensagens.png">
                </a>
                
                <a href="perfil.php">
                    <img src="img/acessar_perfil.png">
                </a>
                </a>
            </div>
        </div>

        <a class="text-center"><img src="img/footer.png" class="img" width="1518" height="700"></a>
        
        <footer><br>&copy; 2023 Letícia de Lima Batista<br><br></footer>
    </body>
</html>