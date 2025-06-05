<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $qt = $_SESSION['quantidades'];
    $horasTra = $_SESSION['horas'];
    $somaQt = array_sum($qt);
    $somaHoras = array_sum($horasTra) * 60;
    $mediaHoras = $somaQt / $somaHoras;
    echo "<h4 style='font-size: 18px'><b>Média de produção: </b>" . round($mediaHoras, 2) . " peças/min</h4>";