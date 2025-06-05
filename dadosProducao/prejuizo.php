<?php 
    if (!file_exists("tolerancia.json")) {
        $quantidade = $_SESSION['quantidades'];
        $somaQt = array_sum($quantidade);

        $tolerancia = isset($_SESSION['tole'][0]) ? floatval($_SESSION['tole'][0]) : 2;
        $perdaTotal = $_SESSION['prejuizos'];
        $perdaT = array_sum($perdaTotal);

        $toleranciaQt = $somaQt * ($tolerancia / 100);
        $prejuizo = max(0, $perdaT - $toleranciaQt);
        $porce = ($prejuizo / $somaQt) * 100;

        echo "<h4 style='font-size: 18px'><b>Prejuízo: ".round($porce, 1)."%</b> (".round($prejuizo).")</h4>";
    }
    else {
        $quantidade = $_SESSION['quantidades'];
        $somaQt = array_sum($quantidade);

        $toleranciaArray = json_decode(file_get_contents("tolerancia.json"), true);
        $tolerancia = isset($toleranciaArray[0]) ? floatval($toleranciaArray[0]) : 2;
        $perdaTotal = $_SESSION['prejuizos'];
        $perdaT = array_sum($perdaTotal);
 
        $toleranciaQt = $somaQt * ($tolerancia / 100);

        $prejuizo = max(0, $perdaT - $toleranciaQt);
        $porce = ($prejuizo / $somaQt) * 100;

        echo "<h4 style='font-size: 18px'><b>Prejuízo: ".round($porce, 1)."%</b> (".round($prejuizo).")</h4>";
    }
