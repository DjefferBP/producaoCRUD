<?php
    $quantidade = $_SESSION['quantidades'];
    $somaQt = array_sum($quantidade);
    $retrabalho = $_SESSION['prejuizos'];
    $somaRe = array_sum($retrabalho);
    $porcentagem = ($somaRe / $somaQt) * 100;
    $porcentagemR = round($porcentagem, 1);
    echo "<h4 style='font-size: 16px;'><b>$porcentagemR%</b>($somaRe)</h4>";
?>