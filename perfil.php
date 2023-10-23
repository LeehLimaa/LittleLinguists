<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

require_once "config.php";

$user_id = $_SESSION["user_id"];

$sql = "SELECT * FROM usuarios WHERE id_usuario = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user_data = $result->fetch_assoc();
} else {
    header("Location: login.php");
    exit();
}

$conn->close();
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
            </div>
        </nav><br><br><br>

        <!-- Formatação -->
        <style>
            body{
                background-color: #E1EFFF;
            }
        </style>

        <form method="POST" action="atualizar_perfil.php">
            <p class="text-center"><img src="img/icone.png" class="img" width="150" height="150"></p>
            <p class="text-center"><strong>Bem-vindo(a), <?php echo $_SESSION['username']; ?>!</strong></p><br>
            <div class="form-group">
                <label>Nome:</label><br>
                <input type="text" name="nome" value="<?php echo $user_data["nome"]; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email:</label><br>
                <input type="email" name="email" value="<?php echo $user_data["email"]; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>CPF:</label><br>
                <input type="text" name="cpf" value="<?php echo $user_data["cpf"]; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Data de Nascimento:</label><br>
                <input type="date" name="data_nasc" value="<?php echo $user_data["data_nasc"]; ?>" class="form-control" required><br>
            </div>

            <!-- Botões -->
            <div class="form-group">
                <button type="submit" value="atualizar" class="btn btn-secondary btn-block">Atualizar Dados</button>
            </div>
        </form>
        <form action="logout.php" method="post">
            <input type="hidden">
            <button type="submit" class="btn btn-danger btn-block">Sair da Conta</button>
        </form>
    </body>
</html>
