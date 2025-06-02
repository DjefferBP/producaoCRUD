<?php 
    if (!isset($_POST['editarTolerancia'])){
        $quantidade = $_SESSION['quantidades'];
        $somaQt = array_sum($quantidade);
        $tolerancia = $somaQt * 0.02;
        $perdaTotal = $_SESSION['prejuizos'];
        $perdaT = array_sum($perdaTotal);
        $prejuizo = max(0, $perdaT - $tolerancia);
        $porce = ($prejuizo / $somaQt) * 100;
        echo "<h4 style='font-size: 18px'><b>Prejuízo: $porce%</b>($prejuizo)</h4>";
    }
    else {
        $quantidade = $_SESSION['quantidades'];
        $somaQt = array_sum($quantidade);
        $tolerancia = $_POST['editarTolerancia'];
        $novaTole = $somaQt * ($tolerancia / 100);
        $perdaTotal = $_SESSION['prejuizos'];
        $perdaT = array_sum($perdaTotal);
        $prejuizo = max(0, $perdaT - $novaTole);
        $porce = ($prejuizo / $somaQt) * 100;
        echo "<h4 style='font-size: 18px'><b>Prejuízo: $porce%</b>($prejuizo)</h4>";
    }