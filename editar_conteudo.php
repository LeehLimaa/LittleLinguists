<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["editar"])) {
        $id_conteudo = $_POST['id_conteudo'];
        $nome = $_POST['nome'];
        $traducao = $_POST['traducao'];
        $id_modulo = $_POST['modulos'];

        $sql = "UPDATE conteudo SET nome='$nome', traducao='$traducao', id_modulo=$id_modulo WHERE id_conteudo=$id_conteudo";

        if ($conn->query($sql) === TRUE) {
            echo '<p class="text-center">Registro atualizado com sucesso!</p>';
        } else {
            echo '<p class="text-center">Erro ao atualizar registro: </p>' . $conn->error;
        }
    }
}

if (isset($_GET['id_conteudo'])) {
    $id_conteudo = $_GET['id_conteudo'];

    $sql = "SELECT * FROM conteudo WHERE id_conteudo = $id_conteudo";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nome = $row['nome'];
        $traducao = $row['traducao'];
        $id_modulo = $row['id_modulo'];
    } else {
        echo "Conteúdo não encontrado.";
        exit;
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
                                <li class="link"><a href="criar_questionario.php" target="_self" title="">Criar novo questionário</a></li>
                            </ul>
                        </li>
                        <li class="link"><a href="consultar_mensagem.php" target="_self"  title="Caixa de mensagens" class="glyphicon glyphicon-envelope"></a></li>
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

        <!-- Formulário de Edição de Conteúdo -->
        <div class="text-center"><h2 class="text-center"><img src="img/editar.png" class="img" width="500" height="100"></h2></div>
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="id_conteudo" value="<?php echo $id_conteudo; ?>">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" name="nome" value="<?php echo $nome; ?>">
            </div>
            <div class="form-group">
                <label for="traducao">Tradução:</label>
                <input type="text" class="form-control" name="traducao" value="<?php echo $traducao; ?>">
            </div>
            <div class="form-group">
                <label for="modulos">Módulo:</label>
                <select class="form-control" name="modulos">
                    <?php
                    $sql_modulos = "SELECT * FROM modulo";
                    $result_modulos = $conn->query($sql_modulos);
                    while ($row_modulo = $result_modulos->fetch_assoc()) {
                        $id_modulo = $row_modulo['id_modulo'];
                        $nome_modulo = $row_modulo['nome'];
                        $selected = ($id_modulo == $id_modulo) ? "selected" : "";
                        echo "<option value='$id_modulo' $selected>$nome_modulo</option>";
                    }
                    ?>
                </select>
            </div>
                        
            <!-- Botões -->
            <div class="form-group"><button type="submit" name="editar" class="btn btn-secondary btn-block">Atualizar Dados</button></div>
        </form>
    </body>
</html>