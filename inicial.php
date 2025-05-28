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
    <!-- Sidebar do site -->
    <main class=main-container>
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
                                <button class="btn-danger sair">Sair</button>
                            </div>
                            
                        </div>
                    </div>
                    <?php
                        echo "
                            <div class='profile-card menu-card'>
                            <div class='menu-options'>
                                <div class='profile-title'>Menu</div>
                                <hr>
                                <a href='inicial.php'>Produção</a>
                                <hr>
                                <a href='inicial.php?funcionario'>Funcionários</a>
                                <hr>
                                <a href='inicial.php?partida'>Partidas</a>
                                <hr>
                                <a href='inicial.php?relatorio'>Relatórios</a>
                            </div>
                        </div>
                        ";
                    ?>
                    <div class="profile-card sobre-card">
                        <div class="sobre-options">
                            <div class="profile-title"><b>ⓘ</b> Sobre</div>
                                <hr>
                                <p>Dashboard da sua produção com indicativos gráficos, mostrando dados da sua produção, trabalhadores, retrabalho, defeitos e produção.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Conteúdo principal do site -->
                    <img src="img/logo.svg" class='logo' alt="Logo">
                    <div class="info">
                        <h1>DashBoard</h1>
                        <?php 
                            if (isset($_GET['funcionario'])) {
                                echo "<p class='profile-title'>Funcionários</p><span style='color:#666; font-weight: bold;'>" . date('d/m/Y') . "</span>";
                            } elseif (isset($_GET['partida'])) {
                                echo "<p class='profile-title'>Partida</p><span style='color:#666; font-weight: bold;'>" . date('d/m/Y') . "</span>";
                            } elseif (isset($_GET['relatorio'])) {
                                echo "<p class='profile-title'>Relatório</p><span style='color:#666; font-weight: bold;'>" . date('d/m/Y') . "</span>";
                            } else {
                                echo "<p class='profile-title'>Produção</p><span style='color:#666; font-weight: bold;'>" . date('d/m/Y') . "</span>";
                            }
                        ?>            
                        <?php
                        echo "<div class='card'>";
                        echo "<div class='tool'>";
                            echo "<div class='circle'>";
                            echo "<span class='red box'></span>";
                            echo "</div>";
                            echo "<div class='circle'>";
                            echo "<span class='yellow box'></span>";
                            echo "</div>";
                            echo "<div class='circle'>";
                            echo "<span class='green box'></span>";
                            echo "</div>";
                        echo "</div>";
                        echo "<div class='card__content'>";
                        echo "</div>";
                        echo "</div>";
                        ?>  
                    </div>
                    
                </div>
            </div>
    </main>
</body>

</html>