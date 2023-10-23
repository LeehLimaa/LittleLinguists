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
            form {
                margin: 0 auto;
                width: 900px;
                padding: 1em;
                border: 1px solid #FFF;
                border-radius: 1em;
            }

            .table-container {
                margin: 0 auto; 
                max-width: 1000px; 
                padding: 20px; 
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th, td {
                padding: 10px;
                text-align: center;
            }

            th {
                background-color: #76A6E2;
            }

            tr {
                background-color: #fff;
            }
            h2{
                text-align: center;
            }       
        </style>

        <div class="table-container">
        <?php
        require_once "config.php";

        // Consulta os dados da tabela (ajuste a consulta conforme sua estrutura de tabela)
        $sql = "SELECT id_mensagem, nome, email, mensagem FROM mensagem";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo '<h2 class="text-center"><img src="img/mensagem.png" class="img" width="500" height="100"></h2>';
            echo '<tr><th>ID</th><th>Nome</th><th>Email</th><th>Mensagem</th><th>Excluir</th></tr>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id_mensagem'] . '</td>';
                echo '<td>' . $row['nome'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['mensagem'] . '</td>';
                echo "<td><a href='?excluir=" . $row['id_mensagem'] . "' class='btn'><span class='glyphicon glyphicon-trash'></span></a></td>";
                echo '</tr>';
            }
            echo '</table>';

        } else {
            echo '<p class="text-center">Nenhuma mensagem encontrada.</p>';
        }

        if (isset($_GET['excluir'])) {
            $id_mensagem = $_GET['excluir'];

            $sql = "DELETE FROM mensagem WHERE id_mensagem=$id_mensagem";

            if ($conn->query($sql) === TRUE) {
                echo '<br><p class="text-center">Registro excluído com sucesso!</p>';
            } else {
                echo '<p class="text-center">Erro ao excluir registro: </p>' . $conn->error;
            }
        }

        $conn->close();
        ?>
    </div>
    </body>
</html>