<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION["dadosNovos"])) {
        $quantidade = $_SESSION['quantidades'];
        $somaQt = array_sum($quantidade);
        $retrabalho = $_SESSION['prejuizos'];
        $somaRe = array_sum($retrabalho);
        $porcentagem = ($somaRe / $somaQt) * 100;
        $porcentagemR = round($porcentagem, 1);
        echo "<h4 style='font-size: 18px;'><b>$porcentagemR%</b>($somaRe)</h4>";
    } elseif(isset($_SESSION["dadosNovos"]) && count($_SESSION["dadosNovos"]) == 0) {
        $quantidade = $_SESSION['quantidades'];
        $somaQt = array_sum($quantidade);
        $retrabalho = $_SESSION['prejuizos'];
        $somaRe = array_sum($retrabalho);
        $porcentagem = ($somaRe / $somaQt) * 100;
        $porcentagemR = round($porcentagem, 1);
        echo "<h4 style='font-size: 18px;'><b>$porcentagemR%</b>($somaRe)</h4>";
    } else {
        $dado = $_SESSION['dadosNovos'];
        $qt = [];
        $preju = [];
        for ($index = 0; $index < count($dado); $index++) {
            array_push($qt, $dado[$index]['quantidade']);
            array_push($preju, $dado[$index]['prejuizo']);
        }
        $somaPreju = array_sum($preju);
        $somaQt = array_sum($qt);
        if ($somaQt > 0) {
            $porcentagem = ($somaPreju / $somaQt) * 100;
            $porcentagemR = round($porcentagem, 1);
        } else {
            $porcentagemR = 0;
        }
        echo "<h4 style='font-size: 18px;'><b>{$porcentagemR}%</b>($somaPreju)</h4>";
    }
?>
