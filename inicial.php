<?php
    session_start();
    if (!isset($_SESSION['usuario'])){
        header('Location: index.php');
    }
    $emailAdm = json_decode(file_get_contents('jsons/emailadm.json'), true);
    $idxAdm = array_search($_SESSION['usuario'], $emailAdm);
    if (!isset($_SESSION['quantidades'])) $_SESSION['quantidades'] = [];
    if (!isset($_SESSION['prejuizos'])) $_SESSION['prejuizos'] = [];
    if (!isset($_SESSION['cargas'])) $_SESSION['cargas'] = [];
    if (!isset($_SESSION['datasRegistros'])) $_SESSION['datasRegistros'] = [];
    if (!isset($_SESSION['horasRegistros'])) $_SESSION['horasRegistros'] = [];
    if (!isset($_SESSION['diasSemanas'])) $_SESSION['diasSemanas'] = [];
    if (!isset($_SESSION['cargasTrabalhos'])) $_SESSION['cargasTrabalhos'] = [];
    if (!isset($_SESSION['horas'])) $_SESSION['horas'] = [];
    if (!isset($_SESSION['nomes'])) {
        if ($_SESSION['usuario'] == $emailAdm[$idxAdm]){ 
            $email = json_decode(file_get_contents("jsons/emailadm.json"), true);
            $senha = json_decode(file_get_contents("jsons/senhaadm.json"), true);
            $foto = json_decode(file_get_contents("jsons/fotoadm.json"), true);
            $nome = json_decode(file_get_contents("jsons/nomeadm.json"), true);
            $id = array_search($_SESSION['usuario'], $email); 
            $_SESSION['nomes'] = $nome;
            $_SESSION['emails'] = $email;
            $_SESSION['senhas'] = $senha;
            $_SESSION['fotos'] = $foto;
            $nomes = $nome;
            $emails = $email;
            $senhas = $senha;
            $fotos = $foto;
        }
        else {
            $emails = json_decode(file_get_contents("jsons/email.json"), true);
            $senhas = json_decode(file_get_contents("jsons/senha.json"), true);
            $fotos = json_decode(file_get_contents("jsons/foto.json"), true);
            $nomes = json_decode(file_get_contents("jsons/nome.json"), true);
            $id = array_search($_SESSION['usuario'], $emails);
            $_SESSION['nomes'] = $nomes;
            $_SESSION['emails'] = $emails;
            $_SESSION['senhas'] = $senhas;
            $_SESSION['fotos'] = $fotos;
        }
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
    <!-- Verificando se é o Adm ou o trabalhador que está logado -->
    <main class=main-container>
        <?php
            if ($_SESSION['usuario'] == $emailAdm[$idxAdm]){        
                echo '
                <div class="usuarioDiv">
                    <div class="cards-container">
                        <div class="profile-card">
                            <p>Bem vindo!</p>
                            <div class="profile-info">
                                <div class="profile-image profile-image-placeholder">
                                    <img ';

                if ($id !== false && isset($fotos[$id])) {
                    echo "src='usuarios/" . $fotos[$id] . "'";
                }
                 else {
                    echo "src='img/default.png'";
                }

                echo ' alt="Imagem do usuário">
                                </div>
                                <div class="nomeEDisplay">
                                    <div class="profile-title usuarioTitulo">Usuário</div>
                                    <p class="profile-name">' . (isset($nomes[$id]) ? $nomes[$id] : "Usuário não identificado") . '</p>
                                    <a class="sair" href="sair.php"><button class="btn-danger">Sair</button></a>
                                </div>
                            </div>
                        </div>

                        <div class="profile-card menu-card">
                            <div class="menu-options">
                                <div class="profile-title">Menu</div>
                                <hr>
                                <a href="inicial.php">Produção</a>
                                <hr>
                                <a href="inicial.php?funcionario">Funcionários</a>
                                <hr>
                                <a href="inicial.php?partida">Partidas</a>
                                <hr>
                                <a href="inicial.php?relatorio">Relatórios</a>
                            </div>
                        </div>

                        <div class="profile-card sobre-card">
                            <div class="sobre-options">
                                <div class="profile-title"><b>ⓘ</b> Sobre</div>
                                <hr>
                                <p>Dashboard da sua produção com indicativos gráficos, mostrando dados da sua produção, trabalhadores, retrabalho, defeitos e produção.</p>
                            </div>
                        </div>

                        <!-- Conteúdo principal do site -->
                        <div class="info">
                            <h1>DashBoard</h1>
                ';

                if (isset($_GET['funcionario'])) {
                    echo "<p class='profile-title'>Funcionários</p><span style='color:#666; font-weight: bold;'>" . date('d/m/Y') . "</span>";
                    echo "<div class='card'>
                            <div class='card_content'>
                                <h2 class='card_title'>Funcionários</h2>
                            </div>
                        </div>";
                } elseif (isset($_GET['partida'])) {
                    echo "<p class='profile-title'>Partida</p><span style='color:#666; font-weight: bold;'>" . date('d/m/Y') . "</span>";
                    echo "<div class='card'>
                            <div class='card_content'>
                                <h2 class='card_title'>Partidas</h2>
                            </div>
                        </div>";
                } elseif (isset($_GET['relatorio'])) {
                    echo "<p class='profile-title'>Relatório</p><span style='color:#666; font-weight: bold;'>" . date('d/m/Y') . "</span>";
                    echo "<div class='card'>
                            <div class='card_content'>
                                <h2 class='card_title'>Relatórios</h2>
                            </div>
                        </div>";
                } else {
                    echo "<p class='profile-title'>Produção</p><span style='color:#666; font-weight: bold;'>" . date('d/m/Y') . "</span>";
                    echo "<div class='card'>
                            <div class='card_content'>
                                <h2 class='profile-title' style='font-size: 28px;'>Produção</h2>
                            </div>
                        </div>";
                }

                echo '
                        </div>

                        <a href="inicial.php">
                            <img src="img/logo.svg" class="logo" alt="Logo da empresa, letras PG estilizadas em azul, fundo branco, transmite sensação de modernidade">
                        </a>   
                    </div>
                </div>
                ';

            }
            else {
                echo '
                <div class="usuarioDiv">
                    <div class="cards-container">
                        <div class="profile-card">
                            <p>Bem vindo!</p>
                            <div class="profile-info">
                                <div class="profile-image profile-image-placeholder">
                                    <img ';

                if ($id !== false && isset($fotos[$id])) {
                    echo "src='usuarios/" . $fotos[$id] . "'";
                } else {
                    echo "src='img/default.png'";
                }

                echo ' alt="Imagem do usuário">
                                </div>
                                <div class="nomeEDisplay">
                                    <div class="profile-title">Usuário</div>
                                    <p class="profile-name">' . (isset($nomes[$id]) ? $nomes[$id] : "Usuário não identificado") . '</p>
                                    <a href="sair.php"><button class="btn-danger sair">Sair</button></a>
                                </div>
                            </div>
                        </div>

                        <div class="profile-card menu-card">
                            <div class="menu-options">
                                <div class="profile-title">Menu</div>
                                <hr>
                                <a href="inicial.php">Produção</a>
                                <hr>
                                <a href="inicial.php?diaria">Registro Diário</a>
                            </div>
                        </div>

                        <div class="profile-card sobre-card">
                            <div class="sobre-options">
                                <div class="profile-title"><b>ⓘ</b> Sobre</div>
                                <hr>
                                <p>Dashboard da sua produção com indicativos gráficos, mostrando dados da sua produção, trabalhadores, retrabalho, defeitos e produção.</p>
                            </div>
                        </div>

                        <!-- Conteúdo principal do site -->
                        <div class="info">
                            <h1>DashBoard</h1>
                ';

                if (isset($_GET['diaria'])) {
                    echo "<p class='profile-title'>Registro Diário</p><span style='color:#666; font-weight: bold;'>" . date('d/m/Y') . "</span>";
                    echo "<div class='card'>
                            <div class='card_content'>
                                <h2 class='profile-title' style='font-size: 28px;'>Registro</h2>
                                <div class='profile-forms'>
                                     <form method='POST' action='receber-dados.php'>
                                        <div class='mb-3'>
                                            <label for='exampleInputEmail1' class='form-label'>Quantidade Produzida</label>
                                            <input type='number' name='quantidade' min='0' class='form-control' id='seunumero' aria-describedby='numero' required>
                                            <div id='seunumero' class='form-text'>Insira a quantidade de sapatos produzido por você hoje</div>
                                        </div>
                                        <div class='mb-3'>
                                            <label for='preju' class='form-label'>Quantidade de prejuízo</label>
                                            <input type='number' name='prejuizo' class='form-control' min='0' id='prejuizo' required>
                                            <div id='prejuizo' class='form-text'>Insira a quantidade de sapatos perdidos hoje</div>
                                        </div>
                                        <div class='mb-3'>
                                            <label for='horaria' class='form-label'>Sua carga horária de hoje</label>
                                            <input required type='number' name='carga' min='0' class='form-control' id='carga'>
                                            <div id='carga' class='form-text'>Sua carga horária em minutos. Ex: 2 horas = 120 min</div>
                                        </div>
                                        <button type='submit' class='btn btn-primary'>Submit</button>
                                        </form>
                                </div>
                            </div>
                        </div>";
                } else {
                    echo "<p class='profile-title'>Produção</p><span style='color:#666; font-weight: bold;'>" . date('d/m/Y') . "</span>";
                    echo "<div class='card'>
                            <div class='card_content'>
                                <h2 class='profile-title' style='font-size: 28px;'><b>Produção</b></h2>";
                                echo "<form class='dataForm' method='post' action='inicial.php'>";
                                    echo "<span class='profile-title'><b>Escolha a data inicial</b></span>";
                                    echo "<input type='date' class='data' name='dataFinal'/>";
                                    echo "<span class='profile-title'><b>Escolha a data final</b></span>";
                                    echo "<input type='date' class='data' name='dataFinal' />";
                                    echo "<input class='btn btn-primary' type='submit' value='FILTRAR'/>";
                                echo "</form>";
                                echo "<div>";
                                echo "<h2 class='profile-title' style='font-size: 14px;'>Dados</h2>";
                              echo "<div class='subcard'>";
                              echo "<div class='tools'>";
                                echo "<div class='circle'>";
                               echo " <span class='red box'></span>";
                                echo "</div>";
                                echo "<div class='circle'>";
                                echo "<span class='yellow box'></span>";
                                echo "</div>";
                                echo "<div class='circle'>";
                                echo "<span class='green box'></span>";
                                echo "</div>";
                               echo " </div>";
                               echo " <div class='card__content'>";
                               include "dadosProducao/prodgraphs.php";
                               echo " </div>";
                                echo "</div>";
                                     include "dadosProducao/prodgraphs.php";
                                echo "</div>";
                                echo "<div>";
                                    echo "<h2 class='profile-title' style='font-size: 14px;'>Retrabalho</h2>";
                                     include "dadosProducao/retrabalho.php";
                                echo "</div>";
                                echo "<div>";
                                     echo "<h2 class='profile-title' style='font-size: 14px;'>Tolerância</h2>";
                                     include "dadosProducao/tolerancia.php";
                                echo "</div>";
                                echo "<div>";
                                     echo "<h2 class='profile-title' style='font-size: 14px;'>Prejuízo</h2>";
                                     include "dadosProducao/prejuizo.php";
                                echo "</div>";
                                echo "<div>";
                                     echo "<h2 class='profile-title' style='font-size: 14px;'>Trabalhadores</h2>";
                                     include "dadosProducao/trabalhadores.php";
                                echo "</div>";
                            echo "</div>";
                        echo "</div>";         
                }
                echo '
                        </div>

                        <a href="inicial.php">
                            <img src="img/logo.svg" class="logo" alt="Logo da empresa, letras PG estilizadas em azul, fundo branco, transmite sensação de modernidade">
                        </a>   
                    </div>
                </div>
                ';

            }
        ?>
    </main>
</body>

</html>
