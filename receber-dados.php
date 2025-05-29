<?php
    session_start();

    if (!isset($_SESSION['usuario'])) {
        header('Location: index.php');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $quantidade = $_POST['quantidade'];
        $prejuizo = $_POST['prejuizo'];
        $carga = $_POST['carga'];
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
        array_push($_SESSION['quantidades'], $quantidade);
        array_push($_SESSION['prejuizos'], $prejuizo);
        array_push($_SESSION['cargas'], $carga);
        array_push($_SESSION['datasRegistros'], $data_registro);
        array_push($_SESSION['horasRegistros'], $hora_registro);
        array_push($_SESSION['diasSemanas'], $dia_semana);
        array_push($_SESSION['carasTrabalhos'], $cargaTrabalho);
        array_push($_SESSION['horas'], $horas);
        header("Location: inicial.php");
}