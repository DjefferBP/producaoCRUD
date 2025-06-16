<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $quantidade = $_POST['quantidade'];
        $prejuizo = $_POST['prejuizo'];
        $_SESSION['nomesUser'][$id] = $nome;
        $_SESSION['quantidades'][$id] = $quantidade;
        $_SESSION['prejuizos'][$id] = $prejuizo;
        $diretorio = '../dadosUserjson/';
        file_put_contents($diretorio . 'nomesUser.json', json_encode($_SESSION['nomesUser'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'quantidades.json', json_encode($_SESSION['quantidades'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'prejuizos.json', json_encode($_SESSION['prejuizos'], JSON_PRETTY_PRINT));
        header('Location: partidas.php');
    }