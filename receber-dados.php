<?php
    session_start();

    if (!isset($_SESSION['usuario'])) {
        header('Location: index.php');
        exit;
    }
    date_default_timezone_set('America/Sao_Paulo');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $quantidade = $_POST['quantidade'];
        $prejuizo = $_POST['prejuizo'];
        $data_registro = date('d/m/Y'); 
        $hora_registro = date('H:i:s'); 
        $dia_semana = date('w');

        
        if ($dia_semana >= 1 && $dia_semana <= 5) {
            $cargaTrabalho = '08:00-16:00';
            $horas = 8;
        } elseif ($dia_semana == 6) {
            $cargaTrabalho = '08:00-12:00';
            $horas = 4;
        } else {
            $cargaTrabalho= 'Folga';
            $horas = 0;
        }
        if (!isset($_SESSION['quantidades'])) {
            $_SESSION['quantidades'] = [];
        }
        if (!isset($_SESSION['prejuizos'])) {
            $_SESSION['prejuizos'] = [];
        }
        if (!isset($_SESSION['datasRegistros'])) {
            $_SESSION['datasRegistros'] = [];
        }
        if (!isset($_SESSION['horasRegistros'])) {
            $_SESSION['horasRegistros'] = [];
        }
        if (!isset($_SESSION['diasSemanas'])) {
            $_SESSION['diasSemanas'] = [];
        }
        if (!isset($_SESSION['cargasTrabalhos'])) {
            $_SESSION['cargasTrabalhos'] = [];
        }
        if (!isset($_SESSION['horas'])) {
            $_SESSION['horas'] = [];
        }
        array_push($_SESSION['quantidades'], $quantidade);
        array_push($_SESSION['prejuizos'], $prejuizo);
        array_push($_SESSION['datasRegistros'], $data_registro);
        array_push($_SESSION['horasRegistros'], $hora_registro);
        array_push($_SESSION['diasSemanas'], $dia_semana);
        array_push($_SESSION['cargasTrabalhos'], $cargaTrabalho);
        array_push($_SESSION['horas'], $horas);
        $diretorio = 'dadosUserjson/';
        file_put_contents($diretorio . 'quantidades.json', json_encode($_SESSION['quantidades'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'prejuizos.json', json_encode($_SESSION['prejuizos'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'datasRegistros.json', json_encode($_SESSION['datasRegistros'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'horasRegistros.json', json_encode($_SESSION['horasRegistros'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'diasSemanas.json', json_encode($_SESSION['diasSemanas'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'cargasTrabalhos.json', json_encode($_SESSION['cargasTrabalhos'], JSON_PRETTY_PRINT));
        file_put_contents($diretorio . 'horas.json', json_encode($_SESSION['horas'], JSON_PRETTY_PRINT));
        $emails = json_decode(file_get_contents("jsons/email.json"), true);
        $id = array_search($_SESSION['usuario'], $emails);
        $nomes = $_SESSION['nomes'];
        $nome = $nomes[$id];
        $nomeUser = json_encode($nome, JSON_PRETTY_PRINT);
        file_put_contents($diretorio . 'nomes.json',$nomeUser);
        $email = $emails[$id];
        $emailUser = json_encode($email, JSON_PRETTY_PRINT);
        file_put_contents($diretorio . 'emails.json', $emailUser);

        header("Location: inicial.php");
}