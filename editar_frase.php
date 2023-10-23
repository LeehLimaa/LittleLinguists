<?php
require_once "config.php"; 

if (isset($_GET['id'])) {
    $id_frase = $_GET['id'];

    $sql = "SELECT id_frase, frase, traducao, id_modulo FROM frase WHERE id_frase = $id_frase";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $frase = $row["frase"];
        $traducao = $row["traducao"];
        $id_modulo = $row["id_modulo"]; 
    } else {
        echo "Registro não encontrado.";
        exit;
    }
} else {
    echo "ID do registro não fornecido.";
    exit;
}

if (isset($_POST['editar'])) {
    $frase = $_POST['frase'];
    $traducao = $_POST["traducao"];
    $id_modulo = $_POST['modulos']; 

    $sql = "UPDATE frase SET frase='$frase', traducao='$traducao', id_modulo='$id_modulo' WHERE id_frase=$id_frase";

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

        <!-- Formulário de Edição de Módulo -->
        <div class="text-center"><h2 class="text-center"><img src="img/editar.png" class="img" width="500" height="100"></h2></div>
        <form method="POST" action="">
            <div class="form-group">
                <label for="frase"> Frase:</label>
                <input type="text" name="frase" class="form-control" value="<?php echo $frase; ?>"><br>
            </div>
            <div class="form-group">
                <label for="traducao"> Traducao:</label>
                <input type="text" name="traducao" class="form-control" value="<?php echo $traducao; ?>"><br>
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
                        $selected = ($id_modulo == $id_modulo_do_questionario) ? "selected" : "";
                        echo "<option value='$id_modulo' $selected>$nome_modulo</option>";
                    }
                    ?>
                </select>
            </div>


            <!-- Botões -->
            <div class="form-group"><button type="submit" name="editar" class="btn btn-secondary btn-block">Atualizar Dados</button></div>
        </form><br>
    </body>
</html>
