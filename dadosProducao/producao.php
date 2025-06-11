<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION["dadosNovos"])) {
        $producao = $_SESSION['quantidades'];
        $vl = array_sum($producao);
        echo "<h4 style='font-size: 18px'><b>$vl</b></h4>";
    } elseif (!isset($_SESSION["dadosNovos"]) && count($_SESSION["dadosNovos"]) == 0) {
        $producao = $_SESSION['quantidades'];
        $vl = array_sum($producao);
        echo "<h4 style='font-size: 18px'><b>$vl</b></h4>";
    } else {
        $dado = $_SESSION['dadosNovos'];
        $qt = [];
        for ($index = 0; $index < count($dado); $index++) {
            array_push($qt, $dado[$index]['quantidade']);
        }
        $vl = array_sum($qt);
        echo "<h4 style='font-size: 18px'><b>$vl</b></h4>";
    }
