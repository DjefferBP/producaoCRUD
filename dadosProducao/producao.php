<?php
    $producao = $_SESSION['quantidades'];
    $vl = array_sum($producao);
    echo "<h4 style='font-size: 18px'><b>$vl</b></h4>";