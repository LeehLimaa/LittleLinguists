<?php
require_once "config.php";

// Carregar dados da questão, se um ID for fornecido
if (isset($_GET["id"])) {
    $id_questao = $_GET["id"];

    $sql = "SELECT * FROM questao WHERE id_questao = $id_questao";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "Questão não encontrada.";
        exit;
    }
}

// Processar o formulário de atualização
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["atualizar"])) {
    $id_questao = $_POST["id_questao"];
    $enunciado = $_POST["enunciado"];
    $a = $_POST["a"];
    $b = $_POST["b"];
    $c = $_POST["c"];
    $d = $_POST["d"];
    $resposta = $_POST["resposta"];

    $sql = "UPDATE questao SET enunciado = '$enunciado', a = '$a', b = '$b', c = '$c', d = '$d', resposta = '$resposta' WHERE id_questao = $id_questao";

    if ($conn->query($sql) === TRUE) {
        echo "Questão atualizada com sucesso!";
    } else {
        echo "Erro ao atualizar questão: " . $conn->error;
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

<div class="text-center"><h2 class="text-center"><img src="img/editar.png" class="img" width="500" height="100"></h2></div>
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="hidden" name="atualizar" value="1">
        <input type="hidden" name="id_questao" value="<?php echo $row['id_questao']; ?>">
        <div class="form-group">
            <label>Enunciado:</label>
            <textarea name="enunciado" class="form-control"><?php echo $row['enunciado']; ?></textarea>
        </div>
        <div class="form-group">
            <label>A:</label>
            <textarea name="a" class="form-control"><?php echo $row['a']; ?></textarea>
        </div>
        <div class="form-group">
            <label>B:</label>
            <textarea name="b" class="form-control"><?php echo $row['b']; ?></textarea>
        </div>
        <div class="form-group">
            <label>C:</label>
            <textarea name="c" class="form-control"><?php echo $row['c']; ?></textarea>
        </div>
        <div class="form-group">
            <label>D:</label>
            <textarea name="d" class="form-control"><?php echo $row['d']; ?></textarea>
        </div>
        <div class="form-group">
            <label>Resposta correta:</label>
            <select name="resposta" class="form-control">
                <option value="a" <?php if ($row['resposta'] == 'a') echo 'selected'; ?>>A</option>
                <option value="b" <?php if ($row['resposta'] == 'b') echo 'selected'; ?>>B</option>
                <option value="c" <?php if ($row['resposta'] == 'c') echo 'selected'; ?>>C</option>
                <option value="d" <?php if ($row['resposta'] == 'd') echo 'selected'; ?>>D</option>
            </select>
        </div>
        <div class="form-group"><button type="submit" class="btn btn-secondary btn-block">Atualizar Dados</button></div>
    </form>

</body>
</html>
