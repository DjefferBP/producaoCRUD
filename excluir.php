<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $index = $_GET['pos'];
    unset($_SESSION['quantidades'][$index]);
    unset($_SESSION['prejuizos'][$index]);
    unset($_SESSION['datasRegistros'][$index]);
    unset($_SESSION['horasRegistros'][$index]);
    unset($_SESSION['diasSemanas'][$index]);
    unset($_SESSION['cargasTrabalhos'][$index]);
    unset($_SESSION['horas'][$index]);
    unset($_SESSION['emailUser'][$index]);
    unset($_SESSION['nomesUser'][$index]);
    unset($_SESSION['nomeTrabalhador'][$index]);
    unset($_SESSION['emailTrabalhador'][$index]);
    unset($_SESSION['senhaTrabalhador'][$index]);
    unset($_SESSION['fotoTrabalhador'][$index]);
    $_SESSION['quantidades'] = array_values($_SESSION['quantidades']);
    $_SESSION['prejuizos'] = array_values($_SESSION['prejuizos']);
    $_SESSION['datasRegistros'] = array_values($_SESSION['datasRegistros']);
    $_SESSION['horasRegistros'] = array_values($_SESSION['horasRegistros']);
    $_SESSION['diasSemanas'] = array_values($_SESSION['diasSemanas']);
    $_SESSION['cargasTrabalhos'] = array_values($_SESSION['cargasTrabalhos']);
    $_SESSION['horas'] = array_values($_SESSION['horas']);
    $_SESSION['emailUser'] = array_values($_SESSION['emailUser']);
    $_SESSION['nomesUser'] = array_values($_SESSION['nomesUser']);
    $_SESSION['nomeTrabalhador'] = array_values($_SESSION['nomeTrabalhador']);
    $_SESSION['emailTrabalhador'] = array_values($_SESSION['emailTrabalhador']);
    $_SESSION['senhaTrabalhador'] = array_values($_SESSION['senhaTrabalhador']);
    
    $diretorio = 'dadosUserjson/';
        file_put_contents($diretorio . 'quantidades.json', json_encode($_SESSION['quantidades'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'prejuizos.json', json_encode($_SESSION['prejuizos'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'nomesUser.json', json_encode($_SESSION['nomesUser'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'emailUser.json', json_encode($_SESSION['emailUser'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'datasRegistros.json', json_encode($_SESSION['datasRegistros'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'horasRegistros.json', json_encode($_SESSION['horasRegistros'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'diasSemanas.json', json_encode($_SESSION['diasSemanas'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'cargasTrabalhos.json', json_encode($_SESSION['cargasTrabalhos'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'horas.json', json_encode($_SESSION['horas'], JSON_PRETTY_PRINT));
        $diretorio = 'jsons/';
        file_put_contents($diretorio . 'nome.json', json_encode($_SESSION['nomeTrabalhador'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'email.json', json_encode($_SESSION['emailTrabalhador'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'senha.json', json_encode($_SESSION['senhaTrabalhador'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'foto.json', json_encode($_SESSION['fotoTrabalhador'], JSON_PRETTY_PRINT));
    echo "<script>alert('Usuário excluído com sucesso!');</script>";
    echo "<script>window.location.href='funcionarios.php';</script>";
    

