<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

require_once "config.php";

$user_id = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $cpf = $_POST["cpf"];
    $data_nasc = $_POST["data_nasc"];

    $sql = "UPDATE usuarios SET nome = '$nome', email = '$email', cpf = '$cpf', data_nasc = '$data_nasc' WHERE id_usuario = '$user_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: perfil.php");
        exit();
    } else {
        echo '<p class="text-center">Erro ao atualizar perfil: </p>' . $conn->error;
    }
}

$conn->close();
?>