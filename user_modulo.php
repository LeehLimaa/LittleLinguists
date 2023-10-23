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
                        <li class="link"><a href="index_usuario.php" target="_self"  title="Página inicial" class="glyphicon glyphicon-home"></a></li>
                        <li class="link"><a href="mensagem.php" target="_self"  title="Entre em contato conosco!" class="glyphicon glyphicon-envelope"></a></li>
                        <li class="link"><a href="perfil.php" target="_self"  title="Perfil!" class="glyphicon glyphicon-user"></a></li>
                    </ul>
                </div>
            </div>
        </nav><br><br><br>
        <style>
         .content-box {
        padding: 20px;
        text-align: center;
        margin: 10px;
        height: 300px;
        background-color: white;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center; 
    }

    .module-title {
        text-align: center;
        margin-top: 50px;
        color: #1F5692;
    }

    .fruta-img {
        max-width: 50%;
        height: auto;
        margin-bottom: 10px;
    }
    body{
    background-color: #E1EFFF;
    }
    h1{
        font-weight: bold;
    }
    </style>
</head>
<body>
    <div class="container">
        <?php
        include('config.php');
        
        if (isset($_GET['module_id'])) {
            $module_id = $_GET['module_id'];
            
            $module_sql = "SELECT nome FROM modulo WHERE id_modulo = $module_id";
            $module_result = $conn->query($module_sql);
            
            if ($module_result->num_rows > 0) {
                $module_row = $module_result->fetch_assoc();
                $module_name = $module_row['nome'];
                
                echo '<h1 class="module-title"><strong>' . $module_name . '</strong></h1><br>';
                
                $content_sql = "SELECT * FROM conteudo WHERE id_modulo = $module_id";
                $content_result = $conn->query($content_sql);
                
                if ($content_result->num_rows > 0) {
                    echo '<div class="row">';
                    while ($content_row = $content_result->fetch_assoc()) {
                        $content_name = $content_row['nome'];
                        $content_translation = $content_row['traducao'];
                        $content_image = $content_row['imagem'];
                        
                        echo '<div class="col-md-4">';
                        echo '<div class="content-box">';
                        echo '<img src="Imagens/' . basename($content_image) . '" alt="' . $content_name . '" class="fruta-img" />';
                        echo '<h1 class="titulo">' . $content_translation . '</h1>';
                        echo '<p>' . $content_name . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                    echo '</div>';
                } else {
                    echo '<p class="text-center">Nenhum conteúdo encontrado para este módulo.</p>';
                }
            } else {
                echo '<p class="text-center">Módulo não encontrado.</p>';
            }
        } else {
            echo '<p class="text-center">Selecione um módulo para visualizar.</p>';
        }
        ?>
    </div>
</body>
</html>
