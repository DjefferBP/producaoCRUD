<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $index = $_GET['pos'] ?? null;
    if ($index === null) {
        echo "<script>alert('Índice inválido!'); window.location.href='funcionarios.php';</script>";
        exit;
    }

    $email = $_SESSION['emailTrabalhador'][$index] ?? null;
    if (!$email) {
        echo "<script>alert('Usuário não encontrado!'); window.location.href='funcionarios.php';</script>";
        exit;
    }

    $arraysTrabalhador = ['emailTrabalhador', 'nomeTrabalhador', 'senhaTrabalhador', 'fotoTra'];
    foreach ($arraysTrabalhador as $arr) {
        if (isset($_SESSION[$arr][$index])) {
            unset($_SESSION[$arr][$index]);
            $_SESSION[$arr] = array_values($_SESSION[$arr]);
        }
    }
    $arraysProducao = [
        'quantidades', 'prejuizos', 'datasRegistros', 'horasRegistros',
        'diasSemanas', 'cargasTrabalhos', 'horas', 'emailUser', 'nomesUser'
    ];
    foreach ($arraysProducao as $arr) {
        if (isset($_SESSION[$arr]) && is_array($_SESSION[$arr])) {
            foreach ($_SESSION[$arr] as $i => $valor) {

                if ($arr === 'emailUser' && $valor === $email) {
                    foreach ($arraysProducao as $arr2) {
                        if (isset($_SESSION[$arr2][$i])) {
                            unset($_SESSION[$arr2][$i]);
                        }
                    }
                }
            }
        }
    }
    foreach ($arraysProducao as $arr) {
        if (isset($_SESSION[$arr]) && is_array($_SESSION[$arr])) {
            $_SESSION[$arr] = array_values($_SESSION[$arr]);
        }
    }
    $diretorio = 'jsons/';
    file_put_contents($diretorio . 'nome.json', json_encode($_SESSION['nomeTrabalhador'], JSON_PRETTY_PRINT));
    file_put_contents($diretorio . 'email.json', json_encode($_SESSION['emailTrabalhador'], JSON_PRETTY_PRINT));
    file_put_contents($diretorio . 'senha.json', json_encode($_SESSION['senhaTrabalhador'], JSON_PRETTY_PRINT));
    file_put_contents($diretorio . 'foto.json', json_encode($_SESSION['fotoTra'], JSON_PRETTY_PRINT));
    $diretorio = 'dadosUserjson/';
    file_put_contents($diretorio . 'quantidades.json', json_encode($_SESSION['quantidades'], JSON_PRETTY_PRINT));
    file_put_contents($diretorio . 'prejuizos.json', json_encode($_SESSION['prejuizos'], JSON_PRETTY_PRINT));
    file_put_contents($diretorio . 'datasRegistros.json', json_encode($_SESSION['datasRegistros'], JSON_PRETTY_PRINT));
    file_put_contents($diretorio . 'horasRegistros.json', json_encode($_SESSION['horasRegistros'], JSON_PRETTY_PRINT));
    file_put_contents($diretorio . 'diasSemanas.json', json_encode($_SESSION['diasSemanas'], JSON_PRETTY_PRINT));
    file_put_contents($diretorio . 'cargasTrabalhos.json', json_encode($_SESSION['cargasTrabalhos'], JSON_PRETTY_PRINT));
    file_put_contents($diretorio . 'emailUser.json', json_encode($_SESSION['emailUser'], JSON_PRETTY_PRINT));
    file_put_contents($diretorio . 'nomesUser.json', json_encode($_SESSION['nomesUser'], JSON_PRETTY_PRINT));
    file_put_contents($diretorio . 'horas.json', json_encode($_SESSION['horas'], JSON_PRETTY_PRINT));
    echo "<script>alert('Usuário excluído com sucesso!');</script>";
    echo "<script>window.location.href='funcionarios.php';</script>";