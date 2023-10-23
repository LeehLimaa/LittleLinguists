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
        </nav><br><br>

        <!-- Formatação -->
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
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "little_linguists";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

if (isset($_POST['salvar'])) {
    $frase = $_POST['frase'];
    $traducao = $_POST['traducao'];
    $id_modulo = $_POST['modulos'];

    $sql = "INSERT INTO frase (frase, traducao, id_modulo) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("ssi", $frase, $traducao, $id_modulo);
        
        if ($stmt->execute()) {
            echo '<p class="text-center">Frase criada com sucesso!</p>';
        } else {
            echo '<p class="text-center">Erro ao criar frase: ' . $stmt->error . '</p>';
        }

        $stmt->close();
    }
}

if (isset($_POST['consultar'])) {
    echo '<h2 class="text-center"><img src="img\consultar.png" class="img" width="500" height="100"></h2>';
    $sql = "SELECT f.id_frase, f.frase, f.traducao, m.nome AS nome_modulo FROM frase AS f INNER JOIN modulo AS m ON f.id_modulo = m.id_modulo";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table class="table table-striped">';
        echo '<thead><tr><th>ID</th><th>Frase</th><th>Tradução</th><th>Módulo</th><th>Editar</th><th>Excluir</th></tr></thead>';
        echo '<tbody>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['id_frase'] . '</td>';
            echo '<td>' . $row['frase'] . '</td>';
            echo '<td>' . $row['traducao'] . '</td>';
            echo '<td>' . $row['nome_modulo'] . '</td>';
            echo "<td><a href='editar_frase.php?id=" . $row['id_frase'] . "' class='btn'><span class='glyphicon glyphicon-pencil'></span></a></td>";
            echo "<td><a href='?excluir=" . $row['id_frase'] . "' class='btn'><span class='glyphicon glyphicon-trash'></span></a></td>";
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<p class="text-center">Nenhuma frase encontrada.</p>';
    }
}

if (isset($_POST['editar'])) {
    $id_frase = $_GET['id_frase'];
    $frase = $_POST['frase'];
    $traducao = $_POST['traducao'];
    $id_modulo = $_POST['modulos'];

    $sql = "UPDATE frase SET frase='$frase', traducao='$traducao', id_modulo='$id_modulo' WHERE id_frase=$id_frase";

    if ($conn->query($sql) === TRUE) {
        echo "Frase atualizada com sucesso.";
    } else {
        echo "Erro ao atualizar frase: " . $conn->error;
    }
}

if (isset($_GET['excluir'])) {
    $id_frase = $_GET['excluir'];

    $sql = "DELETE FROM frase WHERE id_frase=$id_frase";

    if ($conn->query($sql) === TRUE) {
        echo '<p class="text-center">Frase excluída com sucesso!</p>';
    } else {
        echo '<p class="text-center">Erro ao excluir frase: ' . $conn->error . '</p>';
    }
}

$conn->close();
?>

    </body>
</html>