<?php 
    if(!isset($_POST['editarTolerancia'])){
        $quantidade = $_SESSION['quantidades'];
        $somaQt = array_sum($quantidade);
        $tolerancia = $somaQt * 0.02;
        echo "<h4 style='font-size: 22px'><b>2%</b>(".round($tolerancia).")</h4>";
    } else {
        $tolerancia = $_POST['editarTolerancia'];
        $somaQt = array_sum($quantidade);
        $tolerar = $somaQt * ($tolerancia / 100);
        echo "<h4 style='font-size: 22px'><b>$tolerancia%</b>(".round($tolerar).")</h4>";
    }