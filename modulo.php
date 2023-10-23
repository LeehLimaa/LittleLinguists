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
        </nav><br><br>

        <style>    
            body{
            background-color: #E1EFFF;
            color: #000;
            margin:2em;     
            }  

            th{
                color: #1F5692; 
            }       
        </style>

        <?php
            require_once "config.php"; 

            if (isset($_POST['salvar'])) {
                $nome = $_POST['nome'];
                $sql = "INSERT INTO modulo (nome) VALUES ('$nome')";

                if ($conn->query($sql) === TRUE) {
                    echo '<br><p class="text-center">Registro criado com sucesso!</p>';
                } else {
                    echo '<p class="text-center">Erro ao criar registro: </p>' . $conn->error;
                }
            }else{
                $sql = "SELECT * FROM modulo";
                $selecao = mysqli_query($conn, $sql);
                $quantidadeSelecionada = mysqli_num_rows($selecao);

                echo '<h2 class="text-center"><img src="img\consultar.png" class="img" width="500" height="100"></h2>';
                echo '<table class="table table-striped">';
                echo "<thead><tr><th>ID</th><th>Nome</th><th>Editar</th><th>Excluir</th></tr></thead>";
                echo '<tbody>';

                while ($vetor = mysqli_fetch_assoc($selecao)) {
                    echo "<tr>";
                    echo "<td>" . $vetor['id_modulo'] . "</td>";
                    echo "<td>" . $vetor['nome'] . "</td>";
                    echo "<td><a href='editar_modulo.php?id=" . $vetor['id_modulo'] . "' class='btn'><span class='glyphicon glyphicon-pencil'></span></a></td>";
                    echo "<td><a href='?excluir=" . $vetor['id_modulo'] . "' class='btn'><span class='glyphicon glyphicon-trash'></span></a></td>";
                    echo "</tr>";
                }
                echo '</tbody></table>';
            }

            if (isset($_POST['editar'])) {
                $id_modulo = $_POST['id_modulo'];
                $nome = $_POST['nome'];
                $sql = "UPDATE modulo SET nome='$nome' WHERE id_modulo=$id_modulo";

                if ($conn->query($sql) === TRUE) {
                    echo '<p class="text-center">Registro atualizado com sucesso!</p>';
                } else {
                    echo '<p class="text-center">Erro ao atualizar registro: /p>' . $conn->error;
                }
            }

            if (isset($_GET['excluir'])) {
                $id_modulo = $_GET['excluir'];
                $sql = "DELETE FROM modulo WHERE id_modulo=$id_modulo";

                if ($conn->query($sql) === TRUE) {
                    echo '<p class="text-center">Registro excluído com sucesso!</p>';

                } else {
                    echo '<p class="text-center">Erro ao excluir registro: </p>' . $conn->error;
                }
            }
        ?>
    </body>
</html>