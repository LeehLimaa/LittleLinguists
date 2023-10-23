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
        form {
            margin: 0 auto;
            width: 800px;
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
        $host = "localhost";
        $usuario = "root";
        $senha = "";
        $banco = "little_linguists";

        $conexao = new mysqli($host, $usuario, $senha, $banco);

        if ($conexao->connect_error) {
            die("Erro na conexão: " . $conexao->connect_error);
        }

        $sql = "SELECT id_usuario, nome, email, cpf, data_nasc FROM usuarios";
        $resultado = $conexao->query($sql);

        if ($resultado->num_rows > 0) {
            echo "<table border='1'>";
            echo '<h2 class="text-center"><img src="img/usuarios_cadastrado.png" class="img" width="500" height="100"></h2><br>';
            echo "<tr><th>ID</th><th>Nome</th><th>Email</th><th>CPF</th><th>Data de Nascimento</th></tr>";

            while ($linha = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $linha["id_usuario"] . "</td>";
                echo "<td>" . $linha["nome"] . "</td>";
                echo "<td>" . $linha["email"] . "</td>";
                echo "<td>" . $linha["cpf"] . "</td>";
                $data_nasc_invertida = date("d/m/Y", strtotime($linha["data_nasc"]));
                echo "<td>" . $data_nasc_invertida . "</td>";

                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Nenhum usuário cadastrado.";
        }

        
        $conexao->close();
        ?>
</div>
    </body>
</html>

