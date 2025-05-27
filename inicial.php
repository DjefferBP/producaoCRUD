<?php
    //Inicia a sessão e verifica se o usuário está logado
    // Caso não esteja, redireciona para a página de login
    session_start();
    if (!isset($_SESSION['usuario'])){
        header('Location: index.php');
    }
    if (!isset($_SESSION['nomes'])) {
        $emails = json_decode(file_get_contents("jsons/email.json"), true);
        $senhas = json_decode(file_get_contents("jsons/senha.json"), true);
        $fotos = json_decode(file_get_contents("jsons/foto.json"), true);
        $nomes = json_decode(file_get_contents("jsons/nome.json"), true);
        $id = array_search($_SESSION['usuario'], $emails);
        $_SESSION['nomes'] = $nomes;
        $_SESSION['emails'] = $emails;
        $_SESSION['senhas'] = $senhas;
        $_SESSION['fotos'] = $fotos;
    } else {
        $emails = $_SESSION['emails'];
        $id = array_search($_SESSION['usuario'], $emails);
        $nomes = $_SESSION['nomes'];
        $fotos = $_SESSION['fotos'];
        $senhas = $_SESSION['senhas'];
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/ProdGraph.ico">
    <title>Dashboard da produção</title>
    <link rel="stylesheet" href="styles/inicial.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Cabeçalho do site -->
    <header>
        <nav class="navbarInicio">
            <div class="usuarioDiv">
                <div class="cards-container">
                    <div class="profile-card">
                        <p>Bem vindo!</p>
                        <div class="profile-info">
                            <div class="profile-image profile-image-placeholder">
                                <img 
                                    <?php 
                                        if ($id !== false && isset($fotos[$id])) {
                                            echo "src='usuarios/$fotos[$id]'";
                                        } else {
                                            echo "src='img/default.png'";
                                        }
                                    ?> 
                                    alt="Imagem do usuário">
                            </div>
                            <div class="nomeEDisplay">
                                <div class="profile-title">Usuário</div>
                                <p class="profile-name"><?php echo isset($nomes[$id])?$nomes[$id]:"Usuário não identificado"; ?></p>
                            </div>
                            <button class="btn-danger sair">Sair</button>
                        </div>
                    </div>
                    <div class="profile-card menu-card">
                        <div class="menu-options">
                            <div class="profile-title">Menu</div>
                            <hr>
                            <a href="index.php">Home</a>
                            <hr>
                            <a href="index.php">Produção</a>
                            <hr>
                            <a href="index.php">Estoque</a>
                            <hr>
                            <a href="index.php">Relatórios</a>
                        </div>
                    </div>
                    <div class="profile-card sobre-card">
                        <div class="sobre-options">
                            <details>
                                <summary>Sobre</summary>
                                <p>Dashboard da sua produção com indicativos gráficos, mostrando dados da sua produção, trabalhadores, retrabalho, defeitos e produção.</p>
                            </details>
                        </div>
                    </div>
                </div>
            </div>


            <div class="logoDiv">
                <img src="img/logo.svg" alt="Logo da empresa" class="lixo">
            </div>
        </nav>
    </header>
</body>

</html>