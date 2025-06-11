<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['dadosNovos'])){
        $qt = $_SESSION['quantidades'];
        $horasTra = $_SESSION['horas'];
        $somaQt = array_sum($qt);
        $somaHoras = array_sum($horasTra) * 60;
        $mediaHoras = $somaQt / $somaHoras;
        echo "<h4 style='font-size: 18px'><b>Média de produção: </b>" . round($mediaHoras, 2) . " peças/min</h4>";
    } elseif (isset($_SESSION['dadosNovos']) && count($_SESSION['dadosNovos']) == 0) {
        $qt = $_SESSION['quantidades'];
        $horasTra = $_SESSION['horas'];
        $somaQt = array_sum($qt);
        $somaHoras = array_sum($horasTra) * 60;
        $mediaHoras = $somaQt / $somaHoras;
        echo "<h4 style='font-size: 18px'><b>Média de produção: </b>" . round($mediaHoras, 2) . " peças/min</h4>";
    } else {
        $dado = $_SESSION['dadosNovos'];
        $qt = [];
        $horasTra = [];
        for ($index = 0; $index < count($dado); $index++) {
            array_push($qt, $dado[$index]['quantidade']);
            array_push($horasTra, $dado[$index]['horas']);
        }
        $somaHoras = array_sum($horasTra) * 60;
        $somaQt = array_sum($qt);
        $mediaHoras = $somaQt / $somaHoras;
        echo "<h4 style='font-size: 18px'><b>Média de produção: </b>" . round($mediaHoras, 2) . " peças/min</h4>";
    }
    
