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

        <!-- Formatação -->
        <style>
            body{
                background-color: #E1EFFF;
              }
        </style>

        <!-- Titulo -->
        <h2 class="text-center"><img src="img/criar_conteudos.png" class="img" width="500" height="100"></h2>
        <?php
            include('config.php');
    
                $sql_cod = "SELECT * FROM modulo ORDER BY nome ASC";
                $sql_query_modulo = $conn->query($sql_cod) or die($conn->error);
        ?>

        <!-- Formulário -->
        <form method="POST" action="conteudo.php" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nome:</label>
                <input type="text" name="nome" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Tradução:</label>
                <input type="text" name="traducao" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Imagem:</label>
                <input type="file" class="form-control-file" name="imagem">
            </div>
            <div class="form-group">
                <label>Módulo:</label>
                  <select class="form-control" name="modulos">
                    <option value="">Selecione uma das opções</option>
                      <?php while($modulo = $sql_query_modulo->fetch_assoc()) {?>
                        <option value ="<?php echo $modulo['id_modulo']; ?>"><?php echo $modulo['nome']?></option>
                          <?php } ?>
                  </select>
            </div>

            <!-- Botões -->
            <div class="form-group">
                <button type="submit" name="salvar" class="btn btn-secondary btn-block">Salvar</button>           
            </div>
            <div class="form-group">
                <button type="submit" name="consultar" class="btn btn-secondary btn-block">Consultar</button>
            </div>			
        </form>

    </body>
</html>