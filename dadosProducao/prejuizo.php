<?php 
    if (!file_exists("tolerancia.json")) {
        $quantidade = $_SESSION['quantidades'];
        $somaQt = array_sum($quantidade);

        $tolerancia = $_SESSION['tole'][0] ?? 2;
        $perdaTotal = $_SESSION['prejuizos'];
        $perdaT = array_sum($perdaTotal);
        $prejuizo = max(0, $perdaT - $tolerancia);
        $porce = ($prejuizo / $somaQt) * 100;
        echo "<h4 style='font-size: 22px'><b>Prejuízo: ".round($porce)."%</b>(".round($prejuizo).")</h4>";
    }
    else {
        $quantidade = $_SESSION['quantidades'];
        $somaQt = array_sum($quantidade);
        $toleranciaArray = json_decode(file_get_contents("tolerancia.json"), true);
        $tolerancia = $toleranciaArray[0];
        $perdaTotal = $_SESSION['prejuizos'];
        $perdaT = array_sum($perdaTotal);
        $prejuizo = max(0, $perdaT - $tolerancia);
        $porce = ($prejuizo / $somaQt) * 100;
        echo "<h4 style='font-size: 22px'><b>Prejuízo:". round($porce, 1). "%</b>($prejuizo)</h4>";
    }
    
