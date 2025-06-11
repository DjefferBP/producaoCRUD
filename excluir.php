<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $index = $_GET['pos'];
    $emails = $_SESSION['emails'];
    unset($_SESSION['nomes'][$index]);
    unset($_SESSION['emails'][$index]);
    unset($_SESSION['quantidades'][$index]);
    unset($_SESSION['prejuizos'][$index]);
    unset($_SESSION['datasRegistros'][$index]);
    unset($_SESSION['horasRegistros'][$index]);
    unset($_SESSION['diasSemanas'][$index]);
    unset($_SESSION['cargasTrabalhos'][$index]);
    unset($_SESSION['horas'][$index]);
    unset($_SESSION['senhas'][$index]);
    $_SESSION['nomes'] = array_values($_SESSION['nomes']);
    $_SESSION['quantidades'] = array_values($_SESSION['quanidades']);
    $_SESSION['emails'] = array_values($_SESSION['emails']);
    $_SESSION['senhas'] = array_values($_SESSION['senhas']);
    $_SESSION['prejuizos'] = array_values($_SESSION['prejuizos']);
    $_SESSION['datasRegistros'] = array_values($_SESSION['datasRegistros']);
    $_SESSION['horasRegistros'] = array_values($_SESSION['horasRegistros']);
    $_SESSION['diasSemanas'] = array_values($_SESSION['diasSemanas']);
    $_SESSION['cargasTrabalhos'] = array_values($_SESSION['cargasTrabalhos']);
    $_SESSION['horas'] = array_values($_SESSION['horas']);
    echo "<script>alert('Usuário excluído com sucesso!');</script>";
    echo "<script>window.location.href='listagem.php';</script>";
    

