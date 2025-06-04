<?php 
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }

    if (!file_exists("tolerancia.json")) {
        $quantidade = $_SESSION['quantidades'];
        $somaQt = array_sum($quantidade);

        $tolerancia = $_SESSION['tole'][0] ?? 2;
        $tolerar = $somaQt * ($tolerancia / 100);

        echo "<h4 style='font-size: 22px'><b>{$tolerancia}%</b>(".round($tolerar).")</h4>";
    } else {
        $quantidade = $_SESSION['quantidades'];
        $somaQt = array_sum($quantidade);
        $toleranciaArray = json_decode(file_get_contents("tolerancia.json"), true);
        $tolerancia = $toleranciaArray[0];
        $tolerar = $somaQt * ($tolerancia / 100);

        echo "<h4 style='font-size: 22px'><b>{$tolerancia}%</b>(".round($tolerar).")</h4>";
    }


    if(isset($_POST['editarTolerancia'])){
        $tolerancia = $_POST['editarTolerancia'];
        $_SESSION['tole'][0] = $tolerancia;
        $tolerar = $somaQt * ($tolerancia / 100);
        
        file_put_contents("tolerancia.json", json_encode($_SESSION['tole'], JSON_PRETTY_PRINT));
        header("Location: ../inicial.php");
        exit;
    }
