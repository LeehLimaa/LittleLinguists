<?php
    require_once "config.php"; 

    if (isset($_GET['id'])) {
        $id_modulo = $_GET['id'];
        $sql = "SELECT id_modulo, nome FROM modulo WHERE id_modulo = $id_modulo";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $nome = $row["nome"];
        } else {
            echo "Registro não encontrado.";
            exit;
        }
    } else {
        echo "ID do registro não fornecido.";
        exit;
    }

    if (isset($_POST['editar'])) {
        $nome = $_POST['nome'];
        $sql = "UPDATE modulo SET nome='$nome' WHERE id_modulo=$id_modulo";

        if ($conn->query($sql) === TRUE) {
            echo "Registro atualizado com sucesso.";
        } else {
            echo "Erro ao atualizar registro: " . $conn->error;
        }
    }
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
            body{
                background-color: #E1EFFF;
              }
        </style>

        <div class="text-center"><h2 class="text-center"><img src="img/editar.png" class="img" width="500" height="100"></h2></div>
        <form method="POST" action="" >
            <div class="form-group">
                <label for="nome"> Nome:</label>
                <input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>"><br>
            </div>
            <div class="form-group"><button type="submit" value="salvar" name="editar" class="btn btn-secondary btn-block">Atualizar Dados</button></div>
        </form><br>
    </body>
</html>
