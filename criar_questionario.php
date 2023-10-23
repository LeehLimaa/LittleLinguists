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
        <h2 class="text-center"><img src="img/criar_questionarios.png" class="img" width="500" height="100"></h2>

        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "little_linguists";
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if ($conn->connect_error) {
                die("Erro de conexão: " . $conn->connect_error);
            }
    
                $sql_cod = "SELECT * FROM modulo ORDER BY nome ASC";
                $sql_query_modulo = $conn->query($sql_cod) or die($conn->error);
        ?>

        <!-- Formulário -->
        <form method="POST" action="questionario.php">
            <div class="form-group">
                <label>Nome do questionário:</label>
                <input type="text" name="nome" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Módulo:</label>
                  <select class="form-control" name="id_modulo">
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

        <!-- Titulo -->
        <h2 class="text-center"><img src="img/criar_questoes.png" class="img" width="500" height="100"></h2>

        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "little_linguists";
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if ($conn->connect_error) {
                die("Erro de conexão: " . $conn->connect_error);
            }
    
                $sql_cod = "SELECT * FROM questionario ORDER BY nome ASC";
                $sql_query_questionario = $conn->query($sql_cod) or die($conn->error);
        ?>

        <!-- Formulário -->
        <form method="POST" action="questao.php">
            <div class="form-group">
                <label>Questionário:</label>
                  <select class="form-control" name="id_questionario">
                    <option value="">Selecione uma das opções</option>
                      <?php while($questionario = $sql_query_questionario->fetch_assoc()) {?>
                        <option value ="<?php echo $questionario['id_questionario']; ?>"><?php echo $questionario['nome']?></option>
                          <?php } ?>
                  </select>
            </div>
            <div class="form-group">
                <label>Enunciado:</label>
                <textarea class="form-control" rows="6" cols="40" name="enunciado"></textarea> 
            </div>
            <div class="form-group">
                <label>A:</label>
                <textarea class="form-control" rows="6" cols="40" name="a"></textarea>
            </div>
            <div class="form-group">
                <label>B:</label>
                <textarea class="form-control" rows="6" cols="40" name="b"></textarea>
            </div>
            <div class="form-group">
                <label>C:</label>
                <textarea class="form-control" rows="6" cols="40" name="c"></textarea>
            </div>
            <div class="form-group">
                <label>D:</label>
                <textarea class="form-control" rows="6" cols="40" name="d"></textarea>
            </div>
            <div class="form-group">
                <label>Resposta correta:</label>
                <select class="form-control" name="resposta">
                    <option value="">Selecione uma das opções</option>
                    <option value="a">A</option>
                    <option value="b">B</option>
                    <option value="c">C</option>
                    <option value="d">D</option>
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