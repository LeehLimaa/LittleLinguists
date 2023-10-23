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
            .module {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            }

            .module-header {
                text-align: center;
                margin-bottom: 20px;
            }

            .fruta-img {
                max-width: 100px;
                height: 100px; 
            }
        </style>

        <?php
            include('config.php');
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["salvar"])) {
                    $nome = $_POST["nome"];
                    $traducao = $_POST["traducao"];
                    $id_modulo = $_POST["modulos"];

                    if ($_FILES["imagem"]["error"] === 0) {
                        $uploadDir = __DIR__ . "/Imagens/"; 
                        $uploadedFile = $uploadDir . basename($_FILES["imagem"]["name"]);

                        if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $uploadedFile)) {
                            $caminho_imagem = $uploadedFile;
                        } else {
                            echo '<p class="text-center">Erro ao fazer upload da imagem</p>';
                            exit;
                        }
                    } else {
                        echo '<p class="text-center">Erro ao enviar imagem</p>';
                        exit;
                    }
                    $sql = "INSERT INTO conteudo (nome, traducao, imagem, id_modulo) VALUES ('$nome', '$traducao', '$caminho_imagem', $id_modulo)";
                    if ($conn->query($sql) === TRUE) {
                        echo '<br><p class="text-center">Dados salvos com sucesso</p>';
                    } else {
                        echo '<p class="text-center">Erro ao salvar dados: </p>'. $conn->error;
                    }
                }
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["consultar"])) {
                    $nome = $_POST["nome"];
                    $traducao = $_POST["traducao"];
                    $id_modulo = $_POST["modulos"];
                    $sql = "SELECT c.*, m.nome AS modulo_nome
                            FROM conteudo c
                            INNER JOIN modulo m ON c.id_modulo = m.id_modulo
                            WHERE c.nome LIKE '%$nome%'
                            AND c.traducao LIKE '%$traducao%'
                            AND c.imagem LIKE '%.png%'"; 

                    if (!empty($id_modulo)) {
                        $sql .= " AND c.id_modulo = $id_modulo";
                    }
                    $result = $conn->query($sql) or die($conn->error);

                    if ($result->num_rows > 0) {
                        $current_module = null; 
                        echo '<div class="row">';
                        while ($row = $result->fetch_assoc()) {
                            $nome_modulo = htmlspecialchars($row['modulo_nome']);
                            $nome_fruta = htmlspecialchars($row['nome']);
                            $traducao_fruta = htmlspecialchars($row['traducao']);
                            $imagem_fruta = htmlspecialchars($row['imagem']);

                            if ($nome_modulo != $current_module) {
                                if ($current_module != null) {
                                    echo '</div>'; 
                                    echo '</div>'; 
                                }
                                $current_module = $nome_modulo;
                                echo '<div class="module-header">';
                                echo '<h2>' . $current_module . '</h2>';
                                echo '</div>';
                                echo '<div class="row">';
                            }
                            echo '<div class="col-md-2">';
                            echo '<div class="module">';
                            echo '<div class="text-center">'; 
                            echo '<img src="Imagens/' . basename($imagem_fruta) . '" alt="' . $nome_fruta . '" class="fruta-img" />';
                            echo '<h3>' . $traducao_fruta . '</h3>';
                            echo '<p>' . $nome_fruta . '</p>';
                            echo '</div>';
                            echo '<div class="fruta-buttons">';
                            echo '<a href="editar_conteudo.php?id_conteudo=' . $row['id_conteudo'] . '" class="btn btn-primary btn-block">Editar</a>';
                            echo '<a href="conteudo.php?id_conteudo=' . $row['id_conteudo'] . '" class="btn btn-danger btn-block">Excluir</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }

                        if ($current_module != null) {
                            echo '</div>'; 
                            echo '</div>'; 
                        }
                        echo '</div>'; 
                    } else {
                        echo '<p class="text-center">Nenhum resultado encontrado.</p>';
                    }
                }
            }

            if (isset($_POST['editar'])) {
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
            
            if (isset($_GET['id_conteudo'])) {
                $id_conteudo = $_GET['id_conteudo'];
                $sql = "DELETE FROM conteudo WHERE id_conteudo=$id_conteudo";
                if ($conn->query($sql) === TRUE) {
                    echo '<br><p class="text-center">Registro excluído com sucesso!</p>';

                } else {
                    echo '<br><p class="text-center">Erro ao excluir registro: </p>' . $conn->error;

                }
            }            
        ?>
    </body>
</html>